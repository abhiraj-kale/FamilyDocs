<?php
require 'connect.inc.php';
require 'core.inc.php'; 
ob_get_contents();
ob_end_clean();

if ($_SESSION['logged_in']!= true) {
  header('Location: login.php');
}
if (isset($_GET['logout'])) {
  $_SESSION['login_fail']=false;
  header('Location: login.php');
}
unset($_SESSION['file_upload_status']);

if (isset($_FILES["file"]["name"])) {
        // Validate image file size
        if ((@$_FILES["file"]["size"] > 5242880)) {
          $msg = "File Size can't be greater than 5 MB.";
          $_SESSION['file_upload_status'] = false;
          header("Location: error.php?error=".$msg);
          exit();
        }

  $name = $_FILES["file"]["name"];

  $allowed = array('txt','gif', 'png', 'jpg','ppt','pdf','jpeg','doc','docx','mp3','wav','m4a','m4b','aa','mp4','MPEG');
  $ext = pathinfo($name, PATHINFO_EXTENSION);

  if (!in_array($ext, $allowed)) {
    $_SESSION['file_upload_status'] = false;
    $a=3;
    header('Refresh');
 }else{

    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

    if (!empty($name)) {
        $dir = "uploads/".$_SESSION['username'];
          if(is_dir($dir)){
            $location = $dir.'/';
          }else{
            mkdir($dir);
            $location = $dir.'/';
          }
        if  (move_uploaded_file($tmp_name, $location.$name)){
            $_SESSION['file_upload_status'] = true;
            header('Location: home.php');
        }

    }
  
    
}
 }

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Home</title>
     <link rel="stylesheet" href="stylesheet/home.css">
   </head>
   <body>
      <div id="pop-up">
          <label id="pop-up-lbl"></label> <br>
          <button>Yes</button>
          <button>No</button>
        </div>
        <div id="pop-up-2">
          <label id="pop-up-2-lbl"></label><br>
        </div>
     <div class="header">
       <div class="logo">
        <label id="header">Family</label><label id="docs">Docs</label><label id="in">.in</label> 
      </div>
      <div class="header-center">
     <label id="search-label">Search:</label> <input type="search" name="search" id="search" placeholder="Search uploaded Documents.."><input type="button" id="go" value="GO">
    </div>
      <div class="header-right">
      <img src="images/profile-icon.png" alt="profile" height="40px" width="40px" id="profile-icon"/>
      <input type="button" name="log-out" id="log-out" value="Log out">
      </div> 
    </div>

    <div class="search-div-outer">
          <div class="triangle-up">

          </div>
          <div class="search-div-inner">

          </div>
      </div>

     <div class="left-div">
        <table class="options">
         <tr id="upload-row"><td><input type="button" name="upload" id="upload" value="Upload"></td></tr> 
          <tr><td><input type="button" name="recents" id="recents" value="Recents"></td> </tr>
          <tr><td><input type="button" name="albums" id="albums" value="Albums"></td> </tr>
          <tr><td><input type="button" name="starred" id="starred" value="Starred"></td> </tr>
          <tr><td><input type="button" name="trash" id="trash" value="Trash"></td> </tr>
        </table>
     </div>
     <div class="center-div">
        <div class="center-up">
          <label id="lbl2"><?php 
          if(isset($_SESSION['file_upload_status'])){
            if ($_SESSION['file_upload_status'] == false) {
              echo "Upload"; 
            }
          }else{
            echo "Recents";
          }
         
          ?>
          </label>
        </div>
        <hr>
        <div class="center-down"> 
        <div id="background">
            <p id="bg-text">Nothing here.</p>
        </div>
        <label id="lbl"> 
        <?php 
            if(isset($_SESSION['file_upload_status']) && $_SESSION['file_upload_status'] == true){
                echo "File Uploaded Successfully.";
                $_SESSION['file_upload_status'] = false;
                $a=1;
            }else if(isset($_SESSION['file_upload_status']) && $_SESSION['file_upload_status'] == false){
              echo "File could not be uploaded.";
                $a = 2;
            }
            else{
              $a = 3;
            } 
            ?>
        </label>    
            <?php 
            global $a;
            if($a==1 || $a==2){
              require "upload.php";
            }else if($a==3){
              require "recents.php";
            }
            ?>          
        </div>
        <div class="three-options">
            
            <ul>
         <input type="button" name="" id="album" value="Add to Album">     
            </ul>
            <ul>
                 <input type="button" name="" id="star" value="Star this File">   
            </ul>
             <ul>
                  <input type="button" name="" id="delete" value="Move to Trash">   
             </ul>
             <ul>
                  <input type="button" name="" id="share" value="Share">   
             </ul>
          
      </div>
      <div class="three_options">
             <ul>
                  <input type="button" name="" id="delete_per" value="Delete Permanently">   
             </ul>      
      </div>
      <div class="three_options2">
             <ul>
                  <input type="button" name="" id="unstar" value="Remove from Starred">   
             </ul>      
      </div>
 
     </div>
     <div class="right-div">
            <div class="right-up">
            <label><?php echo $_SESSION['name'];?></label>
            <p>Last Log-in:<br><?php date_default_timezone_set('Asia/Kolkata'); echo  $_SESSION['login-time']; ?> </P>
            <label class='timeout'></label>
            <hr>  
          </div>
            <div class="right-down">
            <label id="down-label">Select the Album:</label>
            </div>
            
     </div>
            
   </body>
   <script type="text/javascript" src="javascripts/jquery.js"></script>
   <script type="text/javascript" src="javascripts/home.js"></script>
  </html>
