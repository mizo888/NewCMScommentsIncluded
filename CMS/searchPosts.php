




<?php include "includes\header.php";?>    




<!-- Page Content -->



<div >
  <section id="field1">



      <!--Search query for the search bar-->

<?php



if(!empty($_POST)){
      $aKeyword = explode(" ", $_POST['keyword']);

      $query = "SELECT posts.post_id, posts.post_title, posts.post_user, posts.post_date, posts.post_image, posts.post_content, ";
      $query .= "posts.post_author, users.username ";
      $query .= " FROM posts ";
      $query .= " LEFT JOIN users ON posts.post_user = users.user_id WHERE 1=1 ";
    
    for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
          $query .= " AND concat(post_title, ';', post_content) like '%" . $aKeyword[1] . "%'  ";
        }
      }  

     
    for($i = 0; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
          $query .= " AND concat(post_title, ';', post_content) like '%" . $aKeyword[0] . "%'  ";
        }
      }
    
     $result = $connection->query($query);
     if(mysqli_num_rows($result) == 0) {
        echo "<br>Nothing matching that description was found";
		
     }
        else {
          while($post_row = mysqli_fetch_assoc($result)){
            $post_id = $post_row['post_id'];
            $post_title = $post_row['post_title'];
            $post_author = $post_row['username'];
            $post_date = date('d.m.Y', strtotime($post_row['post_date']));
            $post_content = $post_row['post_content'];
            $post_image = $post_row['post_image'];



?>

   
    <!-- Blog Posts -->
    <h2>
      <a id="title_t" href="posts.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
    </h2>
      <p id="title_a" class="lead">
      by: <a id="title_a_a" href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
      </p>
      <p id="title_d"><span id="title_d_d" class="">Date:&nbsp;</span><?php echo $post_date ?></p>

      <img class="img-post" src="images/<?php if(!empty($post_image)){

                                                  echo $post_image;
                                              } else {
                                                  echo "../dImage/default_image.jpg";                 
                                              }                   
                                                  ?>">

      <div class="more"><?php echo $post_content ?></div>


    <hr>


    <!--end the while loop-->
    <?php  }  
    }

    }

    ?> 





  </section>
</div>

            
        
<div>
    <?php 
    include "includes/sidebar.php"
    ?>

</div>


<?php include "includes/footer.php";?> 

<script>

var showChar = 149;
	var ellipsestext = "...";
	var moretext = "Read more";
	var lesstext = "Read less";
	$('.more').each(function() {
	  var content = $(this).html();
	  var textcontent = $(this).text();

	  if (textcontent.length > showChar) {

	    var c = textcontent.substr(0, showChar);
	    //var h = content.substr(showChar-1, content.length - showChar);

	    var html = '<span class="container"><span>' + c + '</span>' + '<span class="moreelipses">' + ellipsestext + '</span></span><span class="morecontent">' + content + '</span>';

	    $(this).html(html);
        $(this).after('<a href="" class="morelink">' + moretext + '</a>');
	  }

	});    

	$(".morelink").click(function() {
	  if ($(this).hasClass("less")) {
	    $(this).removeClass("less");
	    $(this).html(moretext);
        $(this).prev().children('.morecontent').fadeToggle(500, function(){
          $(this).prev().fadeToggle(500);
        });
       
	  } else {
	    $(this).addClass("less");
	    $(this).html(lesstext);
        $(this).prev().children('.container').fadeToggle(500, function(){
          $(this).next().fadeToggle(500);
        });
	  }
      //$(this).prev().children().fadeToggle();
	  //$(this).parent().prev().prev().fadeToggle(500);
	  //$(this).parent().prev().delay(600).fadeToggle(500);
	  
	  return false;
	});

</script>

<!-- Stop form resubmition -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>