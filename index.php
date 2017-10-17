<?php
session_start();
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/jquery.mobile-1.4.5.min.css"/>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/jquery.mobile-1.4.5.min.js"></script>

<!-- Changing the fields' width -->
<style>
    div.ui-input-text {
        width: 320px !important
    }
</style>
<div data-role="page" id="index" align="center">
    <!-- Main menu -->
    <div data-role="navbar">
        <ul>
            <li><a href="index.php" data-icon="user">Login</a></li>
            <li><a href="register.php" data-icon="plus">Sign Up</a></li>
        </ul>
    </div>

    <h4 align="center">Log in to your account.</h4>
    <body>

    <div class="form">
        <!-- Creating main login form. PS: JS validation only works really well on Firefox for some reason. -->
        <form action="index.php" method="post" action="verify.php">
            <!-- Email field is required and validated -->
            <input type="email" name="input_email" placeholder="E-mail" class="required email" required="required">
            <!-- Password is required -->
            <input type="password" name="input_password" placeholder="Password" required="required">
            <!-- Submitting/posting the form for PHP validation process -->
            <input type="submit" id="submit_button" value="Log In!" data-role="custom-btn">

            <?php
            // PHP code will only run if a post occurs.
            if ($_POST) {

                // Loading database framework with the connection already made.
                // Read the first lines of code inside this file.
                require_once 'medoo.php';

                // Catching what user has typed.
                $pw = $_POST['input_password'];
                $email = $_POST['input_email'];

                // User authentication
                if ($database->has("user", [
                    "AND" => [
                        "OR" => [
                            "email" => "$email"
                        ],
                        "password" => "$pw"
                    ]
                ])) {

                    // If authentication is successful, store data in a session.
                    $profile = $database->get("user", [
                        "iduser",
                        "name",
                        "email",
                        "tel",
                        "address",
                        "user_type",
                        "password",
                    ], [
                        "email" => $email
                    ]);

                    $_SESSION['user_id'] = $profile[iduser];
                    $_SESSION['user_name'] = $profile[name];
                    $_SESSION['user_email'] = $profile[email];
                    $_SESSION['user_tel'] = $profile[tel];
                    $_SESSION['user_address'] = $profile[address];
                    $_SESSION['user_type'] = $profile[user_type];
                    $_SESSION['user_password'] = $profile[password];

                    // Redirecting users when logging in to their respective control panels
                    // If the user is a customer
                    if ($profile[user_type] == "customer") {
                        echo '<script>window.location.replace("cp_user.php")</script>;';
                        // If the user is a staff member.
                    } elseif ($profile[user_type] == "staff") {
                        echo '<script>window.location.replace("cp_staff.php")</script>;';
                        // If the user is from the delivery department.
                    }
                } // If authentication fails, display this error message.
                else {
                    echo "<br>Password and/or email incorrect. Try again.";
                }
            }
            ?>
        </form>
    </body>
</div>
</div>
</html>