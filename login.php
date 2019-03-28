<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashed = md5($password);
  $error = "";
  if($username == "coursework" && $hashed == "79b5cb42426bd5d23a84e74bd758166f"){
    header("location: index.php");
    $_SESSION['username'] = "dgm214";
  }
  else{
    $error = "Incorrect Login Details";
  }
}
?>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h3>Enter Details to login</h3>
  <form method = "POST">
      <input type = "text" placeholder="Username" name="username" required>
      <input type = "password" placeholder="Password" name="password" required>
      <input type = "submit" value = "Login">
  </form>
  <p><?php echo $error ?></p>
</body>
</html>
