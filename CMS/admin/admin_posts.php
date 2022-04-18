<?php include "includes/admin_header.php";?>

<!-- Delete comments -->
<?php
        if(isset($_GET['delete'])){

            if(isset($_SESSION['password'])){
                // stopping mysql injection unless user has admin role
                if($_SESSION['role'] == 'admin'){      

                    $comment_delete = $_GET['delete'];

                    $query = "DELETE FROM comments WHERE comment_id = {$comment_delete} ";
                    $delete_query = mysqli_query($connection, $query);
                    header( "refresh:0.1;comments.php" );
                    
                }
            }
        }
        ?>



<!-- Page Content -->



<div >
    <section id="field1">


<?php


            if(isset($_GET['p_id'])){

                $get_post_id = $_GET['p_id'];
            }


            //    Fetching data from 'posts' table and dynamically applying to blog posts

                $query = "SELECT posts.post_id, posts.post_title, posts.post_user, posts.post_date, posts.post_image, posts.post_content, ";
                $query .= "posts.post_author, users.username ";
                $query .= " FROM posts ";
                $query .= " LEFT JOIN users ON posts.post_user = users.user_id WHERE posts.post_id = {$get_post_id} ";        


            $select_all_posts = mysqli_query($connection, $query);

            while($post_row = mysqli_fetch_assoc($select_all_posts)){

                $post_title = $post_row['post_title'];
                $post_author = $post_row['username'];
                $post_date = date('d.m.Y', strtotime($post_row['post_date']));
                $post_content = $post_row['post_content'];
                $post_image = $post_row['post_image'];

?>


           
            <!-- Blog Posts -->
            <h2>
                <p id="title_t"> <?php echo $post_title ?></p>
            </h2>
             <p id="title_a" class="lead">by: <span id="title_a_a"><?php echo $post_author ?></span></p>
             <p id="title_d"><span id="title_d_d">Date:&nbsp;</span><?php echo $post_date ?></p>

                <img class="img-post_a" src="../images/<?php if(!empty($post_image)){

                                                              echo $post_image;
                                                            } else {
                                                              echo "../dImage/default_image.jpg";                 
                                                            }                   
                                                            ?>">

                <div id="title_c"><?php echo $post_content ?></div>


            <!--end the while loop-->
            <?php  }  ?>

            <hr>

            <?php 

// Insert Comments

if(isset($_POST['create_comment'])) {

    $the_post_id = $_GET['p_id'];
    $post_user = escape($_POST['post_user']);
    $comment_author = escape($_POST['comment_author']);
    $comment_content = escape($_POST['comment_content']);
    

    if (!empty($comment_author) && !empty($comment_content)) {


        $query = "INSERT INTO comments (comment_post_id, comment_author, post_user, comment_content, comment_date)";

        $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$post_user}', '{$comment_content }', now())";

        $create_comment_query = mysqli_query($connection, $query);

        if (!$create_comment_query) {
            die('QUERY FAILED' . mysqli_error($connection));


        }


    } else {
        echo '<script type="text/JavaScript"> 
        alert("You must be logged in to comment.");
        </script>';
    }

}



?>

<!-- Post Comments -->
<form action="#" method="post" role="form">
<h4 class="comment_t">Leave a Comment:</h4>
<div class="comments">
    <!-- <input type="text" name="comment_author" class="form-control" name="comment_author"> -->
    <input type="text" name="comment_author" value="<?php echo $_SESSION['username']; ?>" style="display: none">
    <input type="text" name="post_user" value="<?php echo $_SESSION['user_id']; ?>" style="display: none">
    <label for="comment" style="display: none">Leave a comment</label>
    <textarea name="comment_content" class="comment_area" style="height:60px" cols="50" rows="5"></textarea>
    <button type="submit" name="create_comment" class="comment_b" id="myAnchor">Comment here</button>
</div>

</form>
<hr class="comment_hr">







<?php 

// Select from comments table

$query = "SELECT comments.comment_id, comments.comment_post_id, comments.post_user, comments.comment_content, comments.comment_date, ";
$query .= "comments.comment_author, users.username ";
$query .= " FROM comments ";
$query .= " LEFT JOIN users ON comments.post_user = users.user_id WHERE comments.comment_post_id = {$get_post_id} ";
$query .= "ORDER BY comment_id DESC ";
$select_comment_query = mysqli_query($connection, $query);
if(!$select_comment_query) {

    die('Query Failed' . mysqli_error($connection));
 }
    while ($row = mysqli_fetch_array($select_comment_query)) {
        $comment_id = $row['comment_id'];
        $comment_date   = date('d.m.Y', strtotime($row['comment_date'])); 
        $comment_content= $row['comment_content'];
        $comment_author = $row['username'];
    
?>
    
    
    <!-- Display Comments -->
    <!-- Echo delete button -->
    <div class="comments_display">
         
       
        <div class="comments_body">
             <h4 class="comments_heading"><i class="comment_d">Name: </i> <span><?php echo $comment_author;?></span>
                <i class="comment_d">Date: </i> <span><?php echo $comment_date; ?></span> <i class="comment_d">Delete: </i><?php echo" <span><a id='delete_comment_admin' class='material-icons' href='comments.php?delete={$comment_id}'>delete</a></span>"; ?>
            </h4>
            


            <div class="container">
                <div class="dialogbox">
                    <div class="body">
                        <span class="tip tip-up"></span>
                        <div class="message">
                            <span class="comment_c"><?php echo $comment_content; ?></span>
                        </div>
                    </div>
                </div>
            </div>


            
            
        </div>
    </div>

    


<?php } 
    ?>


    </section>
</div>


<div>
<?php 
//    include "includes/sidebar.php"
?>

</div>        
<?php include "includes/footer.php";?>

<!-- Stop form resubmition -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>