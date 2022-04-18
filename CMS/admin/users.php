<?php 
//include "../includes/db.php";

?>
<?php include "includes/admin_header.php";?>


 

<!--Using switch statement to redirect to relevant pages-->

  <?php 
    
    if(isset($_GET['source'])){
        
      $source = $_GET['source'];
    }
      else {
        $source = "";
      }
    
    switch ($source){
            
        case 'add_user';
            include "includes/addUsers.php";
            break; 
        
        case 'edit_user';
            include "includes/editUsers.php";
            break; 
        
        case '3';
            echo "jaaa";
            break;
            
        default:
            
            include "includes/viewAllUsers.php";
            break;
    }
    
    
    
    ?>



<?php include "includes/footer.php" ?>