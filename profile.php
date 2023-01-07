<?php
    include 'database.php';
    if(!$obj->is_login())
        header("location:login.php");
    print_r($obj->get_login_user());

    
?>

<a href="logout.php">Logout </a>