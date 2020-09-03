<?php 

header("content-type:text/html; charset=utf-8");

// 0. 請先建立 Class 資料庫 （執行 class.sql）
 
// 1. 連接資料庫伺服器
$server='localhost';
$id='root';
$pwd='root';
$dbname='weather';   
$con = mysqli_connect($server , $id , $pwd,$dbname,8889);
if (!$con){
  	die("Could not connect: " . mysql_error());
}
mysqli_query($con ,"SET NAMES utf8");
// mysql_close($con);



// 2. 執行 SQL 敘述
// $commandText = "select * from weather";
// $row =mysqli_fetch_assoc(mysqli_query($con, $commandText));

// $row = mysql_fetch_assoc($result);
// $row = mysql_fetch_row($result);
// $row = mysql_fetch_array($result);



// $json = json_encode($row);

// echo $json;
// var_dump($row);

?>