<?php 
    define('WP_USE_THEMES', false);
    require('wp-load.php');
    //$postid=834;
    
    
   
    
    echo "<h2>Woocommerce Image Retrieval (To set featured image)</h2>";
    
    echo "<h4>Enter Post ID of woocommerce product</h4>";
 ?>
    <form method="retrieve-image.php">
        Post ID:
        <input type="text" name="postid"><br/><br/>
        <input type="Submit" value="Retrieve">
    </form>
    <br/>
    <?php 
 if(isset($_GET['postid'])) {
  $postid=$_GET['postid'];


  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid), 'single-post-thumbnail' );

?>

<h2>Link To Wordpress Admin Page</h2>
<a href='http://dhinoj.co.in/wp-admin/post.php?post=<?php echo $postid;?>&action=edit&classic-editor' target="_blank">Edit</a>
<br/>
<hr/>
<h2>Featured Image</h2>
     <img height="200px" src="<?php  echo $image[0]; ?>" data-id="<?php echo $postid; ?>"><br/>
     <a href="<?php  echo $image[0]; ?>" download='imgmain'>Download</a>
    <br/>
    
<form action="retrieve-image-upload.php" method="post" enctype="multipart/form-data">
   <input type="file" name="upload_attachment[]" class="files" size="50" multiple="multiple" />
   <input type="hidden" name="postid" value="<?php echo $postid; ?>">
   <input type="submit" value="Upload Featured Image" name="submit">
</form>
    <br/>
    <a target="_blank" rel=no-follow href=https://lunapic.com/editor/?action=url&url=<?php  echo $image[0]; ?>>Edit This Image</a>

    <hr/>
    <h2>Product Images </h2>
    
    <?php
    
    
     $product_id = $postid;
    $product = new WC_product($product_id);
    $attachment_ids = $product->get_gallery_image_ids();

        
        
        foreach( $attachment_ids as $attachment_id ) {
        $image_link =wp_get_attachment_url( $attachment_id );
        //Get image show by tag <img> 
        echo '<img class="attach"  img-data="' . $attachment_id . '" height="200px" src="' . $image_link . '"><br/>';
        echo "<br/><a href='retrieve-image-post.php?postid=" . $postid . "&attachmentid=" . $attachment_id . "'>Set Featured Image</a><br/>";
          echo "<a href='retrieve-image-delete.php?postid=" . $postid . "&attachmentid=" . $attachment_id . "'>Remove</a><br/>";
        ?>
        
    <a target="_blank" rel=no-follow href=https://lunapic.com/editor/?action=url&url=<?php  echo $image_link; ?>>Edit This Image</a><br/>
        <?php 
        echo "<a href='". $image_link ."' download='img'>Download</a><br/><br/><hr/>";
       ?>
       
       
    
    <?php 
        
    }
 
} 
  

?>