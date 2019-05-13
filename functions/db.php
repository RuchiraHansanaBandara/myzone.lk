<?php

session_start();

 function row_count($result){
     return mysqli_num_rows($result);
 }


 function escape($string){
     global $conn;
     return mysqli_real_escape_string($conn,$string);
 }


 function query($query){
     global $conn;
     return mysqli_query($conn,$query);
 }

 function confirm($result){
     global $conn;

     if(!$result) {
         die("QUERY FAILED". mysqli_error($conn));
     }
 }
function fetch_array($result){
     global $conn;
     return mysqli_fetch_array($result);

}








defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER","root");


defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME",  "myzone");



$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


require_once("cart.php");

?>