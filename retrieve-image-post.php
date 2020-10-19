<?php 
    define('WP_USE_THEMES', false);
    require('wp-load.php');
    
  
  $postid=$_GET["postid"];
  $attachmentid=$_GET["attachmentid"];
    
    
    $success = set_post_thumbnail( $postid, $attachmentid );
    header("Location: retrieve-image.php?postid=" . $postid);

  

?>