<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>
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
    else{$hidden3="hidden";}
    mysqli_free_result($result);
    $hidden1="hidden";
    $hidden2="";
}else{
    $hidden1="";
    $hidden2="hidden";
    $hidden3="hidden";
}
?>
<button <?php echo $hidden1;?> onclick='window.location.href="login.php";'>Login</button>
<button <?php echo $hidden1;?> onclick='window.location.href="registration.php";'>Registration</button>
<button <?php echo $hidden2;?> onclick="window.location.href='logout.php';">Log Out</button>
<button <?php echo $hidden2;?> onclick='window.location.href="newpost.php";'>NEW POST</button>
<button <?php echo $hidden2;?> onclick='window.location.href="account.php";'>ACCOUNT</button><br><?php if(isset($_SESSION["username"])){echo "<p> Hello ". $username."</p>";}?>
<button <?php echo $hidden3;?> onclick='window.location.href="admin.php";'>ADMIN</button>
<form name="findpost" action="frontpage.php" method="post">
    <input type="text" id="title" name="title" placeholder="Find specific posts: "><br>
    <select id="order" name="order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>
    <input type="submit" value="Submit">

  </form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $order=$_POST['order'];
    $search="%".$_POST['title']."%";
    $sql= "SELECT user.uid,post.pid,user.username,post.title,post.body,user.country,contentType,image
    FROM user 
    CROSS JOIN post ON user.uid=post.uid  
    CROSS JOIN userImages ON user.uid=userImages.uid
    WHERE title LIKE '$search' 
    ORDER BY pid $order";
    $result= mysqli_query($connection,$sql);
    $row_cnt = mysqli_num_rows($result);
}else{
$sql= "SELECT user.uid,post.pid,user.username,post.title,post.body,user.country,contentType,image
       FROM user 
       CROSS JOIN post ON user.uid=post.uid  
       CROSS JOIN userImages ON user.uid=userImages.uid 
       ORDER BY pid DESC";
$result= mysqli_query($connection,$sql);
$row_cnt = mysqli_num_rows($result);
}
for($x=0;$x<$row_cnt;$x++){
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $type=$row['contentType'];
    $image=$row['image'];
    echo "<div class='wrapper'>";
            echo "<div class='content'>";
            echo "<h1>".$row['title']."</h1>";
            echo '<p><img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>'." Author: ".$row['username']."<br> From country: ".$row['country'];
            echo "</p>";
            echo "<p>". $row['body']."</p>";
    echo "</div>";
  echo "</div>";
}
?>

</main>

</body>


</html>