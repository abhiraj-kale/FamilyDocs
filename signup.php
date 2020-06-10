<?php
require 'connect.inc.php';
require 'core.inc.php';
 $_SESSION['secure'] = rand(1000,9999);

$_SESSION['name']='';
$_SESSION['username']='';
$_SESSION['password']='';
$_SESSION['email']='';
$_SESSION['captcha']='';
$_SESSION['captcha_error'] = '';
$_SESSION['logged_in']=false;
if (isset($_POST['name'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['email'])&&isset($_POST['captcha'])) {
  if (!empty($_POST['name'])&&!empty($_POST['username'])&&!empty($_POST['password'])&&!empty($_POST['email'])&&!empty($_POST['captcha'])) {
    global $conn; global $secure; global $mail;
    $_SESSION['name'] = mysqli_real_escape_string($conn,$_POST['name']);
    $_SESSION['username'] = mysqli_real_escape_string($conn,$_POST['username']);
    $_SESSION['password'] = md5(mysqli_real_escape_string($conn,$_POST['password']));
    $_SESSION['email'] = mysqli_real_escape_string($conn,$_POST['email']);
   $_SESSION['captcha'] = mysqli_real_escape_string($conn,$_POST['captcha']);

  if ( $_SESSION['captcha'] != $secure) {
     $_SESSION['password']='';
     $_SESSION['captcha']='';
     $_SESSION['captcha_error'] = 'Incorrect captcha';
  }else{
    $_SESSION['captcha_error'] = '';
      include 'mail.php';
      header('Location: otp.php');
  }

  }else{
    date_default_timezone_set('Asia/Kolkata');
    $_SESSION['login-time'] = date('F d Y h:i A',time());
    header('Location: signup.php');
  }
}

 ?>

  <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>FamilyDocs.in</title>
   </head>
   <link rel="stylesheet" href="stylesheet/signup.css">
   <body>
     <div class="left-div">
       <div class="header-div">
         <label id="header">Family</label><label id="docs">Docs</label><label id="in">.in</label>
       </div>
       <div class="list">
         <li>
           <ul>
             Upload Essential Documents.
           </ul>
           <ul>
             Retrieve whenever needed.
           </ul>
           <ul>
             Store all documents at one place.
           </ul>
           <ul>
             Just one click away.
           </ul>
         </li>
       </div>
     </div>
     <div class="signup">
       <form action="signup.php" method="post" id="signup_form">
          <h2>Sign Up</h2>
          <div class="msg" name="msg" id="msg"><label id="error_msg"><?php if(isset($_SESSION['captcha_error'])){if($_SESSION['captcha_error']!=''){ echo $_SESSION['captcha_error'];}} ?></label>
            <center><label id="lbl">Please Wait...</label>
          </div>
          <h4>Name</h4>
          <input type="text" name="name" id="name" placeholder="Name" value="<?php if($_SESSION['name']!='') echo $_SESSION['name'] ?>" required>
          <h4>Username</h4>
          <input type="text"  name="username" placeholder="Username" id="username" value="<?php if($_SESSION['username']!='') echo $_SESSION['username'] ?>" required minlength="3">
          <h4>Password</h4>
          <input type="password" placeholder="Password" id="password" name="password" minlength="6" required>
          <input type="button" id="checkbox" class="checkbox" value="Show"> <br>
          <h4>Email</h4>
          <input type="email" name="email" id="email" placeholder="E-mail" required value="<?php if($_SESSION['email']!='') echo $_SESSION['email'] ?>"> <br>
          <img class="captcha" id="captcha" src="captcha.php"/>
          <br>
          <input type="text" name="captcha" placeholder="Enter visible captcha" maxlength="4" minlength="4" required><br>
          <br>
          <input type="submit" name="submit" id="submit" value="Sign up"><br><br>
          <a href="login.php"><button type="button" name="button" id="button">Go to Login</button></a>

          <script type="text/javascript" src="javascripts/jquery.js"></script>
          <script type="text/javascript" src="javascripts/signup.js"></script>
       </form>
     </div>
   </body>
 </html>
