<?php
    require("database.php");
    $url="https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-83112F47-7BD2-42BB-B541-7535D35C5483&format=JSON&elementName=WeatherDescription";
    $result = file_get_contents($url);
    $obj = json_decode($result, false);//是否轉成關聯是陣列
    
    // $location= $obj->records->locations[0]->location;
    //echo $location;
    // foreach($location as $item){
    //     $locationName=$item->locationName; 
    //     $query ="INSERT INTO `locationName`(`localName`) VALUES ('$locationName')";
    //     $result=mysqli_query($con, $query);
        
    // }
    
    // for ($i=0;$i<=count($location);$i++){
    //     $time= $obj->records->locations[0]->location[$i]->weatherElement[0]->time; 
        
    //     foreach($time as $item){
    //         $startTime=$item->startTime; 
    //         //echo $startTime0;
    //         $endTime=$item->endTime;
    //         //echo $endTime;
    //         $value=$item->elementValue[0]->value;
    //         //echo $value;
    //         $query ="INSERT INTO `aweek`(`localID`,`startTime`, `endTime`, `value`) VALUES ($i+1,'$startTime','$endTime','$value')";
    //         echo $query;
    //         $result=mysqli_query($con, $query);
            
    //     }

    //  }
    

    //$query ="INSERT INTO `locationName`(`localName`) VALUES ('$weatherElement')";
        //$result=mysqli_query($con, $query);
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="localname.php">
        <div class="title_area">
            <h1>Taiwan<span>///</span><br>Weather Map<br></h1>
            <hr />

            <div class="forcast" v-if="now_area">
                <h5>{{now_area.place}}</h5>
                <h4>{{now_area.low}}~{{now_area.high}}</h4>
                <h2>{{now_area.weather}}</h2>
            </div>

        </div>
    </form> -->
    
</body>
</html>