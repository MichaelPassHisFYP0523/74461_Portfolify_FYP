<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['email'])) {
        // Store the current URL
        $_SESSION['redirect_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        // Redirect to login page
        header("Location: Sign_In.php");
        exit();
    }
}
?>
