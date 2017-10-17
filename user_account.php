<?php include 'user_info.php'; ?>

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

    <h4 align="center"><i>Account Information</i></h4>
    <ul data-role="listview" align="center" style="margin:30px">
        <?php
        echo "<li><b>ID:</b>       $user_id <br></li>";
        echo "<li><b>Name:</b>     $user_name <br></li>";
        echo "<li><b>E-mail:</b>   $user_email <br></li>";
        echo "<li><b>Tel:</b>      $user_tel <br></li>";
        echo "<li><b>Address:</b>  $user_address <br></li>";
        echo "<li><b>Type:</b>     $user_type <br></li>";
        echo "<li><b>Password:</b> $user_password <br></li>";
        ?>
    </ul>
</div>
</html>
