<?php include "includes/db.php";?>
<?php session_start(); ?>
<?php
//error_reporting(0);
?>

<?php



if(isset($_POST['login'])){
  // Getting data from login page
  $l_message = '';
  $username = $_POST['username'];
  $password = $_POST['password'];                  

    
  if(!empty($username) && !empty($password)){

  $username = mysqli_real_escape_string($connection, $username );
  $password = mysqli_real_escape_string($connection, $password );


  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($select_user_query) != 0){

      while($row = mysqli_fetch_array($select_user_query)){
      
          $db_id = $row['user_id'];
          $db_username = $row['username'];
          $db_password = $row['password'];
          $db_role = $row['role'];
    
    }


//Redirecting users based on their credentials
if(password_verify($password, $db_password)){
    
    $_SESSION['username'] = $db_username;
    $_SESSION['password'] = $db_password;
    $_SESSION['role'] = $db_role;
    $_SESSION['user_id'] = $db_id;
    
        header("Location: ./admin ");    
} else {
      $l_message = 'Invalid password';
  }

         
}
    else {  
      $l_message = "Invalid username";  
    }


  } else {  
      $l_message = "* Fields are required!";  
    }
} else {  
    $l_message = "";  
  }

?>






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




<!-- Login form -->
<body class="login_bgrnd">
    

  <div class="login_form">
    <form action="" method="post">
      <span class="v_span"><?php echo $l_message; ?></span>
      <br>
      <br>
      <br>
      <label class="cl_c" for="username">Username</label>
      <span style="color:red;">*</span>
      <input  type="text" id="pw_l" name="username" placeholder="username ..">

      <label class="cl_c" for="password">Password</label>
      <span style="color:red;">*</span>
      <input  type="password" id="pw_l" name="password" placeholder="password ..">

      <button class="btn_login" type="submit" name="login">Proceed to login</button>
    </form>
  </div>
    
   
</body>
</html>
