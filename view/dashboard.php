<?php 
include "../settings/core.php";
$roleID = userRoleIdExist();
if($roleID!=1){
    header("Location: ../Login/login_view.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

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
            <li> <i class="fas fa-user"></i>

                <a href="../view/profile.php">
                    <span class="nav-item">Profile</span>
                </a>
            </li>
            <li class="active"> <i class="fas fa-history"></i>

                <a href="../view/History.php">
                    <span class="nav-item">History</span>
                </a>
            </li>
            <li> <i class="fas fa-book"></i>

                <a href="../view/booking_view.php">
                    <span class="nav-item">Booking</span>
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
            <i class="fas fa-user"></i>
            <div class="sidebar-right">
                <!-- <h2 class="user-details">User Information:</h2> -->
                <div class="user-link">
                    <div class="user-info">
                        <?php
                        include_once ("../function/displayUserDetails.php");
                        userDetails();
                        ?>
                    </div>
                </div>

            </div>
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