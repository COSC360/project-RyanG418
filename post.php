<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">   
</head>
<body>
<main>
<button onclick='window.location.href="frontpage.php";'>Home</button>
<?php
    
    if($_SESSION["loggedin"]=="true"){
        $hidden1="hidden";
        $hidden2="";
    }else{
        $hidden1="";
        $hidden2="hidden";
    }
    ?>
<button <?php echo $hidden1;?> onclick='window.location.href="login.html";'>Login</button>
<button <?php echo $hidden1;?> onclick='window.location.href="registration.html";'>Registration</button>
<button <?php echo $hidden2;?> onclick="window.location.href='logout.php';">Log Out</button>
<button <?php echo $hidden2;?> onclick='window.location.href="newpost.php";'>NEW POST</button>
<?php

$host = 'cosc360.ok.ubc.ca';
$username = '59919308';
$password = '59919308';
$dbname = 'db_59919308';
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);
$username=$_SESSION['username'];
$uid=$_SESSION['uid'];
$title=$_POST['title'];
$body=$_POST['body'];
$sql= "INSERT INTO post(uid,title,body) VALUES ('$uid','$title','$body')";
mysqli_query($connection,$sql);
echo $username . " posted sucessfully";
mysqli_close($connection);
?>

</main>
<footer>
</footer>
</body>
</html>