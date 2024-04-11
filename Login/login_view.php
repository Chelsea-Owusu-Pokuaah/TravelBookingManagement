<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../css/login_style.css" rel="stylesheet">
    <script src="../js/login_user.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Login to your account</h2>
        </div>
        <div class="right">
            <form name="login_user" method="POST" action="../action/login_action.php" class="login_user">
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="loginbtn" id="loginbtn" name="loginbtn">Login</button>
                <p>Don't have an account? <a href="../Login/register_view.php" id="registerHere">Register here</a></p>
            </form>
        </div>
    </div>
    <script>
            <?php
            if (isset($_SESSION["login"])) {
                // Check if it's a success or error
                $type = ($_SESSION["login"] === true) ? 'success' : 'error';
                // Get the message f
                $message = $_SESSION["login_msg"];
                // Unset the session variables
                unset($_SESSION["login"]);
                unset($_SESSION["login_msg"]);
                echo "showAlert('$message', '$type');";
            }

            ?>
            function showAlert(message, type) {
                Swal.fire({
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 2000
                });

            }
        </script>
</body>
</html>
