<?php 

date_default_timezone_set('Asia/Kolkata');
@session_start();

if(isset($_POST['data']) && !empty($_POST['data'])){
    $file = $_POST['data']; 
        if(unlink($file)){
            echo true;
        }else {
            echo false;
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to album</title>
</head>
<link rel="stylesheet" href="stylesheet\add-albums.css">
<body>
      
    
<table class="recents-table">

    <?php
         
         function formatSizeUnits($bytes)
         {
             if ($bytes >= 1073741824)
             {
                 $bytes = number_format($bytes / 1073741824, 2) . ' GB';
             }
             elseif ($bytes >= 1048576)
             {
                 $bytes = number_format($bytes / 1048576, 2) . ' MB';
             }
             elseif ($bytes >= 1024)
             {
                 $bytes = number_format($bytes / 1024, 2) . ' KB';
             }
             elseif ($bytes > 1)
             {
                 $bytes = $bytes . ' BYTES';
             } 
             elseif ($bytes == 1)
             {
                 $bytes = $bytes . ' BYTE';
             }
             else
             {
                 $bytes = '0 BYTES';
             }
         
             return $bytes;
         }
 

        if(isset($_POST['folder_loc']) && !empty($_POST['folder_loc'])){
            $files = array(); 
            $dir = $_POST['folder_loc']; 
        $base = basename($dir);
        echo '<div class="top-options"><img src="images/go-back.png" alt="go-back" id="go-back-img"><label class="head-album">'.$base.'</label></div>';
        echo '<hr>';    
        echo "<th>Name</th>
        <th>Date Uploaded</th>
        <th>Date Modified</th>
        <th>Size</th>";
        
       
      
        if(is_dir($dir)) {   //checking if dir exists
            if($opendir = opendir($dir)){  //opening dir
                while (false !== ($file = readdir($opendir))) {  //reading from dir
                    if ( $file!="." && $file!="..") {
                         $files[$dir.'/'.$file] = filemtime($dir.'/'.$file);           // pushing the element into the array
                      //  $date_create = date('F d Y h:i A', filectime($dir.'/'.$file));
                      //  $date_mod = date('F d Y h:i A', filemtime($dir.'/'.$file));
                    }
        
                }
            }
        }
       
       arsort($files);
       foreach ($files as $key => $value) {
        $filename =  basename($key);      
        $date_create = date('F d Y h:i A', filectime($key));
        $date_mod = date('F d Y h:i A', $value);
        $file_size = formatSizeUnits(filesize($key)); 
  echo  $query = "<tr class='$dir' ><td><a href='$key' id='link'>$filename</a></td><td>$date_create</td><td>$date_mod</td><td>$file_size</td><td style='width: 20px;'><img src='images/delete-icon.png' class='delete-inside' id='$key' alt='delete' height='25px'></td></tr>";
     }
 }    

 if (isset($_POST['fileadd']) && !empty($_POST['fileadd'])) {
    $dir = 'uploads/'.$_SESSION['username'].'/'.'albums';
    $files = array(); 
$base = basename($dir);

if(is_dir($dir)) {   //checking if dir exists
    if($opendir = opendir($dir)){  //opening dir
        while (false !== ($file = readdir($opendir))) {  //reading from dir
            if ( $file!="." && $file!="..") {
                 $files[$dir.'/'.$file] = filemtime($dir.'/'.$file);           // pushing the element into the array
              //  $date_create = date('F d Y h:i A', filectime($dir.'/'.$file));
              //  $date_mod = date('F d Y h:i A', filemtime($dir.'/'.$file));
            }

        }
    }
}

arsort($files);
foreach ($files as $key => $value) {
$filename =  basename($key);      
$date_create = date('F d Y h:i A', filectime($key));
$date_mod = date('F d Y h:i A', $value);
$file_size = formatSizeUnits(filesize($key)); 
echo  $query = "<tr class='add_album_row' id='$key' ><td  style='width: 30px;'>$filename</td><td  style='width: 30px;'><img src='images/add-album.png' id='$key' alt='delete' height='20px'></td></tr>";
}
} 
    ?>
</table>

<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/addalbum.js"></script>

</body>
</html>