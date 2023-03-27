<?php
$host = 'cosc360.ok.ubc.ca';
$username = '59919308';
$password = 'RYANGRANT418';
$dbname = 'db_59919308';
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