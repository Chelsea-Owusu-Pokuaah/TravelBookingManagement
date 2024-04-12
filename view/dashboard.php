<?php
include "../settings/core.php";
include "../action/getStats.php";
include "../action/getBookedFlightUser.php";
$userID = userIdExist();
$roleID = userRoleIdExist();
if ($roleID != 1) {
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
            <span class="nav-item">TraveX</span>
        </a>
        <ul>
            <li>
                <i class="fas fa-home"></i>
                <a href="../view/dashboard.php">
                    <span class="nav-item">Home</span>
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
        </div>
        <div class="welcome-bar">
            <h2>Welcome!</h2>
        </div>
        <div class="main-container">
            <div class="container">
                <div class="cards">
                    <div class="card">
                        <div class="card-header">Bookings Requested</div>
                        <div class="card-content">
                            <?php
                            echo getRequestedBookingCount();
                            ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">Bookings Cancelled</div>
                        <div class="card-content">
                            <?php echo getCancelledBookingCount();
                            ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">Bookings Processed</div>
                        <div class="card-content">
                            <?php echo getBookedBookingCount();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-bookings">
                <div class="card-header">
                    <h3>Processed Bookings</h3>
                </div>
                <?php
                // Get user flight details
                $userFlightDetails = getUserFlightDetails($userID);

                // Check if there are any bookings
                if (!empty($userFlightDetails)) {
                    // Counter variable to keep track of booking number
                    $counter = 1;
                    // Loop through the flight details
                    foreach ($userFlightDetails as $flight) {
                        ?>
                        <div class="recent-booking">
                            <div class="booking-item"><span>Booking
                                    <?php echo $counter; ?>:
                                </span>
                                <?php
                                echo "<div class='flight-detail'><h4>Flight ID</h4><span>" . $flight['flightID'] . "</span></div>";
                                echo "<div class='flight-detail'><h4>Departure City</h4><span>" . $flight['departureCity'] . "</span></div>";
                                echo "<div class='flight-detail'><h4>Arrival City</h4><span>" . $flight['arrivalCity'] . "</span></div>";
                                echo "<div class='flight-detail'><h4>Airline</h4><span>" . $flight['name'] . "</span></div>";
                                ?>
                            </div>
                        </div>
                        <?php
                        // Increment the counter
                        $counter++;
                    }
                } else {
                    // If no bookings found, display a message
                    ?>
                    <div class="recent-booking">
                        <div class="booking-item">No recent bookings found.</div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>

    </div>
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