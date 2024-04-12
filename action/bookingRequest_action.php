<?php
include_once "../settings/connection.php";
include_once "../settings/core.php";

if (isset($_POST["bookingBtn"])) {
    // Check if user is logged in
    $userID = userIdExist();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize form inputs using mysqli_real_escape_string
        $destination = mysqli_real_escape_string($conn, $_POST["destination"]);
        $date = mysqli_real_escape_string($conn, $_POST["date"]);
        $duration = mysqli_real_escape_string($conn, $_POST["duration"]);
        $people = mysqli_real_escape_string($conn, $_POST["people"]);
        $budget = mysqli_real_escape_string($conn, $_POST["budget"]);
        $passengerType = mysqli_real_escape_string($conn, $_POST["passengerType"]);

        // Step 3: Validate form data and handle errors
        if (empty($destination) || empty($date) || empty($duration) || empty($people) || empty($budget) || empty($passengerType)) {
            handleBookingError("All fields are required.");
            exit(); // Stop further execution
        }

        // Check if the date is in the past
        $currentDate = date("Y-m-d");
        if ($date < $currentDate) {
            handleBookingError("Date cannot be in the past.");
            exit(); // Stop further execution
        }

        // Check if the user has already placed a booking for the same date to the same location
        $checkExistingBookingQuery = "SELECT * FROM BookingRequest WHERE pid = '$userID' AND destination = '$destination' AND date = '$date'";
        $existingBookingResult = $conn->query($checkExistingBookingQuery);
        if ($existingBookingResult->num_rows > 0) {
            handleBookingError("You have already booked a trip to this destination on the selected date.");
            exit(); // Stop further execution
        }

        // Check if the user has booked a request for the same date with status "Booked"
        $checkExistingRequestQuery = "SELECT * FROM BookingRequest WHERE pid = '$userID' AND statusID = '2' AND date = '$date'";
        $existingRequestResult = $conn->query($checkExistingRequestQuery);
        if ($existingRequestResult->num_rows > 0) {
            handleBookingError("You have already booked a request on the selected date and it has been approved.");
            exit(); // Stop further execution
        }

        $default_status = 1;
        $sql = "INSERT INTO BookingRequest(`pid`, `destination`,`date`, `statusID`, `budget`, `numberOfPeople`, `passengerType`, `duration`) VALUES ('$userID', '$destination','$date', '$default_status', '$budget', '$people','$passengerType','$duration')";
        if ($conn->query($sql) === TRUE) {
            $last_insert_id = mysqli_insert_id($conn);
            // echo $last_insert_id;
            // exit();
            $sql = "SELECT pid FROM People WHERE roleID = 2 ORDER BY RAND() LIMIT 1";
            $sql_result = mysqli_query($conn, $sql);
            if ($sql_result) {
                $result = mysqli_fetch_column($sql_result);
            }
            $sql = "INSERT INTO RequestsEmployees(`employeeID`,`requestID`) VALUES ('$result','$last_insert_id')";
            // echo $sql;
            // exit;
            if (mysqli_query($conn, $sql)) {
                handleBookingSuccess("Booking requested successfully");
                exit(); // Stop further execution
            } else {
                handleBookingError("Booking unsuccesful, Try again");
            }

        } else {
            handleBookingError("Error: " . $sql . "<br>" . $conn->error);
            exit(); // Stop further execution
        }
    }
}

function handleBookingError($errorMessage)
{
    $_SESSION["update"] = false;
    $_SESSION["booking_updated"] = $errorMessage;
    header("Location: ../view/booking_view.php");
    exit();
}

function handleBookingSuccess($successMessage)
{
    $_SESSION["update"] = true;
    $_SESSION["booking_updated"] = $successMessage;
    header("Location: ../view/booking_view.php");
    exit();
}
?>