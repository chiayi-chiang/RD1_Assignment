# RD1_Assignment
說明:
1. 製作一個個人氣象網站，並且實作以下功能:
1.1 縣市選擇:可自行選擇要查看的縣市 check

    <select name="country">
            <?php $result = mysqli_query($con, $id); while ( $row = mysqli_fetch_assoc($result) ) { ?> 
                <option id="localID" name="localID" <?=($localID==$row["localID"])?"selected":""?> value="<?= $row["localID"] ?>"><?= $row["localName"] ?>
            <?php } ?>
    </select>地區天氣預報

1.2 顯示縣市當前天氣狀況 check

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

1.3 顯示縣市未來2天、1週天氣預報 check
    
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

1.4 顯示縣市各觀測站過去1小時、24小時累積雨量數據 check
    
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

1.5 切換縣市時，顯示該縣市的特色圖片 
2. 上述各式氣象資料，請一併儲存於資料庫 check
    ->weather.sql 
    //只有框架沒有資料，請先建立至sql
    //在開啟index.php，重新整理，即可demo
    if (isset($_POST["restart"]))//重新整理
    {

        require("insql.php");
        
    }
    ->insql.php將資料表清空，再重新抓取載入
    //清空所有資料夾
    $sqlset="set global foreign_key_checks=0";//不用外鍵檢查
    $set=mysqli_query($con, $sqlset);

    $sqlwe="TRUNCATE `locationName`";
    $we=mysqli_query($con, $sqlwe);
    
    $sqlaw="TRUNCATE `aweek`";
    $aw=mysqli_query($con, $sqlaw);

    $sqlra="TRUNCATE `rain`";
    $ra=mysqli_query($con, $sqlra);

    //再重新載入所有資料

3. 介面排版與所需素材請自由發揮 