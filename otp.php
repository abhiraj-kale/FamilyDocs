<?php
require 'connect.inc.php';
ob_start();
session_start();

if ($_SESSION['otp_sent']==false) {
  // code...
  header('Location: signup.php');
}

if (isset($_GET['sendmail'])) {
  include 'mail.php';
    header('Location: otp.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link rel="stylesheet" href="stylesheet/otp.css">
  <body>
    <div class="signup">
      <div class="otp" id="otp" >

          <div class="otp-lbl">
            <label id="lbl-1" class="lbl">An OTP has been sent to <?php echo $_SESSION['email'] ?>.</label><br>
            <label id="lbl-2" class="lbl">Please DO NOT share it with anyone.</label>
          </div>
        <input type="text" id="inp_otp" class="inp_otp" name="otp" placeholder="Enter OTP" maxlength="4" minlength="4"> <br>
        <label id="lbl2" class="lbl2"></label><br>
        <input type="button" name="button" value="Submit" id="button">
        <a href="signup.php"><input type="button" value="Go back"></a>
         <br>
          <label class="lbl">Didn't receive an OTP?</label><a id="sendagain" href="otp.php?sendmail=again" >  Click here  </a><label class="lbl">to send again.</label><br>
      </div>
    </div>
    <script type="text/javascript" src="javascripts/jquery.js"></script>
    <script type="text/javascript" src="javascripts/otp.js"></script>
  </body>
</html>
