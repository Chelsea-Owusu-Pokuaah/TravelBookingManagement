<?php
if (session_status() == PHP_SESSION_NONE) {
    // Session has not been started, so start it
    session_start();
}
if (!function_exists('userIdExist')) {
    function userIdExist() {
        if(!isset($_SESSION['user_id'])){
            header("Location: ../Login/login_view.php");
            die();
        }
        return $_SESSION["user_id"];
    }
}
if(!function_exists("userRoleIdExist")){
    function userRoleIdExist() {
        if (!isset($_SESSION['role_id'])) {
            header("Location: ../Login/login_view.php");
            return false;
    
        }
        return $_SESSION['role_id'];
    }
}