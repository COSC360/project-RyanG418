<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">   
</head>
<body>
<main>
<button onclick='window.location.href="frontpage.php";'>Home</button>
<?php

if(isset($_SESSION["username"])){
        $hidden1="hidden";
        $hidden2="";
        
    }else{
        $hidden1="";
        $hidden2="hidden";
    }
    ?>
<button <?php echo $hidden1;?> onclick='window.location.href="registration.php";'>Registration</button>
<button <?php echo $hidden2;?> onclick="window.location.href='logout.php';">Log Out</button>
<button <?php echo $hidden2;?> onclick='window.location.href="newpost.php";'>NEW POST</button>
    <h1>Login:</h1>
<form name="login" action="processlogin.php" method="post">
    <input type="text" id="username" name="username" placeholder="username"><br>
    <input type="text" id="password1" name="password1" placeholder="password"><br>
    <input type="submit" value="Submit">
  </form>
</main>
<footer>
</footer>
</body>
</html>