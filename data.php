<?php
    $url="https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-83112F47-7BD2-42BB-B541-7535D35C5483&format=JSON&elementName=WeatherDescription";
    $result = file_get_contents($url);
    $obj = json_decode($result, false);//是否轉成關聯是陣列
    echo($obj->records->locations[0]->locationsName) ;
?>