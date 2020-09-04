<?php
    require("database.php");
    // $url="https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-83112F47-7BD2-42BB-B541-7535D35C5483&format=JSON&elementName=WeatherDescription";
    // $result = file_get_contents($url);
    // $obj = json_decode($result, false);//是否轉成關聯是陣列
    if (isset($_POST["aweek"]))//一週
    {

        $localID=$_POST["country"];
        $sql="select n.localID,`localName`,`startTime`,`endTime`,`value` 
        FROM locationName n,aweek w 
        where n.localID=w.localID 
        and n.localID = '$localID' 
        order by `startTime` asc
        ";
        
    }
    if (isset($_POST["now"]))//當前天氣
    {

        $localID=$_POST["country"];
        $timenow=date('Y-m-d',mktime (date(H)+8, date(i), date(s), date(m), date(d), date(Y)));
        $sql="select n.localID,`localName`,`startTime`,`endTime`,`value` 
        FROM locationName n,aweek w 
        where n.localID=w.localID 
        and n.localID = '$localID' 
        and startTime Like ('$timenow %')
        order by `startTime` asc
        ";
        
        
    }
    if (isset($_POST["future"]))//未來兩天
    {

        $localID=$_POST["country"];
        $timenow=date('Y-m-d',mktime (date(H)+8, date(i), date(s), date(m), date(d)+1, date(Y)));
        $timestop=date('Y-m-d',mktime (date(H)+8, date(i), date(s), date(m), date(d)+3, date(Y)));
        $sql="select n.localID,`localName`,`startTime`,`endTime`,`value` 
        FROM locationName n,aweek w 
        where n.localID=w.localID 
        and n.localID = '$localID'
        and  `startTime` BETWEEN '$timenow' and '$timestop' 
        order by `startTime` asc
        ";
        
        
    }
    if (isset($_POST["restart"]))//重新整理
    {

        require("start_insertinto.php");
        
    }

   
    
    $id ="
    select `localID`,`localName`
    FROM locationName
    order by  localID
    ";   

            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 1000px;
            margin: 100px auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</head>
<body>
<div class="form"> 
    <form class="member-form" method="post" action="index.php">
        <div class="container">
        <h2 class="float-left">
        <select name="country">
            <?php $result = mysqli_query($con, $id); while ( $row = mysqli_fetch_assoc($result) ) { ?> 

                <option id="localID" name="localID" <?=($localID==$row["localID"])?"selected":""?> value="<?= $row["localID"] ?>"><?= $row["localName"] ?>
        
            <?php } ?>
            
        </select>地區天氣預報
        </h2>
       
        <button type="submit" name="restart" class="btn btn-outline-info btn-md float-right">重新整理</button>
        <button type="submit" name="aweek" class="btn btn-outline-info btn-md float-right">一週</button>
        <button type="submit" name="future" class="btn btn-outline-info btn-md float-right">未來兩天</button>
        <button type="submit" name="now" class="btn btn-outline-info btn-md float-right">當前</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>localName</th>
                    <th>startTime</th>
                    <th>endTime</th>
                    <th>value</th>
                </tr>
            </thead>
            <tbody>
        
            <?php $result = mysqli_query($con, $sql); while ( $row = mysqli_fetch_assoc($result) ) { ?> 
                <tr>
                    <td><?= $row["localName"] ?></td>
                    <td><?= $row["startTime"] ?></td>
                    <td><?= $row["endTime"] ?></td>
                    <td><?= $row["value"] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </form>
</div>

</body>
</html>