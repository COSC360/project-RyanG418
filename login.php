<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">   
</head>
<body>
<main>

<?php

$host = 'cosc360.ok.ubc.ca';
$username = '59919308';
$password = '59919308';
$dbname = 'db_59919308';
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);
$username=$_POST['username'];
$sql= "SELECT uid,username,password,country FROM user WHERE username='$username'";

$result = mysqli_query($connection,$sql);
$uid = mysqli_fetch_column($result, 0);
mysqli_free_result($result);
$result = mysqli_query($connection,$sql);
$username = mysqli_fetch_column($result,1);
mysqli_free_result($result);
$result = mysqli_query($connection,$sql);
$realpw= mysqli_fetch_column($result, 2);
mysqli_free_result($result);
$result = mysqli_query($connection,$sql);
$country= mysqli_fetch_column($result, 3);
mysqli_free_result($result);
$pw=$_POST["password1"];
if($realpw==$pw){
    $_SESSION["loggedin"]="true";
    $_SESSION["username"]=$username;
    $_SESSION["uid"]=$uid;
    $_SESSION["country"]=$country;
    echo "Hello " . $_SESSION["username"] . " logged in sucessfully";
}
else{ 
     echo "invalid username";
}
mysqli_close($connection);
?>
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
</main>
<footer>
</footer>
</body>
</html>