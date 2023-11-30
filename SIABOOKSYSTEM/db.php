<?php
//default setting of server
$host = "localhost"; //server name
$user = "root";     //user
$pass = "";         //password
$database = "db_nt3101";     //database name

//establishing connection
$conn = mysqli_connect($host, $user, $pass, $database);

//display error message
if (!$conn){
    die("Connection failed! " . mysqli_connect_error());
}

?>

