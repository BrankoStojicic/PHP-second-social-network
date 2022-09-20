
<html>
<head>
	<meta charset="UTF-8">
	<title>
	</title>
	<!-- font -->
	<link href="assets/fonts/anton/Anton-Regular.ttf" rel="stylesheet">
	<!-- style -->
	<style>
        body{
            font-family: 'Anton', sans-serif;
            word-wrap: break-word;
        }
        #comment_textarea{
            height: 45px;
            background-color: rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 100%;
            border: 0;
            border-bottom: 1px solid black;
            text-align: center;
            border: 1px solid black;
            border-radius: 5px;
            font-family: 'Anton', sans-serif;
           
        }
        .comment_section img{
            padding: 10px;
        }
        .comment_section hr{
            width: 90%;
            color: #00fff6;
            box-shadow: 0px -2px 6px 1px rgb(255, 255, 255);
            background-color: #00fff6;
            border: 1px solid #00fff6;

        }
        .comment_section a{
            text-decoration: none;
            color: dimgray;
        }
        .post_button{
            margin: 4px;
            color: black;
            width: 50px;
            height: 30px;
            float: right;
            border: 1px solid black;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            -webkit-transition:box-shadow 0.4s;
            -moz-transition:box-shadow 0.4s;
            -o-transition:box-shadow 0.4s;
            transition:box-shadow 0.4s;
        }
        .post_button:hover{
            color: white;
            border: 1px solid white;
            text-decoration: none;
            box-shadow: 0px 0px 10px 0px black;
        }
        
        a:hover{
            color: black;
            text-decoration: none;
            transition:text-shadow 0.5s;
            text-shadow: 2px 2px 3px black;
        }
    </style>
</head>
<body>
    <?php

    require 'config/config.php';
    
    include("includes/classes/User.php");
    include("includes/classes/Post.php");

    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }else{
        header("Location: register.php");
    }

    ?>
    <script>
        function toogle(){
            var element = document.getElementById("comment_section");
            if(element.style.display == "block"){
                element.style.display = "none";
            }else{
                element.style.display = "block";
            }
        }
    </script>
    <?php
        //Get id of post
        if(isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];
        }
    $user_query = mysqli_query($con, "SELECT added_by, user_to FROM posts WHERE id='$post_id'");
    $row = mysqli_fetch_array($user_query);
    
    $posted_to = $row['added_by'];
    
    if(isset($_POST['postComment' . $post_id])){
        $post_body = $_POST['post_body'];
        $post_body = mysqli_escape_string($con, $post_body);
        $date_time_now = date("Y-m-d H:i:s");
        $insert_post = mysqli_query($con, "INSERT INTO comments VALUES('', '$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', 'no', '$post_id')");
        echo "<p>Comment Posted!</p>";
    }
    
    ?>
    
    <form action="comment_frame.php?post_id=<?php echo $post_id ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
        <textarea id="comment_textarea" name="post_body"></textarea>
        <input type="submit" class="post_button" name="postComment<?php echo $post_id; ?>" value="Post">
    </form>
    <br>
    <!-- Load Comments -->
   <?php  
	$get_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id DESC");
	$count = mysqli_num_rows($get_comments);

	if($count != 0) {

		while($comment = mysqli_fetch_array($get_comments)) {

			$comment_body = $comment['body'];
			$posted_to = $comment['posted_to'];
			$posted_by = $comment['posted_by'];
			$date_added = $comment['date_added'];
			$removed = $comment['removed'];

			//Timeframe
			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($date_added); //Time of post
			$end_date = new DateTime($date_time_now); //Current time
			$interval = $start_date->diff($end_date); //Difference between dates 
			if($interval->y >= 1) {
				if($interval == 1)
					$time_message = $interval->y . " year ago"; //1 year ago
				else 
					$time_message = $interval->y . " years ago"; //1+ year ago
			}
			else if ($interval->m >= 1) {
				if($interval->d == 0) {
					$days = " ago";
				}
				else if($interval->d == 1) {
					$days = $interval->d . " day ago";
				}
				else {
					$days = $interval->d . " days ago";
				}


				if($interval->m == 1) {
					$time_message = $interval->m . " month". $days;
				}
				else {
					$time_message = $interval->m . " months". $days;
				}

			}
			else if($interval->d >= 1) {
				if($interval->d == 1) {
					$time_message = "Yesterday";
				}
				else {
					$time_message = $interval->d . " days ago";
				}
			}
			else if($interval->h >= 1) {
				if($interval->h == 1) {
					$time_message = $interval->h . " hour ago";
				}
				else {
					$time_message = $interval->h . " hours ago";
				}
			}
			else if($interval->i >= 1) {
				if($interval->i == 1) {
					$time_message = $interval->i . " minute ago";
				}
				else {
					$time_message = $interval->i . " minutes ago";
				}
			}
			else {
				if($interval->s < 30) {
					$time_message = "Just now";
				}
				else {
					$time_message = $interval->s . " seconds ago";
				}
			}

			$user_obj = new User($con, $posted_by);


			?>
			<div class="comment_section">
				<a href="<?php echo $posted_by?>" target="_parent">
				    <img src="<?php echo $user_obj->getProfilePic();?>" title="<?php echo $posted_by; ?>" style="float:left;" height="30"></a>
				<a href="<?php echo $posted_by?>" target="_parent">
				    <p> <?php echo $user_obj->getFirstAndLastName(); ?> </p>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message . "<br>" . $comment_body; ?> 
				<hr>
			</div>
			<?php

		}
	}
	else {
		echo "<center><br><br>No Comments to Show!</center>";
	}

	?>

    
    
</body>
</html>