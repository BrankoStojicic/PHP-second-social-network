<?php

require 'config/config.php';

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}else{
    header("Location: register.php");
}

?>
<html>
<head>
    <!-- jquery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- bootstrap.js -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- my.js -->
    <script src="assets/js/my.js"></script>
    <!-- bootstrap.css -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<meta charset="UTF-8">
	<!-- content -->
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<!-- keywords -->
	<meta name="keywords" content="social network">
	<!-- description -->
	<meta name="description" content="social network">
	<!-- style -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!-- buttons -->
	<link rel="stylesheet" type="text/css" href="assets/css/custom_buttons.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Google font -->
	<link href="assets/fonts/anton/Anton-Regular.ttf" rel="stylesheet">
	<!-- title -->
	<title>'sup</title>
	
</head>
<body>


<div class="top_bar">
    <div id="logo" class="col-md-2">
        <a href="index.php"><img src="assets/images/logo/logo1.png" alt="logo s'up" height="80px" style="margin-top: 5px"></a>
    </div>
    <nav>
        <a href="#">
            <img id="logo" src="<?php echo $user['profile_pic']; ?>" alt="profile pic" width="30px" height="30px">
        </a>
        <a href="index.php">
        <i class="fa fa-home" aria-hidden="true"></i>
        </a>
        <a href="#">
        <i class="fa fa-comments" aria-hidden="true"></i>
        </a>
        <a href="#">
        <i class="fa fa-bell-o" aria-hidden="true"></i>
        </a>
        <a href="#">
        <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="#">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        </a>
        <a href="includes/handlers/logout.php">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
    </nav>
</div>
