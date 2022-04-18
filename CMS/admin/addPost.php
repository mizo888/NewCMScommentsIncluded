<?php include "includes/admin_header.php";?>




<?php
if(isset($_POST['create_post'])){
   header( "refresh:0.1;postOptionsTable.php" );
    }
  
?>







<?php
   
//Query to insert data into add posts form
   if(isset($_POST['create_post'])) {
   

            
            $post_title = escape ($_POST['title']);
            $post_author = escape ($_POST['author']);
            $post_user = escape ($_POST['post_user']);
            $post_content = escape ($_POST['post_content']);  
            $post_date = escape ($_POST['date']);
            $format_date = escape (date('Y.m.d', strtotime($post_date)));
            $post_image = ($_FILES['image']['name']);
            $post_image_temp = ($_FILES['image']['tmp_name']);
       
            move_uploaded_file($post_image_temp, "../images/$post_image" );

            $query = "INSERT INTO posts(post_title, post_date, post_user, post_author, post_image, post_content) ";
            $query .= "VALUES('{$post_title}', '{$format_date}', '{$post_user}', '{$post_author}', '{$post_image}','{$post_content}' ) ";

            $create_post_query = mysqli_query($connection, $query);  
   }



?>


<div style="margin-top: 80px;">

    <!--addPost form-->

    <form autocomplete="off"  class="font" action="" method="post" enctype="multipart/form-data">
        <!-- Title and Content -->
        <div class="add_post_form"> 
            <h4 id="h4" class="font">New blog post</h4>
            <label class="l_cl" for="title">Title</label>
            <span style="color:red;">*</span>
            <input onkeydown="return event.key != 'Enter';" type="text" id="fname" class="df" name="title" placeholder="Title .." required>
        
            <label class="l_cl" for="post_content">Content</label>
            <span style="color:red;">*</span>
            <div>
            <textarea  id="size" class="df" name="post_content" placeholder="Write .." style="height:330px" cols="30" rows="10" required></textarea>
            </div>
            
            
            <!--Displaying current user id from posts table ---post_user--- row based on session-->
            <input type="text" name="post_user" value="<?php echo $_SESSION['user_id']; ?>" style="display: none">


            
            <!--Displaying author name in blogs based on session-->
            <input type="text" id="fname" name="author" value="<?php echo $_SESSION['username']; ?>" placeholder="author" required style="display: none">  

        </div>
 
  
        <!-- Date -->
        <div class="add_post_form_date">
            <label class="l_cl" for="date">Date</label>
            <span style="color:red;">*</span>
            <input onkeydown="return event.key != 'Enter';" type="text" id="my_date_picker" class="df" name="date" value="<?php echo date("d.m.Y") ?>" required>
        </div> 

        <!-- Image -->
        <div id="reload">
            <img label="sdsd" class="d_s" id="output" />
        </div> 
        <label class="label" for="">Featured image</label>
        <div class="add_post_form_image">
            <label  class="img_file" for="file" style="cursor: pointer;" id="rem">Select image</label>
            <input onkeydown="return event.key != 'Enter';"  type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;">    
            <a class="img_rem" id="removeImage" href="#">Remove image</a>
        </div>

    

        <!-- used for showing an image-->
        <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        </script>
    
        <div class="add_post_form_publish" id="input-icons">
            <input onkeydown="return event.key != 'Enter';" class="btn_pub" onclick="history.go(-1)" type="submit" value="Cancel" name="cancel">
            <i class="fa fa-pencil"></i>
            <input onclick="return getConfirmation()" onkeydown="return event.key != 'Enter';" class="input-field" id="u_post" type="submit" value="Publish post" name="create_post" >    
        </div> 

    </form>
</div>


<script>
    
    //used for removing image in addPost page
   
   $("#removeImage").click(function(e) {
   e.preventDefault(); 
   $('#output').attr('src', ""); /
   $("#file").val(""); 

 });
    

</script>

    <!--DATE PICKER-->
<script type="text/javascript">
    $(function () {
        $('#my_date_picker').datepicker({ dateFormat: 'dd.mm.yy' });
    });
</script>

  
<!--  upload default image--> 
<script>
 $('img').on('error', function sd(){
      $(this).attr('src', '../dImage/default_image.jpg');
  });       
</script>

<!--Validate publish post-->
<script language="javascript" type="text/javascript">

    function getConfirmation()
    {
        var retVal = confirm("Are you sure you want to publish this post ?");
        if (retVal == true)
        {
            
            return true;
        } 
        else
        {
            
            return false;
        }
    }
</script>


