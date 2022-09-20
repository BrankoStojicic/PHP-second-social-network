<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>S'UP</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
     
     <?php
        
        if(isset($_POST['register_button'])){
            echo '
            <script>
                $(document).ready(function(){
                    $("#first").hide();
                    $("#second").show();
                })
            </script>
            ';
        }
    
    
     ?>
      <div class="video_container">
           <video id="bgvid" autoplay loop="true">
           <source src="assets/images/backgrounds/611180814.mp4" type="video/mp4"/>
           <source src="assets/images/backgrounds/611180814.ogg" type="video/ogg"/>
           <source src="assets/images/backgrounds/611180814.mov" type="video/mov"/>
           </video>
     </div>
        <div class="wrapper">
          <div class="login_box">
               <div class="purple_layer">
                   <div class="login_header">
                      <h1>S'UP</h1>
                      <p>login or sign up</p>
                   </div>
                   <div id="first">
                       <form action="register.php" method="POST">
                        <input type="email" name="log_email" placeholder="Email Address" value="<?php 
                        if(isset($_SESSION['log_email'])) {
                            echo $_SESSION['log_email'];
                        } 
                        ?>" required>
                        <br>
                        <input type="password" name="log_password" placeholder="Password">
                        <br>
                        <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "<span style='color: darkmagenta;'>Email or password was incorrect<span><br>"; ?>
                        <input type="submit" name="login_button" value="Login">
                        <br>
                        <a href="#" id="signup" class="signup">Need an account? Register here</a>

                    </form>
                   </div>
                    
                    <div id="second">
                        <form action="register.php" method="POST">
                        <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
                        if(isset($_SESSION['reg_fname'])) {
                            echo $_SESSION['reg_fname'];
                        } 
                        ?>" required>
                        <br>
                        <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "<span style='color: darkmagenta;'>Your first name must be between 2 and 25 characters<span><br>"; ?>




                        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
                        if(isset($_SESSION['reg_lname'])) {
                            echo $_SESSION['reg_lname'];
                        } 
                        ?>" required>
                        <br>
                        <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "<span style='color: darkmagenta;'>Your last name must be between 2 and 25 characters<span><br>"; ?>

                        <input type="email" name="reg_email" placeholder="Email" value="<?php 
                        if(isset($_SESSION['reg_email'])) {
                            echo $_SESSION['reg_email'];
                        } 
                        ?>" required>
                        <br>

                        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                        if(isset($_SESSION['reg_email2'])) {
                            echo $_SESSION['reg_email2'];
                        } 
                        ?>" required>
                        <br>
                        <?php if(in_array("Email already in use<br>", $error_array)) echo "<span style='color: darkmagenta;'>Email already in use<span><br>"; 
                        else if(in_array("Invalid email format<br>", $error_array)) echo "<span style='color: darkmagenta;'>Invalid email format<span><br>";
                        else if(in_array("Emails don't match<br>", $error_array)) echo "<span style='color: darkmagenta;'>Emails don't match<span><br>"; ?>


                        <input type="password" name="reg_password" placeholder="Password" required>
                        <br>
                        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                        <br>
                        <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "<span style='color: darkmagenta;'>Your passwords do not match</span><br>"; 
                        else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "<span style='color: darkmagenta;'>Your password can only contain english characters or numbers</span><br>";
                        else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "<span style='color: darkmagenta;'>Your password must be betwen 5 and 30 characters</span><br>"; ?>


                        <input type="submit" name="register_button" value="Sign up">
                        <br>

                        <?php if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: white;'>You're all set! Go ahead and login!</span><br>"; ?>
                        <a href="#" id="signin" class="signin">Already have account? Sign in here</a>

                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    
</body>
</html>