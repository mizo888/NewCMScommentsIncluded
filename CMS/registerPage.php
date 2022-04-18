<?php include "includes/db.php";?>
<?php require_once "includes/functions.php";?>

<!--Register new users-->
<?php

if(isset($_POST['register'])){
    
    $username = trim($_POST['username']);     
    $password = trim($_POST['password']);
 
    
    
    if(!empty($username) && !empty($password)){
        
        
        $username = mysqli_real_escape_string($connection, $username );
        $password = mysqli_real_escape_string($connection, $password );

        
        // Hash password
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));    
      
        
        
        $query = "SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
    
            if(mysqli_num_rows($result) == 0){
            
                $query = "INSERT INTO users (username, password ) ";
                $query .= "VALUES ('{$username}','{$password}' ) ";
                $register_user_query = mysqli_query($connection, $query);    
        
                $message = "Your registration has been submited";
                header( "refresh:1;url=index.php" );
            }

            else { 
                $message = "That username already exists!"; 
            }    
        

      
    } else{  
        $message = "* Fields cannot be empty";    
    }
    
} else {  
    $message = "";  
  }


?>






<!-- Register form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/css.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>
<body>
    

    <div class="login_form">
        <form action="registerPage.php" method="post">
            <span class="v_span"><?php echo $message; ?></span>
            <br>
            <br>
            <br>
            <label for="username">Username</label>
            <span style="color:red;">*</span>
            <input type="text" id="" class="pw_reg" name="username" placeholder="username ..">

            <label for="password">Password</label>
            <span style="color:red;">*</span>
            
            <input autocomplete="off" class="pw_reg" type="password" id="" name="password" placeholder="password ..">
            
            <button class="btn_login" type="submit" name="register">Register</button>
        </form>
    </div>

    
</body>
</html>



