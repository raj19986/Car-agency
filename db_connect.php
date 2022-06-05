<?php 
session_start();
$servername="localhost";
$username="root";
$password="";
$databse="car_agency";
// creating datbase connection
$conn=mysqli_connect($servername,$username,$password,$databse);
// checck connnection
if(!$conn ){
    die("Failed To connect".mysqli_connect_error());
}

?>