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
    <title>Dashboard</title>
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

                <a href="../admin/booking_request.php">
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
            <h1>Assigned Booking Requests</h1>
            <i class="fas fa-user"></i>

            <!-- <button type="button" class="btn btn-primary btn-lg" onclick="openModal()">Add a flight</button> -->
        </div> 
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Flight Details</h2>

                <form class="row g-3" method="POST" action="../action/addFlight.php"
                    onsubmit="return validateForm(event)">
                    <div class="col-md-6">
                        <label for="departureCity" class="form-label">Departure City</label>
                        <input type="text" class="form-control" id="departureCity" name="departureCity">
                    </div>
                    <div class="col-md-6">
                        <label for="departureDate" class="form-label">Arrival City</label>
                        <input type="text" class="form-control" id="arrivalCity" name="arrivalCity">
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="col-md-6">
                        <label for="arrivalDate" class="form-label">Arrival Date</label>
                        <input type="date" class="form-control" id="arrivalDate" name="departureDate">
                    </div>
                    <div class="col-md-6">
                        <label for="departureTime" class="form-label">Departure Time</label>
                        <input type="time" class="form-control" id="departureTime" name="departureDate">
                    </div>
                    <div class="col-md-6">
                        <label for="arrivalTime" class="form-label">Arrival Time</label>
                        <input type="time" class="form-control" id="arrivalTime" name="departureDate">
                    </div>
                    <div class="col-md-6">
                        <label for="inputAirline" class="form-label">Airline</label>
                        <select id="airline" class="form-select" name="airline">
                            <option disabled selected value="0">Choose...</option>
                            <?php
                            include "../action/getAirlines.php";
                            $results = getAirlines();
                            foreach ($results as $stat) {
                                echo "<option value='{$stat['airlineID']}'>{$stat['name']}</option>";
                            } ?>
                        </select>
                    </div>
                    <!-- <div class="col-md-2">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div> -->
                    <div class="col-12">
                        <button style="background-color: #2e7d32; border-color: cornsilk" type="submit"
                            class="btn btn-primary" name="flightBtn">Add Flight</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="welcome-bar">
            <h3>View all booking requests assigned to you</h3>
        </div>
        <div class="recent-bookings">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            Destination
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Duration
                        </th>
                       <th>
                            Number of People
                        </th>
                        <th>
                            Budget
                        </th>
                        <th>
                            Passenger Type
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "../function/displayBookingRequest.php";
                    ?>
                </tbody>
            </table>
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h2>Edit Booking Details</h2>
                    <form id="editForm" action="../action/update_booking.php" method="POST">
                        <input type="hidden" id="editRequestID" name="requestID">
                        <div class="form-group">
                            <label for="editDestination">Destination:</label>
                            <input type="text" id="editDestination" name="destination">
                        </div>
                        <div class="form-group">
                            <label for="editDate">Date:</label>
                            <input type="date" id="editDate" name="date">
                        </div>
                        <div class="form-group">
                            <label for="editDuration">Duration (in days):</label>
                            <input type="number" id="editDuration" name="duration" min="1">
                        </div>
                        <div class="form-group">
                            <label for="editPeople">Number of People:</label>
                            <input type="number" id="editPeople" name="people" min="1">
                        </div>
                        <div class="form-group">
                            <label for="editBudget">Budget (in USD):</label>
                            <input type="number" id="editBudget" name="budget" min="0">
                        </div>
                        <div class="form-group">
                            <label for="editPassengerType">Passenger Type:</label>
                            <input type="text" id="editPassengerType" name="passengerType">

                        </div>
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
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
        // Check the value of $_SESSION["booked"]
        if (isset($_SESSION["flight_added"])) {
            // Check if it's a success or error
            $type = ($_SESSION["flight_added"] === true) ? 'success' : 'error';

            // Get the message from $_SESSION["flight_added_created"]
            $message = $_SESSION["flight_message"];
            // Unset the session variables
            unset($_SESSION["flight_added"]);
            unset($_SESSION["flight_message"]);
            // Output JavaScript code to show the alert
            echo "showAlert('$message', '$type');";
        }
        if (isset($_SESSION["booking_processed"])) {
            // Check if it's a success or error
            $type = ($_SESSION["booking_processed"] === true) ? 'success' : 'error';

            // Get the message from $_SESSION["booking_processed_created"]
            $message = $_SESSION["process_message"];
            // Unset the session variables
            unset($_SESSION["booking_processed"]);
            unset($_SESSION["process_message"]);
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
    <script>
        function validateForm(e) {
            var destination = document.getElementById("destination").value;
            var date = document.getElementById("date").value;
            var duration = document.getElementById("duration").value;
            var people = document.getElementById("people").value;
            var budget = document.getElementById("budget").value;
            var passengerType = document.getElementById("passengerType").value;

            var alphaPattern = /^[A-Za-z]+$/;

            // Validate destination field
            if (!alphaPattern.test(destination)) {
                alert("Destination must contain only alphabetic characters");
                return false;
            }

            // Validate passengerType field
            if (!alphaPattern.test(passengerType)) {
                alert("Passenger Type must contain only alphabetic characters");
                return false;
            }        // Check if any field is empty
            if (destination == "" || date == "" || duration == "" || people == "" || budget == "" || passengerType == "") {
                alert("All fields must be filled out");
                e.preventDefault();
                return false;
            }

            // Validate specific fields (e.g., numeric values)
            if (isNaN(duration) || isNaN(people) || isNaN(budget)) {
                alert("Please enter valid numeric values for Duration, Number of People, and Budget");
                e.preventDefault();
                return false;
            }


            return true; // Form is valid, submit it
        }
    </script>

</body>

</html>