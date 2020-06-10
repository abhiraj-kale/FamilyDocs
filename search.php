<?php
@session_start();
unset($_SESSION['file_upload_status']);

     date_default_timezone_set('Asia/Kolkata');
    @session_start();
    $files = array(); 
    $dir = "uploads/".$_SESSION['username'];
    if(is_dir($dir)) {   //checking if dir exists
        if($opendir = opendir($dir)){  //opening dir
            while (false !== ($file = readdir($opendir))) {  //reading from dir
                if ( $file!="." && $file!=".."&& $file!="trash" && $file!="starred" && $file!="albums") {
                     $files[$dir.'/'.$file] = filemtime($dir.'/'.$file);           // pushing the element into the array
                  //  $date_create = date('F d Y h:i A', filectime($dir.'/'.$file));
                  //  $date_mod = date('F d Y h:i A', filemtime($dir.'/'.$file));
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
?>

<link rel="stylesheet" href="stylesheet/recents.css">
<table class="recents-table">
    <th>Name</th>
    <th>Date Uploaded</th>
    <th>Date Modified</th>
    <th>Size</th>
    <?php
       arsort($files);
       if(isset($_GET['search']) && !empty($_GET['search'])){
        $search = $_GET['search'];
       foreach ($files as $key => $value) {
        $filename =  basename($key);      
        $date_create = date('F d Y h:i A', filectime($key));
        $date_mod = date('F d Y h:i A', $value);
        $file_size = formatSizeUnits(filesize($key)); 
        if(strpos(strtolower($key),strtolower($search)) !== false){
           
        
  echo  $query = "<tr  class='sent-content'><td><a href='$key' id='link'>$filename</a></td><td>$date_create</td><td>$date_mod</td><td>$file_size</td><td style='width: 20px;'><img src='images/threedots.png' class='threedots' id='$key' alt='threedots' height='25px'></td></tr>";
     }
    }
}
    ?>
</table>

<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/recents.js"></script>
<script type="text/javascript" src="javascripts/home.js"></script>