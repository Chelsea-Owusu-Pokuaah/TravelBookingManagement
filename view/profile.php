<?php
session_start();
if (isset($_GET["requestID"])) {
    $rid = $_GET["requestID"];
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
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
            <span class="nav-item">BusBoss</span>
        </a>
        <ul>
            <li>
                <i class="fas fa-home"></i>
                <a href="../view/dashboard.php">
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li> <i class="fas fa-user"></i>

                <a href="../view/Profile.php">
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
            <h1>User Profile</h1>
        </div>

    </div>


    <div class="sidebar-right">
    <i class="fas fa-user"></i>
        <div class="user-link">
        <div class="user-info">
        <h2>User Information</h2>
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Email:</strong> john@example.com</p>
        <p><strong>Age:</strong> 30</p>
        <p><strong>Location:</strong> New York</p>
    </div>
        </div>

    </div>
</body>

</html>