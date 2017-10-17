<?php
session_start();
include 'user_info.php';
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/jquery.mobile-1.4.5.min.css"/>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/jquery.mobile-1.4.5.min.js"></script>

<div data-role="page" id="control-panel" align="center">
    <div data-role="navbar">
        <ul>
            <li><a href="cp_user.php" data-icon="home">Home</a></li>
            <li><a href="user_account.php" data-icon="user">Account</a></li>
            <li><a href="store.php" data-icon="shop">Store</a></li>
            <li><a href="logout.php" data-icon="arrow-r">Log Out</a></li>
        </ul>
    </div>

    <h4 align="center">Welcome to your control panel, <i><?php echo $user_name; ?></i></h4>
    <div style='margin:20px; position:relative'>
        <body>
        This is the users' main page. Allowing them to browse to the available options.
        </body>
    </div>
</div>
</html>
