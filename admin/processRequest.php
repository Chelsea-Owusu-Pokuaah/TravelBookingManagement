<?php
include "../settings/core.php";
if (isset($_GET["requestID"])) {
    $rid = $_GET["requestID"];
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Request</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        table tr td i {
            color: #2e7d32;
            margin-left: 10px;
        }

        .edit-form {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
            width: 60%;
            /* display: flex; */
            justify-content: center;
            position: absolute;
            /* top: 50%; */
            left: 25%;
            /* transform: translate(-50%, -50%); */
            padding: 10px;
        }
        .edit-form form{
            align-self: center;
        }

        .card {
            height: 40%;
        }
        .container{
            display: block;
            justify-content: space-between;
        }
        
    </style>
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
                    <span class="nav-item">Booking</span>
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
            <h1>Process Request</h1>
        </div>
        <div class="container">
        <div class="card">
            <?php
            include "../action/getRequestUserInfo.php";
            $result = getUserDetails(); ?>
            <div class="card-header">
                <h3>User Details</h3>
            </div>
            <div class="row g-3 id="card-body">
                <div class = "col-md-6">

                <p class="card-text"><strong>First Name:</strong>
                    <?php echo $result['fname']; ?>
                </p>
                </div>
                <div class = "col-md-6">

                <p class="card-text"><strong>Last Name:</strong>
                    <?php echo $result['lname']; ?>
                </p>
                </div>
                <div class = "col-md-6">

                <p class="card-text"><strong>Email:</strong>
                    <?php echo $result['email']; ?>
                </p>
                </div>
                <div class = "col-md-6">

                <p class="card-text"><strong>Gender:</strong>
                    <?php 
                    if ($result['gender'] ==0){
                        echo "Male";
                    }
                    else{
                        echo "Female";
            
                    }; ?>
                </p> </div>
                <div class = "col-md-6">

                <p class="card-text"><strong>Telephone Number:</strong>
                    <?php echo $result['telnum']; ?>
                </p>
                </div>
            </div>
        </div>



        <div class="edit-form">
            <div class="h3"> Process Booking</div>
            <form class="row g-3" method="POST"
                action='<?php echo "../action/processRequest_action.php?requestID=" . $rid ?>'>
                <!-- <div class="col-md-6">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" class="form-control" id="destination" name="destination">
                </div> -->
                <div class="col-md-12">
                    <label for="status" class="form-label">Change status</label>
                    <select id="status" class="form-select" name="status">
                        <option disabled selected value="0">Choose...</option>
                        <?php
                        include "../action/getStatus.php";
                        $results = getStatus();
                        foreach ($results as $stat) {
                            echo "<option value='{$stat['status_id']}'>{$stat['status_name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="inputFlightType" class="form-label">Flight</label>
                    <select id="flightType" class="form-select" name="flightType">
                        <option disabled selected value="-1">Choose...</option>
                        <option value="0">None</option>
                        <?php
                        include "../action/getFlights.php";
                        $results = getFlights();
                        foreach ($results as $stat) {
                            echo "<option value='{$stat['flightID']}'>{$stat['departureCity']} to {$stat['arrivalCity']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-12">
                    <button style="background-color: #2e7d32; border-color: cornsilk" type="submit"
                        class="btn btn-primary" name="updateBookingBtn">Process</button>
                </div>
            </form>
        </div>

    </div>
    </div>



</body>

</html>