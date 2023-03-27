<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$connection = mysqli_connect($server_name, $user_name, $password);
if (!$connection) {
  die("Failed ". mysqli_connect_error());
}
echo "Connection established successfully." . "\n";

$query = "CREATE DATABASE forumsdb";
if (mysqli_query($connection, $query)) {
  echo "A new database called mycompany is successfully created!";
} else {
  echo "Error:" . mysqli_error($connection);
}
mysqli_close($connection);
?>  