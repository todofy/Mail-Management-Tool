<?php
session_start();
require "libs/session.php";
require "libs/user.php";
require "includes/functions.php";
?>
<?php
//$session=new session();
//$session->logout();
if(isset($_POST['commit']))
{
  $email=$_POST['login'];
  $password=$_POST['password'];
  //$password=hash('sha512', $_POST['password']);
  //add remember me
  //check the info again
  $newuser=new user();
  $newuser->set_initial($email,$password);
  $success=$newuser->checkFromDB();
  if($success)
  {
    session::Set($success);
    if(isset($_SESSION['user_id']))
    redirect_to("../dashboard/");
  }
  else
  {
    echo "no such user found";
    //no such  user found
    //give the error
  }
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Login to Web App</h1>
      <form method="post" action="index.php">
        <p><input type="text" name="login" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Forgot your password? <a href="index.php">Click here to reset it</a>.</p>
    </div>
  </section>

  
</body>
</html>
