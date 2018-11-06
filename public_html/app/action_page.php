<?php
    session_start();
    echo $_SESSION['user_username'];
    echo $_SESSION['user_password'];
    echo "Itna to hogya";
    echo $_POST["money"];

    $def = $_POST["def"];       // the array is converted to a string 
    echo $def;
?>
