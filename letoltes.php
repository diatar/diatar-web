<?php

  if (!isset($_GET['letoltes'])) die("Error: missing filename...");
  $file="./" . urldecode($_GET['letoltes']);
  if(file_exists($file))
  {
    header('Content-Description: File Transfer');
    header("Content-Type: application/force-download");
    header('Content-disposition: attachment; filename='.basename($file));
    readfile($file);    
  }
  else
  {
    echo "File doesn't exist! ".$file;
  }
?>