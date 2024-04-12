<?php
include "../settings/core.php";
include_once ("../function/displayUserDetails.php");
$roleID = userRoleIdExist();
if ($roleID != 2) {
    header("Location: ../Login/login_view.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        table tr td i {
            color: #2e7d32;
            margin-left: 10px;
        }
    </style>
</head>

<body>
<div class="sidebar">
        <a href="#" class="logo">
            <img src="../images/Bus.png" alt="">
            <span class="nav-item">TraveX</span>
        </a>
        <ul>
            <li>
                <i class="fas fa-home"></i>
                <a href="../admin/dashboard.php">
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li class="active"> 
                <i class="fa-solid fa-plane-circle-check"></i>

                <a href="../admin/flight.php">
                    <span class="nav-item">Flights</span>
                </a>
            </li>
            <li class="active">
                <i class="fas fa-user"></i>
                <a href="../admin/users.php">
                    <span class="nav-item">All Users</span>
                </a>
            </li>
            <li> <i class="fas fa-book"></i>

                <a href="../admin/booking_requests.php">
                    <span class="nav-item">Booking Requests</span>
                </a>
            </li>
            <li> <i class="fas fa-question-circle"></i>

                <a href="../view/help.php">
                    <span class="nav-item">Help</span>
                </a>
            </li>
            <li> <i class="fas fa-sign-out-alt"></i>

                <a href="../Login/logout.php" class="logout">
                    <span class="nav-item">Log out</span>
                </a>
            </li>
        </ul>
    </div>


    <div class="main-content">
        <div class="top">
            <h1>All users</h1>
            <i class="fas fa-user"></i>

            <!-- <button type="button" class="btn btn-primary btn-lg" onclick="openModal()">Add a flight</button> -->
        </div>
        <div id="myModal" class="modal">
            <!-- Modal content -->
        </div>
        <div class="welcome-bar">
            <!-- <h3>View all booking requests assigned to you</h3> -->
        </div>
        <div class="recent-bookings">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Telephone Number </th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <!-- <th>Action </th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the PHP code to fetch and display booking requests and their flights
                    include_once "../action/getAllUsers.php";
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="sidebar-right">
        <!-- <i class="fas fa-user"></i> -->
        <div class="user-link">
            <div class="user-info">
                <?php
                userDetails();
                ?>
            </div>
        </div>
    </div>
    <script>
        <?php
        if (isset($_SESSION["delete"])) {
            // Check if it's a success or error
            $type = ($_SESSION["delete"] === true) ? 'success' : 'error';
            // Get the message from $_SESSION["delete_created"]
            $message = $_SESSION["delete_msg"];
            // Unset the session variables
            unset($_SESSION["delete"]);
            unset($_SESSION["delete_msg"]);
            // Output JavaScript code to show the alert
            echo "showAlert('$message', '$type');";
        }
        if (isset($_SESSION["edit_user"])) {
            // Check if it's a success or error
            $type = ($_SESSION["edit_user"] === true) ? 'success' : 'error';
            // Get the message from $_SESSION["edit_user_created"]
            $message = $_SESSION["edit_user_msg"];
            // Unset the session variables
            unset($_SESSION["edit_user"]);
            unset($_SESSION["edit_user_msg"]);
            // Output JavaScript code to show the alert
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