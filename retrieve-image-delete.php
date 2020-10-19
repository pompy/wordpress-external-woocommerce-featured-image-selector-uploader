<?php 
    define('WP_USE_THEMES', false);
    require('wp-load.php');
    
  
  $postid=$_GET["postid"];
  $attachmentid=$_GET["attachmentid"];
    
    wp_delete_attachment($attachmentid,true);
    
    header("Location: retrieve-image.php?postid=" . $postid);

  

?>