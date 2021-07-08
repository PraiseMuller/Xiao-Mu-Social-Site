<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xiao Mu</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>

    <!-- stay on current page if erros are printed-->
    <?php
    if (isset($_POST['register_button'])) {
        echo "
                <script>
                    $(document).ready(function(){
                        $('#first').hide();
                        $('#second').show();
                    });
                </script>
            ";
    }
    ?>

    <div class="wrapper">
        <div class="login_box">
            <!-- header -->
            <div class="login_header">
                <h2>Xiao Mu</h2>
                <p>Login Or Signup below !</p>
            </div>
            <div id="first">
                <!-- LOGIN FORM -->
                <form method="POST" action="register.php">
                    <?php if (in_array("Email or password is incorrect<br>", $error_array)) echo "<br>Email or password is incorrect<br>"; ?>
                    <input type="email" name="log_email" placeholder="Email Address" value="<?php if (isset($_SESSION['log_email'])) {
                                                                                                echo $_SESSION['log_email'];
                                                                                            } ?>" required>
                    <br>
                    <input type="password" name="log_password" placeholder="Password" required>
                    <br>
                    <input type="submit" name="login_button" value="Login">
                    <br>
                    <a href="#" id="signup" class="signup">Dont have an account? Signup!</a>
                </form>
            </div>

            <div id="second">
                <!-- REGISTRATION FORM -->
                <form action="register.php" method="POST">
                    <!-- FIRSTNMAE -->
                    <input type="text" name="reg_fname" placeholder="Firstname" value="<?php if (isset($_SESSION['reg_fname'])) {
                                                                                            echo $_SESSION['reg_fname'];
                                                                                        } ?>" required>
                    <br>

                    <?php if (in_array('Firstname must be between 2 and 25 characters<br>', $error_array)) echo 'Firstname must be between 2 and 25 characters<br>'; ?>

                    <!-- LASTNAME -->
                    <input type="text" name="reg_lname" placeholder="Lastname" value="<?php if (isset($_SESSION['reg_lname'])) {
                                                                                            echo $_SESSION['reg_lname'];
                                                                                        } ?>" required>
                    <br>

                    <?php if (in_array('Lastname must be between 2 and 25 characters<br>', $error_array)) echo 'Lastname must be between 2 and 25 characters<br>'; ?>

                    <!-- EMAIL -->
                    <input type="email" name="reg_email" placeholder="Email" value="<?php if (isset($_SESSION['reg_email'])) {
                                                                                        echo $_SESSION['reg_email'];
                                                                                    } ?>" required>
                    <br>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if (isset($_SESSION['reg_email2'])) {
                                                                                                    echo $_SESSION['reg_email2'];
                                                                                                } ?>" required>
                    <br>

                    <?php if (in_array("Email is already in use<br>", $error_array)) echo "Email is already in use<br>";
                    else if (in_array('Email is in an invalid format<br>', $error_array)) echo 'Email is in an invalid format<br>';
                    else if (in_array('Emails do not match<br>', $error_array)) echo 'Emails do not match<br>';
                    ?>

                    <!-- PASSWORD -->
                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>

                    <?php if (in_array('Passwords must match<br>', $error_array)) echo '<br>Passwords must match<br>';
                    else if (in_array('Passwords must contain only alphanumeric characters<br>', $error_array)) echo 'Passwords must contain only alphanumeric characters<br>';
                    else if (in_array('Password between 5 and 30 characters<br>', $error_array)) echo '<br>Password between 5 and 30 characters<br>';
                    ?>

                    <br>
                    <input type="submit" name="register_button" value="Register">
                    <?php if (in_array("<span style='color:#14c800'>Registration was successful. Proceed to Login!<br></span>", $error_array)) echo "<br><span style='color:#14c800'>Registration was successful. Proceed to Login!<br></span>"; ?>
                    <br>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in!</a>
                </form>
            </div>

        </div>
    </div>

</body>

</html>