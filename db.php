<?php

$server_name = "localhost";
$user_name = "root";
$pass = "";
$name = "student";

$connection = new mysqli($server_name,$user_name,$pass,$name);

if($connection->connect_error)
{
  die("Connection failed: " . $connection->connect_error);
}
else
{
  //echo "Connection successfully";
}
mysqli_query($connection, "SET NAMES utf8");

?>
