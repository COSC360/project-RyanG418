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
<form name="update" action="account.php" method="post">
    <input type="text" id="country" name="country" placeholder="Enter new country: "><br>
    <input type="text" id="oldpw" name="oldpw" placeholder="Enter your old password: "><br>
    <input type="text" id="pw1" name="pw1" placeholder="Enter new password: "><br>
    <input type="text" id="pw2" name="pw2" placeholder="Re-type password: "><br>
    <input type="submit" value="Submit">
  </form>
<?php
$csv = array();
$lines = file('dbinfo.txt', FILE_IGNORE_NEW_LINES);
foreach ($lines as $key => $value)
{
    $csv[$key] = str_getcsv($value);
}
$connection = mysqli_connect($csv[0][0], $csv[0][1], $csv[0][2], $csv[0][3]);
    if(isset($_SESSION["username"])){
        $username=$_SESSION["username"];
        $hidden2="";
    }else{
        header("Location: frontpage.php");
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $sql= "SELECT password,uid FROM user WHERE username='$username'";
        $result = mysqli_query($connection,$sql);
        $row_cnt = mysqli_num_rows($result);
        if($row_cnt==1){
            $row = mysqli_fetch_array($result,MYSQLI_NUM);
            $realpw= $row[0];
            $uid=$row[1];
            if(!empty($_POST['oldpw'])){
                $oldpw=md5($_POST['oldpw']);
                mysqli_free_result($result);
                if($realpw==$oldpw){
                    if(!empty($_POST['country'])){
                        $country=$_POST['country'];
                        $sql= "UPDATE user
                        SET country = '$country'
                        WHERE uid='$uid'";
                        mysqli_query($connection,$sql);
                    }
                    if((!empty($_POST['pw1'])and!empty($_POST['pw2']))){
                        $pw1=md5($_POST['pw1']);
                        $pw2=md5($_POST['pw2']);
                        if($pw1==$pw2){
                            $sql= "UPDATE user
                            SET password = '$pw1'
                            WHERE uid='$uid'";
                        mysqli_query($connection,$sql);
                            echo "<p>Updated password!</p><br>";
                        }else{
                            "<p>New passwords do not match</p><br>";
                        }
                    }else{
                    }
                }else{
                    echo "<p>Incorrect password</p><br>";
                }
            }else{
                echo "<p>please provide a password</p><br>";
            }
        }
    }
?>
<button <?php echo $hidden2;?> onclick="window.location.href='logout.php';">Log Out</button>
<button <?php echo $hidden2;?> onclick='window.location.href="newpost.php";'>NEW POST</button>
</main>
<footer>
</footer>
</body>
</html>