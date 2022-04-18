
<?php
if(isset($_POST['update_post'])){
   header( "Location:postOptionsTable.php" );
}
  
?>
<!-- If cancel is pressed, redirect-->
<?php
if(isset($_POST['cancel'])){
   header( "Location:postOptionsTable.php ");
}
  
?>


<?php
error_reporting(0);
ini_set('display_errors', 0);
?>


<?php

//Query to get post p_id from viewAllPosts to be updated and edited
if(isset($_GET['p_id'])){
    
    $get_post_id = $_GET['p_id'];
    
    
}
//Query to display post contents in the edit post form
$query = "SELECT * FROM posts WHERE post_id = $get_post_id ";
        $select_posts_by_id = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_posts_by_id)){
           $post_id = $row['post_id'];          
           $post_author = $row['post_author'];
           $post_title = $row['post_title'];
           $post_date = date('d.m.Y', strtotime($row['post_date']));          
           $post_tags = $row['post_tags'];
           $post_content = $row['post_content'];
           $post_image = $row['post_image'];

        }

if(isset($_POST['update_post'])){   // set new values
    
    $post_title = escape ($_POST['title']);
    $post_content = escape ($_POST['post_content']);
    $post_date = escape ($_POST['date']);
    $format_date = escape (date("Y.m.d", strtotime($post_date)));
    $edit_image = escape ($_FILES['image']['name']);
    
    
//    move_uploaded_file($post_image_temp, "../images/$post_image" );
    $query_i = "SELECT * FROM posts WHERE post_id = $get_post_id ";
    $select_image = mysqli_query($connection, $query_i);
    foreach($select_image as $img_row) {
        
      if($edit_image == NULL){
          
          $image_data = $img_row['post_image'];
      
      } else { 
      
         if($image_path = "../images/".$img_row['post_image']){
             
             unlink($image_path);
             $image_data = $edit_image;
         }    
      }            
    }
    
    
    // Query to update values in edit post form
    $query = "UPDATE posts SET ";    
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_date = '{$format_date}', ";
    $query .= "post_image = '{$image_data}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = '{$get_post_id}' ";

    $result = mysqli_query($connection, $query);
    
    
    if($result){
        
        if($edit_image == NULL){
            
            echo "";
            
        } else {
            
            move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);
//            move_uploaded_file($post_image_temp, "../images/$post_image" ); 
          }    
    }        
}



if(isset($_POST['remove_image'])){
     
    $check_query = "SELECT * FROM posts WHERE post_id = $get_post_id ";
    $check_query_run = mysqli_query($connection, $query);
    if($check_query_run){
        foreach($check_query_run as $rows){
        
             $delete_image = $rows['post_image'];

                if($img_path = "../images/".$rows['post_image']){
                     unlink($img_path);
                 }                
            }     
        }
     $query = "UPDATE posts SET post_image=NULL WHERE post_image = '$delete_image' ";
     $result = mysqli_query($connection, $query);

}
    


?>

 <!--Form for updating posts-->
<div style="margin-top: 80px;">
    <form autocomplete="off" class="font" action="" method="post" enctype="multipart/form-data">
        <!-- Title and Content -->
        <div class="add_post_form"> 
            <h4 id="h4" class="font">Update blog post</h4> 
            <label class="l_cl" for="title">Title</label>
            <input onkeydown="return event.key != 'Enter';" value="<?php echo $post_title; ?>" type="text" class="df" id="fname" name="title" placeholder="Title ..">
            <label class="l_cl" for="post_content">Content</label>
            <textarea id="size" name="post_content" placeholder="Write .." class="df" style="height:330px" cols="30" rows="10"><?php echo $post_content; ?></textarea>
        </div>
        <!-- Date -->
        <div class="add_post_form_date">
            <label class="l_cl" for="date">Date</label>
            <input onkeydown="return event.key != 'Enter';" value="<?php echo $post_date; ?>" type="text" class="df" name="date" id="my_date_picker" placeholder="dd.mm.yy">
        </div>   
        <!-- Image -->
        <label class="label_e" for="">Featured image</label>
        
        <div id="reload">

            <img onerror="this.src='../dImage/default_image.jpg'" class="d_s" id="output" src="../images/<?php echo $post_image; ?>"/>
        </div> 

        <div class="add_post_form_image">
            <label class="img_file" for="file" style="cursor: pointer;" id="rem">New image</label>
            <input onkeydown="return event.key != 'Enter';" type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;">    
        </div>

        <!--used for redirecting an image to <img> tag instead loading an image next to input type=file-->
        <script> 
        var loadFile = function(event) {           
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        </script>
        <!-- Update and Cancel form buttons -->
        <div class="add_post_form_publish">
            <input onkeydown="return event.key != 'Enter';" onclick="history.go(-1)" class="btn_pub" type="submit" value="Cancel" name="cancel">
            <input onkeydown="return event.key != 'Enter';" onclick="javascript: preventDefault();" id="u_post" type="submit" value="Update post" name="update_post">    
        </div> 

    </form>
</div>


<!-- Remove image button form -->
<form action="" method="post">
    <input type="hidden" name="delete_id" value="<?php echo $row['post_id'] ?>">
    <button id="press" class="img_rem_r" name="remove_image">Remove image</button>  
</form>

<script> 
//used for removing image in edit_post page
//   $("#press").click(function(e) {
//   e.preventDefault(); 
//   $('#output').attr('src', "");   
//   $("#file").val("");
// });
</script>
 
<!--DATE PICKER-->
<script type="text/javascript">
    $(function () {
        $('#my_date_picker').datepicker({ dateFormat: 'dd.mm.yy' });
    });
</script>
 

