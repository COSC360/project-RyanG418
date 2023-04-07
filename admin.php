<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>
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
    $sql= "SELECT admin,username FROM user WHERE username='$username'";
    $result= mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_NUM);
    if(($row[0])=="true"){
        $hidden3="";
    }
    else{
        header("Location: frontpage.php");
    }
    $hidden1="hidden";
    $hidden2="";
}else{
    header("Location: frontpage.php");
    $hidden1="";
    $hidden2="hidden";
}
?>
<button onclick='window.location.href="frontpage.php";'>Home</button>
<button <?php echo $hidden2;?> onclick="window.location.href='logout.php';">Log Out</button>
<h1>ADMIN PAGE!!!!</h1>
<form name="finduser" action="admin.php" method="post">
    <input type="text" id="username" name="username" placeholder="username"><br>
    <input type="submit" value="Submit">
  </form>
<?php
     
     if($_SERVER['REQUEST_METHOD']=="POST"){
        $username=$_POST['username'];
        $sql= "SELECT firstname,lastname,country,email,uid FROM user WHERE username='$username'";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_NUM);
        mysqli_free_result($result);
        if(!empty($row)){
           echo "<fieldset>";
           echo "<legend>".$username."</legend>";
           echo "First Name: ".$row[0]."<br>";
           echo "Last Name: ".$row[1]."<br>";
           echo "Country: ".$row[2]."<br>";
           echo "Email: ".$row[3]."<br>";
           $uid=$row[4];
           $sql= "SELECT username FROM user WHERE username='$username'";
            $result= mysqli_query($connection,$sql);
            $row_cnt = mysqli_num_rows($result);
            if($row_cnt>0){
            $sql = "SELECT contentType, image FROM userImages where uid=?";
            $stmt = mysqli_stmt_init($connection);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "i", $uid);
            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
            mysqli_stmt_bind_result($stmt, $type, $image); 
            mysqli_stmt_fetch($stmt);
            echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/><br>';
            mysqli_stmt_close($stmt);
            $sql= "SELECT post.pid,user.username,post.title,post.body,user.country FROM user CROSS JOIN post ON user.uid=post.uid WHERE username='$username'";
            $result= mysqli_query($connection,$sql);
            echo "<fieldset>";  
            echo "<legend>".$username."'s posts: </legend>";
            }if(isset($row['title'])){
                for($x=0;$x<$row_cnt;$x++){
                    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo "<div class='wrapper'>";
                            echo "<div class='content'>";
                            echo "<h1>".$row['title']."</h1>";
                            echo "<p>". $row['body']."</p>";
                    echo "</div>";
                echo "</div>";
                }
            }
            
        }
     }
?>
</main>
<footer>
</footer>
</body>
</html>