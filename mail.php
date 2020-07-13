<?php
session_start();
if (!isset($_SESSION['HTTP_REFERER'])) {
  header('Location: signup.php');
}
    $_SESSION['otp']=rand(1000,9999);
    $otp =   $_SESSION['otp'];
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    // code...
    $contact_name = "Abhiraj Kale";
    $contact_email = "abhirajkale1806@gmail.com";
    $to = "$email";
    $subject = "OTP for registration";
    $body = "<html><body><h1>Hello, $name.</h1>\n<b>Your OTP for registration is :</b> <h2>$otp</h2></body></html>";
    // Set content-type header for sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  // Additional headers
  $headers .= 'From: '.$contact_name.'<'.$contact_email.'>' . "\r\n";


    if (mail($to, $subject, $body,$headers)) {
      // code...
    $_SESSION['otp_sent']=true;
   } else {
     echo "An ERROR occurred";
   }
?>
