<?php 
//include "../includes/db.php";

?>
<?php include "includes/admin_header.php";?>
<?php 
// include "includes/functions.php";
?>


 

<!--Using switch statement to get edit posts-->

<?php 
    
    if(isset($_GET['source'])){
        
        $source = $_GET['source'];
    }
        else {
        $source = "";
        }
    
    switch ($source){
            
        case 'add_post';
            include "addPost.php";
            break; 
        
        case 'edit_post';
            include "edit_post.php";
            break; 
        
        case '3';
            echo "jaaa";
            break;
            
        default:
            
            include "includes/viewAllPosts.php";
            
    }
    
    
?>



<?php 
// include "includes/footer.php" 
?>