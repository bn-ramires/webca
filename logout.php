<?php

// Destroying the session for the logging out process
session_start();
session_destroy();

?>

// Alerting the user and redirecting to the main page.
<script>
    alert("You have been logged out!");
    window.location.replace("index.php");
</script>

