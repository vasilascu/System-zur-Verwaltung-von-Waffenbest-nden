<?php
// logout.php
include 'auth.php';
logout();
header("Location: login.php");
exit();
?>
