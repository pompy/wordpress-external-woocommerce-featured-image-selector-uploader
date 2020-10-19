<?php 
    define('WP_USE_THEMES', false);
    require('wp-load.php');
    
  
  $postid=$_POST["postid"];
    
    
    ?>
    
    <?php
// Upload Multiple Image to Media Library in WordPress Front End
if ($_FILES)
{
 $files = $_FILES['upload_attachment'];
 foreach($files['name'] as $key => $value)
 {
 if ($files['name'][$key])
 {
 $file = array(
 'name' => $files['name'][$key],
 'type' => $files['type'][$key],
 'tmp_name' => $files['tmp_name'][$key],
 'error' => $files['error'][$key],
 'size' => $files['size'][$key]
 );
 $_FILES = array(
 "upload_attachment" => $file
 );
 foreach($_FILES as $file => $array)
 {
  $attachmentid = upload_user_file($array);
    
     $success = set_post_thumbnail( $postid, $attachmentid );

 }
 }
 }
}




// Upload Multiple Image to Media Library in WordPress Front End
function upload_user_file($file = array())
{
 require_once (ABSPATH . 'wp-admin/includes/admin.php');
 
 $file_return = wp_handle_upload($file, array(
 'test_form' => false
 ));
 if (isset($file_return['error']) || isset($file_return['upload_error_handler']))
 {
 return false;
 }
 else
 {
 $filename = $file_return['file'];
 $attachment = array(
 'post_mime_type' => $file_return['type'],
 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)) ,
 'post_content' => '',
 'post_status' => 'inherit',
 'guid' => $file_return['url']
 );
 $attachment_id = wp_insert_attachment($attachment, $file_return['url']);
 require_once (ABSPATH . 'wp-admin/includes/image.php');
 
 $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
 wp_update_attachment_metadata($attachment_id, $attachment_data);
 if (0 < intval($attachment_id))
 {
 return $attachment_id;
 }
 }
 return false;
}

?>

    
    <?php 
    header("Location: retrieve-image.php?postid=" . $postid);

  

?>