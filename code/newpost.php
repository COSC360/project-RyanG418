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
<h1>New Post:</h1>
<form name="newpost" action="post.php" onsubmit="return validatePost()" method="post">
    <input type="text" id="title" name="title" placeholder="Title"><br>
    <textarea name="body" id="body" placeholder="Body" style="width: 500px" rows="5"></textarea><br>
    <input type="submit" value="Submit">
  </form>    
</main>
<footer>
</footer>
</body>
</html>