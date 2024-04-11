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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="sidebar">
        <a href="#" class="logo">
            <img src="../images/Bus.png" alt="">
            <span class="nav-item">BusBoss</span>
        </a>
        <ul>
            <li>
                <i class="fas fa-home"></i>
                <a href="../view/UserDashboard.php">
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li class="active">
                <i class="fa-solid fa-plane-circle-check"></i>

                <a href="../admin/flight.php">
                    <span class="nav-item">Flights</span>
                </a>
            </li>
            <li> <i class="fas fa-book"></i>

                <a href="../admin/booking_requests.php">
                    <span class="nav-item">Booking Request</span>
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
            <h1>Dashboard</h1>
            <!-- <i class="fas fa-user"></i>
            <div class="sidebar-right">
                <h2 class="user-details">User Information:</h2>
                <div class="user-link">
                    <div class="user-info">
                        <?php
                        // include_once ("../function/displayUserDetails.php");
                        // userDetails();
                        ?>
                    </div>
                </div>

            </div> -->
        </div>
        <div class="welcome-bar">
            <h3>Welcome Chelsea!</h3>
        </div>
        <div class="main-container">
            <div class="container">
                <div class="cards">
                    <div class="card">
                        <div class="card-header">Bookings Made</div>
                        <div class="card-content">100</div>
                    </div>

                    <div class="card">
                        <div class="card-header">Bookings Cancelled</div>
                        <div class="card-content">20</div>
                    </div>

                    <div class="card">
                        <div class="card-header">Bookings Confirmed</div>
                        <div class="card-content">80</div>
                    </div>
                </div>
            </div>

            <div class="recent-bookings">
                <div class="card-header">Recent Bookings</div>
                <div class="recent-booking">
                    <div class="booking-item"><span>Booking 1:</span> John Doe - Room 101</div>
                </div>
                <div class="recent-booking">
                    <div class="booking-item"><span>Booking 2:</span> Jane Smith - Room 102</div>
                </div>
                <div class="recent-booking">
                    <div class="booking-item"><span>Booking 3:</span> Alice Johnson - Room 103</div>
                </div>
                <div class="recent-booking">
                    <div class="booking-item"><span>Booking 4:</span> Bob Brown - Room 104</div>
                </div>
            </div>
        </div>

    </div>
    <div class="sidebar-right">
        <i class="fas fa-user"></i>
        <div class="user-link">
            <div class="user-info">
                <?php
                userDetails();
                ?>
            </div>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementsByClassName("book")[0];

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function openModal() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>