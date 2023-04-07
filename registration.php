<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <script src="myscripts.js"></script>
    
</head>
<body>

<button onclick='window.location.href="frontpage.php";'>Home</button>
<main>
    <h1>Create new account</h1>
<form name="myForm" action="newaccount.php"method="post" enctype="multipart/form-data">
    <input type="text" id="username" name="username" placeholder="username"><br>
    <input type="text" id="email" name="email" placeholder="email"><br>
    <input type="text" id="password1" name="password1" placeholder="password"><br>
    <input type="text" id="password2" name="password2" placeholder="re-enter password"><br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Submit">
  </form>
</main>

<footer>

</footer>
</body>


</html>