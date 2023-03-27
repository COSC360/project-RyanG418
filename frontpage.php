<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    
    
</head>
<body>

<main>
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
<button <?php echo $hidden2;?> onclick='window.location.href="account.php";'>ACCOUNT</button>


<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "forumsdb";
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);
$sql= "SELECT post.pid,user.username,post.title,post.body,user.country FROM user CROSS JOIN post ON user.uid=post.uid";
$result= mysqli_query($connection,$sql);
$row_cnt = mysqli_num_rows($result);
for($x=0;$x<$row_cnt;$x++){
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo "<div class='wrapper'>";
            echo "<div class='content'>";
            echo "<h1>".$row['title']."</h1>";
            echo "<p> Author: ".$row['username']." from country ".$row['country']."</p>";
            echo "<p>". $row['body']."</p>";
    echo "</div>";
  echo "</div>";
}
?>

</main>

</body>


</html>