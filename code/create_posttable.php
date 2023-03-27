<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "forumsdb";
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);
$query = "CREATE TABLE post(
pid int NOT NULL AUTO_INCREMENT,
uid varchar(50),
title varchar(50),
body varchar(300),
PRIMARY KEY (pid)
)";
if (mysqli_query($connection, $query)) {
  echo "Table is successfully created in forumsdb database.";
} else {
  echo "Error:" . mysqli_error($connection);
}
//close the connection
mysqli_close($connection);
?>