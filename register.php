<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/jquery.mobile-1.4.5.min.css"/>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/jquery.mobile-1.4.5.min.js"></script>

<style>

    div.ui-input-text {
        width: 320px !important
    }

</style>
<head>
    <title>Register</title>
</head>
<div data-role="page" id="register" align="center">
    <div data-role="navbar">
        <ul>
            <li><a href="index.php" data-icon="user">Login</a></li>
            <li><a href="register.php" data-icon="plus">Sign Up</a></li>
        </ul>
    </div>

    <h4 align="center">Register a new user.</h4>
    <body>
    <!-- Creating register form. PS: JS validation only works really well on Firefox for some reason. -->
    <div class="form">
        <form action="register.php" method="post">
            <input name="input-name" placeholder="Name" required="required">
            <!-- E-mail field is validated -->
            <input type="email" name="input-email" placeholder="E-mail" class="required email" required="required">
            <input type="password" name="input-password" placeholder="Password" required="required">
            <input name="input-tel" placeholder="Telephone" required="required">
            <input name="input-address" placeholder="Address" required="required">
            <div class="g-recaptcha" data-sitekey="6LekSTIUAAAAAFOyXMo_wY8YYQM3u47vm6OjnXrE"></div>
            <input type="submit" value="Register!" data-role="button">

            <?php
            if ($_POST) {

                // Using Google's reCaptcha system
                $username = $_POST['username'];
                $secretKey = "6LekSTIUAAAAAA_xbl4WaCBIZ9p1kRKrin1rFhWW";
                $responseKey = $_POST['g-recaptcha-response'];
                $userIP = $_SERVER['REMOTE_ADDR'];

                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
                $response = file_get_contents($url);
                $response = json_decode($response);

                // If captcha verification was a success, push data to database.
                if ($response->success) {

                    // Preparing database (read the first lines of code inside)
                    require_once 'medoo.php';

                    $un = $_POST['input-name'];
                    $pw = $_POST['input-password'];
                    $email = $_POST['input-email'];
                    $tel = $_POST['input-tel'];
                    $address = $_POST['input-address'];

                    // Inserting the form data into the database
                    $database->insert('user', [
                        'name' => $un,
                        'email' => $email,
                        'password' => $pw,
                        'tel' => $tel,
                        'address' => $address,
                        'user_type' => 'customer', // New users are by default customers.
                    ]);


                    echo '<script>alert("You have been registered!")</script>;';
                    echo '<script>window.location.replace("index.php")</script>;';

                    // If captcha verification failed
                    // Inform the user and refresh to try again
                } else {
                    echo '<script>alert("Captcha verification failed. Try again.")</script>;';
                    echo '<script>window.location.replace("register.php")</script>;';
                }
            }
            ?>
        </form>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</div>
</div>
</html>
