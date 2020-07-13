<?php 
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    <link rel="stylesheet" href="stylesheet/albums.css">
</head>
<body>
 <div class="album" id="">
<div class="album-image" id="">+</div>
 <div class="album-name" id="">Create new Album</div>
 </div>
 <?php 
 
   $dir = "uploads/".$_SESSION['username'].'/albums';
   $files = array();
   
 if(is_dir($dir)) {   //checking if dir exists
    if($opendir = opendir($dir)){  //opening dir
        while (false !== ($file = readdir($opendir))) {  //reading from dir
            if ( $file!="." && $file!=".."){
                $files[$dir.'/'.$file] = filemtime($dir.'/'.$file);           // pushing the element into the array            
            }
        }
    }
}  
        if ($files=='') {
            exit();
        }
        arsort($files);
        foreach ($files as $key => $value) {
            $filename =  basename($key);      
            $firstchar = strtoupper($filename[0]);
            $dir2 = $dir.'/'.$filename;
            echo $div = "<div class='album' id='$dir2'><div class='album-image' id=''>$firstchar</div><div class='album-name' id=''>$filename<button class='not-create'></button></div></div>";
        }

 ?>
 <div class="album-options">
            <label>New Album Name:</label>
            <ul>
            <input type="search" name="new-album-name" id="new-album-name" placeholder="Enter here" maxlength="25" minlength="1">  
            </ul>
            <ul>
             <input type="button" name="new-name-submit" id="new-name-submit" value="Create">
            </ul>
 </div>
 <div class="delete-album">
     <label>Delete Album?This cannot be undone. </label>
    <br>
     <input type="button" value="Yes" id="delete-yes">
    <input type="button" value="No" id="delete-no">
    
 </div>
    </body>
</html>

<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/album.js"></script>