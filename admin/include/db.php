<?php
    $conn =new mysqli("localhost","root","","myzone");
    if(!$conn){
        echo "Something went wrong : Error ".$conn->connect_error;
    }else{
        //echo"successfully connected.";
    }
?>