<?php
session_start();
if (isset($_GET["flightID"])) {
    $rid = $_GET["flightID"];
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
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

        .edit-form {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 50%;
            background-color: #fff;
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
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
            <h1>Edit Flight Details</h1>
        </div>
        <div class="edit-form">
            <form id="editForm" action='<?php echo "../action/updateFlight.php?flightID=" . $rid ?>'method="POST">
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
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button style="background-color: #2e7d32; border-color: cornsilk" type="submit"
                        class="btn btn-primary" name="editFlightBtn">Update</button>
                </div>
            </form>
        </div>
    </div>



</body>

</html>