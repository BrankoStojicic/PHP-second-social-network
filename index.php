<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


if(isset($_POST['post'])){
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}


?>

<div id="main">
    
   <div id="left-navbar" class="col-md-2">
      <div class="user_details column">
         <h3 id="stats">Stats</h3>
          <a href="#"><p id="name"><?php echo $user['first_name'] . " " . $user['last_name']; ?></p></a>
          <p id="posts">Posts: <?php echo $user['num_post']; ?></p>
          <p id="likes">Likes: <?php echo $user['num_likes']; ?></p>
      </div>
      <div class="user_details2 column">
          <?php
            
          ?>
      
      </div>
   </div> 
    <div id="interaction" class="col-md-10">
       <div id="timeline">
            <form action="index.php" class="post_form" method="post" id="form">
                <div id="main_textarea">
                    <textarea onkeyup="textAreaAdjust(this)" id="textarea" name="post_text" placeholder="Have something on your mind?" onclick="shaddow()"></textarea><br>
                    <input class="post_button" type="submit" name="post" class="button tick" value="Post" >
                </div>
            </form>
            
            <div class="posts_area">
            <img id="loading" src="assets/images/icons/loading.gif" alt="loading">
            </div>
       </div>
        <script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>
      
       <div id="chat">
            <p>chatina do later</p>
        </div>
    </div>
</div>



</body>
</html>