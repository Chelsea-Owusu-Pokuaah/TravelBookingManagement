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
    <title>Flight</title>
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
            <img src="" alt="">
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

                <a href="../admin/help.php">
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
            <h1>Flights</h1>
            <button type="button" class="btn btn-primary btn-lg" id="flightBtn">Add a flight</button>
            <i class="fas fa-user"></i>

        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Flight Details</h2>

                <form class="row g-3" method="POST" action="../action/addFlight.php"
                    onsubmit="return validateForm(event)">
                    <!-- <div class="col-md-6">
                        <label for="departureCity" class="form-label">Departure City</label>
                        <input type="text" class="form-control" id="departureCity" name="departureCity">
                    </div> -->
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
                        <input type="date" class="form-control" id="arrivalDate" name="arrivalDate">
                    </div>
                    <div class="col-md-6">
                        <label for="departureTime" class="form-label">Departure Time</label>
                        <input type="time" class="form-control" id="departureTime" name="departureTime">
                    </div>
                    <div class="col-md-6">
                        <label for="arrivalTime" class="form-label">Arrival Time</label>
                        <input type="time" class="form-control" id="arrivalTime" name="arrivalTime">
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
                    <!-- <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                    </div> -->
                    <div class="col-12">
                        <button style="background-color: #2e7d32; border-color: cornsilk" type="submit"
                            class="btn btn-primary" name="flightBtn">Add Flight</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="welcome-bar">
            <h3>Add available flights</h3>
        </div>
        <div class="recent-bookings">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            Departure Date
                        </th>
                        <th>
                            Departure Time
                        </th>
                        <th>
                            Arrival Date
                        </th>
                        <th>
                            Arrival Time
                        </th>
                        <th>
                            Departure City
                        </th>
                        <th>
                            Arrival City
                        </th>
                        <th>
                            Airline
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "../function/displayFlights.php";
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
        var btn = document.getElementById("flightBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = openModal;

        // Define the function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
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