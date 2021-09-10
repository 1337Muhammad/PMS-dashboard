<?php 

$host = "localhost";
$user = "root";
$password = "";
$dbase = "productms";

// connectio 

$conn = mysqli_connect($host,$user,$password,$dbase);
if(!$conn){
    die("connection error :" . mysqli_connect_error());
    exit();
}

