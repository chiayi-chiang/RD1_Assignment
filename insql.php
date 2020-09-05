<?php
    require("database.php");//呼叫data
    
    $weather="https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-83112F47-7BD2-42BB-B541-7535D35C5483&format=JSON&elementName=WeatherDescription";
    $rain="https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-83112F47-7BD2-42BB-B541-7535D35C5483&format=JSON&elementName=RAIN,HOUR_24&parameterName=CITY";

    $objwe = json_decode(file_get_contents($weather), false);//是否轉成關聯是陣列
    $objra = json_decode(file_get_contents($rain), false);//是否轉成關聯是陣列
    
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
    //localName 資料表的匯入
    $location= $objwe->records->locations[0]->location;
    //echo $location;
    foreach($location as $item){
        $locationName=$item->locationName; 
        $query ="INSERT INTO `locationName`(`localName`) VALUES ('$locationName')";
        $result=mysqli_query($con, $query);
    }
    
    //aweek 資料表的匯入
    //echo count($location);//22 0~21
    for ($i=0;$i<=count($location);$i++){
        $time= $objwe->records->locations[0]->location[$i]->weatherElement[0]->time; 
        foreach($time as $item){
            $startTime=$item->startTime; 
            //echo $startTime0;
            $endTime=$item->endTime;
            //echo $endTime;
            $value=$item->elementValue[0]->value;
            //echo $value;
            $query ="INSERT INTO `aweek`(`localID`,`startTime`, `endTime`, `value`) VALUES ($i+1,'$startTime','$endTime','$value')";
            // echo $query;
            $result=mysqli_query($con, $query);
            
        }
    }

    //rain 資料表匯入

    // $location= $obj->records->location[0]->locationName;//福山
    // $location= $obj->records->location[0]->weatherElement[0]->elementValue;//-998.0
    // $location= $obj->records->location[0]->weatherElement[1]->elementValue;//0.00
    // $location= $obj->records->location[0]->parameter[0]->parameterValue;//新北市

    $location2= $objra->records->location;
    foreach($location2 as $item){
        $local=$item->locationName;
        $hour1=$item->weatherElement[0]->elementValue;
        $hour24=$item->weatherElement[1]->elementValue;
        $city=$item->parameter[0]->parameterValue;
        $query ="INSERT INTO `rain`(`city`,`local`, `1hour`, `24hour`) VALUES ('$city','$local','$hour1','$hour24')";
        $result=mysqli_query($con, $query);
    }
    

        
?>