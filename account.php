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
<h1>This page will have the ability to change username, password, country (WIP).
</main>
<footer>
</footer>
</body>
</html>