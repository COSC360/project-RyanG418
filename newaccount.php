<?php session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<main>
<button onclick='window.location.href="frontpage.php";'>Home</button>
<?php

$csv = array();
$lines = file('dbinfo.txt', FILE_IGNORE_NEW_LINES);
foreach ($lines as $key => $value)
{
    $csv[$key] = str_getcsv($value);
}
$connection = mysqli_connect($csv[0][0], $csv[0][1], $csv[0][2], $csv[0][3]);
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_POST['username'];
    $sql= "SELECT username FROM user WHERE username='$username'";
    $result = mysqli_query($connection,$sql);
    $count=0;
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt==0){
        mysqli_free_result($result);
        $pw=md5($_POST["password1"]);
        $email=$_POST['email'];
        $sql ="INSERT INTO user(username,password,email) VALUES ('$username','$pw','$email')";
        mysqli_query($connection,$sql);
        $_SESSION["username"]=$username;
        echo "Hello " . $username . " account created sucessfully";
        $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            if ($_FILES["fileToUpload"]["size"] > 100000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
              } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $sql= "SELECT uid FROM user WHERE username='$username'";
                $result = mysqli_query($connection,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_NUM);
                $uid=$row[0];
                mysqli_free_result($result);
                $imagedata =  file_get_contents($target_file);
                $sql = "INSERT INTO userImages (uid, contentType, image) VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($connection); //init prepared statement object
                mysqli_stmt_prepare($stmt, $sql); // register the query
                $null = NULL;
                mysqli_stmt_bind_param($stmt, "isb", $uid, $imageFileType, $null);
                mysqli_stmt_send_long_data($stmt, 2, $imagedata);
                $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                mysqli_stmt_close($stmt); 
                echo "file uploaded!";
            } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
    }
    else{
        mysqli_free_result($result);
        echo "different username required";
    }
}else{
    echo "invalid request";
}
mysqli_close($connection);
?>
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
</main>

<footer>

</footer>
</body>


</html>