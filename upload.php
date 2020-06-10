<?php
include "connect.inc.php";
?>

<link rel="stylesheet" href="stylesheet/upload.css">

<div class="upload-file-icon">
   <img id='img' src="images/files-and-folders.png" alt="Upload"> 
</div>
<div class="insertfile">
<form action="home.php" method="POST" enctype="multipart/form-data" >
    <label>Insert File:<br></label> <input type="file" name="file" id="file" accept=".txt,audio/*,video/*,image/*,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple> <input type="button" name="remove" id="removefile" value="Delete" disabled><br> 
    <input type="submit" name="submit" id="submit-file" value="Upload File" disabled>
</form>
</div>
<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/uploadfile.js"></script>