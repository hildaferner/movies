<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "moviesdb";
$port ='3306';

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname, $port); 

if (mysqli_connect_error()) { 
    die("Connection failed: " . mysqli_connect_error());  
} 
?>