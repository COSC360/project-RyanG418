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
    
    if(isset($_SESSION["username"])){
        $hidden1="hidden";
        $hidden2="";
    }else{
        $hidden1="";
        $hidden2="hidden";
    }
    ?>
<button <?php echo $hidden1;?> onclick='window.location.href="login.php";'>Login</button>
<button <?php echo $hidden1;?> onclick='window.location.href="registration.php";'>Registration</button>
<button <?php echo $hidden2;?> onclick="window.location.href='logout.php';">Log Out</button>
<button <?php echo $hidden2;?> onclick='window.location.href="newpost.php";'>NEW POST</button>
<?php
$csv = array();
$lines = file('dbinfo.txt', FILE_IGNORE_NEW_LINES);
foreach ($lines as $key => $value)
{
    $csv[$key] = str_getcsv($value);
}
$connection = mysqli_connect($csv[0][0], $csv[0][1], $csv[0][2], $csv[0][3]);
$username=$_SESSION['username'];
$sql= "SELECT uid,username FROM user WHERE username='$username'";
$result = mysqli_query($connection,$sql);
$row_cnt = mysqli_num_rows($result);
if($row_cnt==1){
    $row = mysqli_fetch_array($result,MYSQLI_NUM);
    $uid = $row[0];
    $username = $row[1];
    mysqli_free_result($result);
    $title=$_POST['title'];
    $body=$_POST['body'];
    $sql= "INSERT INTO post(uid,title,body) VALUES ('$uid','$title','$body')";
    mysqli_query($connection,$sql);
    echo $username . " posted sucessfully";
}else{
    echo "invalid login ";
}

mysqli_close($connection);
?>

</main>
<footer>
</footer>
</body>
</html>