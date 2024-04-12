<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .sidebar-tab {
            padding: 20px;
        }

        .sidebar-tab p {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.5;
        }

        .sidebar-tab strong {
            font-weight: bold;
        }

        .sidebar-tab h3 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 18px;
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
        </ul>    </div>

    <div class="main-content">
    <div class="top">
            <h1>Help</h1>
            <i class="fas fa-user"></i>
        </div>
        <div class="welcome-bar">
            <!-- <h2>Welcome!</h2> -->
        </div>
        <div class="main-container">
            <div id="help-tab" class="sidebar-tab">
                <div>
                    <p>Welcome to the Travel Management System! Below are some key features and tips to help you get started:</p>
                    <p>
                        <strong>Dashboard:</strong> <br>
                        Get an overview of current bookings, trip details, and important notifications.
                    </p>
                    <p>
                        <strong>Booking request:</strong> <br>
                        View, add, edit, or delete rquested bookings.</p>
                    <p>
                        <strong>Departure City:</strong> <br>
                        All departures are from Accra
                        </p>
                    <p>
                        <strong>Passenger Management:</strong> <br>
                        Manage passenger information, including bookings, reservations, and ticketing.
                    </p>
                    <p>
                        <strong>Reports:</strong> <br>
                        Generate detailed analytics and insights about bus operations, including trip performance, passenger demographics, and revenue.
                    </p>
                    <p>
                        <strong>Settings:</strong> <br>
                        Customize system settings, notifications, user permissions, and configurations.
                    </p>
                    <p>
                        <strong>FAQs:</strong> <br>
                        Find answers to common questions. Reach out to our support team for assistance with any issues or questions.
                    </p>
                    <p>
                        <strong>Feedback:</strong> <br>
                        To edit your profile info, kindly contact the us!
                    </p>
                    <p>For further assistance or inquiries, contact our support team at <a href="mailto:support@busmanagementsystem.com">support@busmanagementsystem.com</a></p>
                    <p>Thank you for choosing TraveX.</p>
                    
                    <h3>Note:</h3>
                    <p>
                        <strong>Editing Bookings:</strong> <br>
                        You cannot edit a booking that has been processed. Kindly contact us.
                    </p>
                </div>
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


</body>

</html>
