<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "forumsdb";
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);
$query = "CREATE TABLE  user(
uid int NOT NULL AUTO_INCREMENT,
username varchar(50),
country varchar(50),
password varchar(50),
PRIMARY KEY (uid)
)";
if (mysqli_query($connection, $query)) {
  echo "Table is successfully created in forumsdb database.";
} else {
  echo "Error:" . mysqli_error($connection);
}

//close the connection
mysqli_close($connection);
?>