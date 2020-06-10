<?php
session_start();

if(isset($_GET['filedel']) && !empty($_GET['filedel'])) {
    $filedel = $_GET['filedel'];
    if(unlink($filedel)){
        echo true;
    }else{
        echo false;
    }  
}

if(isset($_GET['fileloc']) && !empty($_GET['fileloc']) ){
     $fileloc = $_GET['fileloc'];
    $trash = 'uploads/'.$_SESSION['username'].'/trash';
    if (!is_dir($trash)) {
        mkdir($trash);
    } 
     $basename = basename($fileloc);
    if (rename($fileloc,$trash.'/'.$basename)) {
        echo true;
    }else{
        echo false;
    }
}
?>


<link rel="stylesheet" href="stylesheet/recents.css">
<table class="recents-table">
    <th>Name</th>
    <th>Date Uploaded</th>
    <th>Date Modified</th>
    <th>Size</th>
   <?php
        date_default_timezone_set('Asia/Kolkata');
        $files = array();
        $dir = "uploads/".$_SESSION['username'].'/trash';
        if(!is_dir($dir)){
            mkdir("uploads/".$_SESSION['username'].'/trash');
        }
        if(is_dir($dir)) {   //checking if dir exists
            if($opendir = opendir($dir)){  //opening dir
                while (false !== ($file = readdir($opendir))) {  //reading from dir
                    if ( $file!="." && $file!=".."&& $file!="trash"&& $file!="albums") {
                         $files[$dir.'/'.$file] = filemtime($dir.'/'.$file);           // pushing the element into the array
                    
                    }
        
                }
            }
        }
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

       arsort($files);
        foreach ($files as $key => $value) {
            $filename =  basename($key);      
            $date_create = date('F d Y h:i A', filectime($key));
            $date_mod = date('F d Y h:i A', $value);
            $file_size = formatSizeUnits(filesize($key));    
      echo  $query = "<tr class='sent-content'><td><a href='$key' id='link'>$filename</a></td><td>$date_create</td><td>$date_mod</td><td>$file_size</td><td style='width: 20px;'><img src='images/threedots.png' class='three_dots1' id='$key' alt='three_dots1' height='25px'></td></tr>";         
       }
    ?>
</table>


<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/trash.js"></script>
<script type="text/javascript" src="javascripts/home.js"></script>