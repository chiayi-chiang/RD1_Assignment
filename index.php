<?php
    require("database.php");
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
    if (isset($_POST["rain"]))//未來兩天
    {

        $localID=$_POST["country"];
        $sqlcity="select localID,`localName`
        FROM locationName
        where localID = '$localID'
        ";
        $sqlrow = mysqli_fetch_assoc(mysqli_query($con, $sqlcity));
        $city=$sqlrow["localName"];
        $rain="select *
        from rain
        where `city`='$city'";

        
        
    }
    if (isset($_POST["restart"]))//重新整理
    {

        require("insql.php");
        
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
        

            <button type="submit"  id="Button" name="restart" class="btn btn-outline-info btn-md float-right">重新整理</button>
            <button type="submit" id="Button" name="aweek" class="btn btn-outline-info btn-md float-right">一週</button>
            <button type="submit" id="Button" name="future" class="btn btn-outline-info btn-md float-right">未來兩天</button>
            <button type="submit" id="Button" name="now" class="btn btn-outline-info btn-md float-right">當前</button>
            <button type="submit" id="Button1" name="rain" class="btn btn-outline-info btn-md float-right">雨量</button>
            
            <div id=rain style="display:block">
                <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>local</th>
                        <th>1hour</th>
                        <th>24hour</th>
                    </tr>
                </thead>
                <tbody>
            
                <?php $result = mysqli_query($con, $rain); while ( $row = mysqli_fetch_assoc($result) ) { ?> 
                    <tr>
                        <td><?= $row["local"] ?></td>
                        <td><?= $row["1hour"] ?></td>
                        <td><?= $row["24hour"] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
            
            <div id=weather style="display:block">
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>city</th>
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
            

        </div>
    </form>
</div>
</body>
<!-- <script>
    document.getElementById("Button").addEventListener("click", function(button) {    
        if (document.getElementById("rain").style.display === "none") 		     
            document.getElementById("weather").style.display = "block";
        else (document.getElementById("rain").style.display = "block")
            document.getElementById("rain").style.display = "none";
            document.getElementById("weather").style.display = "block";
    });
    document.getElementById("Button1").addEventListener("click", function(button) {    
        if (document.getElementById("weather").style.display === "block") 		     
            document.getElementById("weather").style.display = "none";
            document.getElementById("rain").style.display = "block";
    });
</script> -->


</html>