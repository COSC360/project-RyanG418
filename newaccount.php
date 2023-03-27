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

$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "forumsdb";
$username=$_POST['username'];
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);
$sql= "SELECT username FROM user WHERE username='$username'";
$result = mysqli_query($connection,$sql);

$count=0;
$result= mysqli_query($connection,$sql);
$row_cnt = mysqli_num_rows($result);
if($row_cnt==0){
    mysqli_free_result($result);
    $pw=$_POST["password1"];
    $sql ="INSERT INTO user(username,password) VALUES ('$username','$pw')";
    mysqli_query($connection,$sql);
    $_SESSION["loggedin"]="true";
    $_SESSION["username"]=$username;
    $_SESSION["uid"]=$uid;
    echo "Hello " . $username . " account created sucessfully";
}
else{
    mysqli_free_result($result);
    echo "different username required";
}


mysqli_close($connection);
?>
</main>

<footer>

</footer>
</body>


</html>