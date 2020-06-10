<?php 
@session_start();
if((isset($_POST['albumname'])) && !empty($_POST['albumname'])){
  $file = $_POST['albumname'];
  $dir = "uploads/".$_SESSION['username'].'/albums';
  if (@!is_dir($dir)) {
      mkdir($dir);
  }
  if(@mkdir($dir.'/'.$file)){
  $firstchar = strtoupper($file[0]);
   $dir2=$dir.'/'.$file;
  echo $div = "<div class='album' id='.$dir2.'><div class='album-image' id=''>$firstchar<button class='not-create'></button></div><div class='album-name' id=''>$file</div></div>";
  $_SESSION['album_added'] = true;  
}
}

if (isset($_POST['not_create']) && !empty($_POST['not_create'])) {
  $dir = "uploads/".$_SESSION['username'].'/albums'.'/'.$_POST['not_create'];
  if(rmdir($dir)){
    echo true;
  }else{
    echo false;
  }
}

if (isset($_POST['album_file']) && !empty($_POST['album_file']) && isset($_POST['fileloc2']) && !empty($_POST['fileloc2'])) {
 $albumloc = $_POST['album_file'];
 $basename = basename($albumloc);
 $fileloc = $_POST['fileloc2'];
 $base = basename($fileloc);
 if (!file_exists('uploads'.'/'.$_SESSION['username'].'/'.'albums'.'/'.$basename.'/'.$base)) { 
  if(copy($fileloc , 'uploads'.'/'.$_SESSION['username'].'/'.'albums'.'/'.$basename.'/'.$base)){
    echo "File moved";
  }else{
   echo false;
  }
 }else{
   echo 3;
 }
}
?>