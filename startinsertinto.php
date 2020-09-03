<?php
    require("database.php");
    $url="https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-83112F47-7BD2-42BB-B541-7535D35C5483&format=JSON&elementName=WeatherDescription";
    $result = file_get_contents($url);
    $obj = json_decode($result, false);//是否轉成關聯是陣列
    
    $location= $obj->records->locations[0]->location;
    //echo $location;
    foreach($location as $item){
        $locationName=$item->locationName; 
        $query ="INSERT INTO `locationName`(`localName`) VALUES ('$locationName')";
        //$result=mysqli_query($con, $query);
        
    }
    //echo count($location);//22 0~21
    for ($i=0;$i<=count($location);$i++){
        $time= $obj->records->locations[0]->location[$i]->weatherElement[0]->time; 
        foreach($time as $item){
            $startTime=$item->startTime; 
            //echo $startTime0;
            $endTime=$item->endTime;
            //echo $endTime;
            $value=$item->elementValue[0]->value;
            //echo $value;
            $query ="INSERT INTO `aweek`(`localID`,`startTime`, `endTime`, `value`) VALUES ($i+1,'$startTime','$endTime','$value')";
            //echo $query;
            //$result=mysqli_query($con, $query);
            
        }

     }
    

        
?>