<?php
if (session_status() == PHP_SESSION_NONE) {
    // Session has not been started, so start it
    session_start();
}
unset($_SESSION["user_id"]);
unset($_SESSION["role_id"]);
unset($_SESSION["user_fname"]);
unset($_SESSION["user_lname"]);
header("Location: ../Login/login_view.php");
exit();