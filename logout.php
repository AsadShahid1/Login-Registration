<?php
session_start();
unset($_SESSION['id']);
header("location:my_login.php");
setcookie('id', $user['id'], time() - (86400 * 30), "/"); // 86400 = 1 day

?>