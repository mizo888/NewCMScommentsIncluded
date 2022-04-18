<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
    
<!--Java script to add pop up for delete post-->  
<script language="javascript" type="text/javascript">

    function getConfirmation(){

        var retVal = confirm("Are you sure you want to delete this comment ?");
        if (retVal == true){     
            return true;
        } 
            else{
              return false;
            }
    }
</script>
    
    
</head>

</html>
<div style="margin-top: 100px;">
        <h3 id="h3" style="font-family: Arial, Helvetica, sans-serif;">Blog posts list</h3>
        <!--deleting comments-->
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


    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Comment id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Post title</th>
                <th>Date</th>
                <th style="text-align: center;">Delete</th>
            </tr>
        </thead>




<?php


        // Left join and show all posts
        $query = "SELECT comments.comment_id, comments.comment_post_id, comments.post_user, comments.comment_content, comments.comment_date, ";
        $query .= "comments.comment_author, users.username ";
        $query .= " FROM comments ";
        $query .= " LEFT JOIN users ON comments.post_user = users.user_id ";
        $query .= "ORDER BY comment_id DESC ";

        $select_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['username'];     
            $comment_content = $row['comment_content'];         
            $comment_user = $row['post_user'];

            $comment_date = date('d.m.Y', strtotime($row['comment_date']));

            echo "<tr>";
            ?>    
            <?php  

            echo "<td>$comment_id </td>";
            echo "<td>$comment_author</td>";
            echo "<td style='max-width:100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis'>$comment_content</td>";

            // Relating comments to specific posts
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                $select_post_id_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_post_id_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                
                     echo "<td><a href='../posts.php?p_id=$post_id'>$post_title</a></td>";
                    }
            echo "<td>{$comment_date}</td>";
            // Echo delete button
            echo "<td style='text-align: center;'><a class='material-icons' onclick=\"return getConfirmation();\" href='comments.php?delete={$comment_id}'>delete</a></td>";
            echo "</tr>";

        }

?>



    </table>
</div>








