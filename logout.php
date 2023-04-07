<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main>
    <?php
if(isset($_SESSION["username"])){
    session_unset();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else{
    header("Location: login.php");
}
      ?>
</main>

<footer>

</footer>
</body>


</html>