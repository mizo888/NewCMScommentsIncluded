<?php include "includes/db.php";?>
<?php include "includes/functions.php";?>
<?php session_start();?>



<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>CMS Page</title>

<link rel="stylesheet" href="css/css.css" type="text/css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
  

<body class="body_c"> 


<div class="navbar" id="navbar">

<!-- Showing user home button based on session -->
<?php

if(isset($_SESSION['password'])){
  if($_SESSION['role'] === 'subscriber') {
      ?>
      <a class="lg_out_main_home" href="index.php">Home</a>
      <?php }}  ?>
        
<!-- Redirecting admin back to admin homepage -->
<?php

if(isset($_SESSION['password'])){
  if(($_SESSION['role'] === 'admin') && !empty($_SESSION['username'])) {
      ?>
          <div class="dropdown">
        
        <a class="dropbtn_a" href="javascript:void(0)">Blog management  <i class="fa fa-caret-down"></i></a>
      
        <div class="dropdown-content">
          <a href="admin/postOptionsTable.php">Blog posts list</a>
          <a href="admin/users.php">Users</a>
          <a href="admin/comments.php">Comments</a>
          <a href="admin/index.php">Home</a>
        </div>
      
      </div>
      <?php } }else { ?>
        <a class="lg_out_main_home" href="index.php">Home</a>
      <?php } ?>

  
    
      <!--  Hiding or showing login/logout button based on session status        -->
      <?php if(isset($_SESSION['username']) && !empty($_SESSION['username']) )
      {
      ?>
          <a class="lg_out_main_u" style="float: right" href="includes/logOut.php">Logout</a>
          <!-- <a class="lg_out_main_u_u" style="float: right" href="includes/logOut.php">Logout</a> -->
          <div id="press" ><i class="w_message_u">Logged in:&nbsp;<?php echo $_SESSION['username'];?></i></div>
      <?php }else { ?>
          <a style="" class="lg_out_main_reg_u"  href="registerPage.php"><i class="fa fa-file-text-o">&nbsp;&nbsp;&nbsp;</i> Register</a> 
          <a class="lg_out_main_l" style="float: right" href="login.php">Login</a>     
      <?php } ?>
   
   

</div>


<script>
    When the user scrolls the page, execute myFunction
    window.onscroll = function() {myFunction()};

    Get the navbar
    var navbar = document.getElementById("navbar");

    Get the offset position of the navbar
    var sticky = navbar.offsetTop;

    Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    } 
</script>