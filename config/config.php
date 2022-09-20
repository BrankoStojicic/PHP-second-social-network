<?php
ob_start(); //Turning on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/Belgrade");



$con = mysqli_connect("localhost", "root", "", "s'up");

if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}


?>