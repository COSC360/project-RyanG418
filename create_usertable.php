<?php
$host = 'cosc360.ok.ubc.ca';
$username = '59919308';
$password = 'RYANGRANT418';
$dbname = 'db_59919308';
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