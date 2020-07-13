<?php
require 'connect.inc.php';
require 'core.inc.php';
$_SESSION['logged_in']=false;
if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email'])) {
  if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email'])){
    global $conn;
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
    $email = mysqli_real_escape_string($conn,$_POST['email']);

  // Retrieving data from the databsee
      $query="SELECT * from clients where (name='$name' OR username='$name') AND password='$password' AND email='$email'";
      // Perform query
      if ($result = mysqli_query($conn,$query)) {
        if(mysqli_num_rows($result)==1){
          $row = mysqli_fetch_assoc($result);
          $_SESSION['name'] = $row["name"];
          $_SESSION['username'] = $row["username"];
          $_SESSION['password'] = $row["password"];
          $_SESSION['email'] = $row["email"];
          $_SESSION['logged_in']= true;
          date_default_timezone_set('Asia/Kolkata');
          $_SESSION['login-time'] = date('F d Y h:i A',time());
          header('Location: home.php');

        // Free result set
        mysqli_free_result($result);

      }else{
        $_SESSION['login_fail']=true;
      }
}
      $conn -> close();
  }
}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <link rel="stylesheet" href="stylesheet/login.css">
   </head>
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
     <form action="login.php" class="login_form" id="login_form" method="post">
      <div class="login">
       <h1>Login</h1>
       <div class="msg" id="msg"><?php if((isset($_SESSION['login_fail']))&&($_SESSION['login_fail']==true)){echo "Incorrect Credentials.";$_SESSION['login_fail']=false;} ?></div>
       <h4>Name/Username</h4>
       <input type="text" name="name" id="name" placeholder="Name/Username"  required>
       <h4>Password</h4>
       <input type="password" placeholder="Password" id="password" name="password" required>
       <input type="button" id="checkbox" class="checkbox" value="Show"> <br>
       <h4>Email</h4>
       <input type="email" name="email" id="email" placeholder="E-mail" required> <br>
       <input type="submit" name="submit" id="submit" value="Login"><br><br>
       <a href="signup.php"><button type="button" name="button" id="goback">Go back to Signup</button> </a>
     </div>
     </form>
   </body>

        <script type="text/javascript" src="javascripts/jquery.js"></script>
        <script type="text/javascript" src="javascripts/login.js"></script>
 </html>
