<?php
include_once "../settings/connection.php";
include_once "../settings/core.php";

// echo "heyya";
// exit();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["flightBtn"])) {
    // Sanitize form inputs using mysqli_real_escape_string or prepared statements
    // echo "Touch the hem";
    // exit;
    // Check if departure date is not after arrival date
    $departureDate = $_POST["date"];
    $arrivalDate = $_POST["arrivalDate"];

    if ($departureDate > $arrivalDate) {
        handleFlightError("Arrival date cannot be before departure date.");
        exit(); // Stop further execution
    } 
    // Check if departure date is at least 1 day after the current date
    $currentDate = date("Y-m-d");
    $tomorrowDate = date("Y-m-d", strtotime("+1 day"));

    if ($departureDate < $tomorrowDate) {
        handleFlightError("Departure date must be at least 1 day after the current date.");
        exit(); // Stop further execution
    }

    // If departure and arrival are on the same day, check arrival time
    if ($departureDate == $arrivalDate) {
        $departureTime = strtotime($_POST["departureTime"]);
        $arrivalTime = strtotime($_POST["arrivalTime"]);

        // Convert time to minutes
        $departureMinutes = date("H", $departureTime) * 60 + date("i", $departureTime);
        $arrivalMinutes = date("H", $arrivalTime) * 60 + date("i", $arrivalTime);

        // Ensure arrival time is at least 30 minutes after departure
        if ($arrivalMinutes - $departureMinutes < 30) {
            handleFlightError("Arrival time must be at least 30 minutes after departure time if on the same day.");
            exit(); // Stop further execution
        }
    }

    // Check for duplicates
    $departureCity = mysqli_real_escape_string($conn, $_POST["departureCity"]);
    $arrivalCity = mysqli_real_escape_string($conn, $_POST["arrivalCity"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $arrivalDate = mysqli_real_escape_string($conn, $_POST["arrivalDate"]);

    $checkDuplicateQuery = "SELECT * FROM Flight WHERE departureCity = '$departureCity' 
                            AND arrivalCity = '$arrivalCity' 
                            AND departureDate = '$date'
                            AND arrivalDate = '$arrivalDate'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        handleFlightError("A flight with the same details already exists.");
        exit(); // Stop further execution
    }

    // Insert data into flight table
    $departureTime = mysqli_real_escape_string($conn, $_POST["departureTime"]);
    $arrivalTime = mysqli_real_escape_string($conn, $_POST["arrivalTime"]);
    $airline = mysqli_real_escape_string($conn, $_POST["airline"]);

    // Perform the insertion query
    $sql = "INSERT INTO Flight (airlineID,departureDate, departureTime,  arrivalDate,arrivalTime,departureCity, arrivalCity)
            VALUES ('$airline','$date', '$departureTime', '$arrivalDate','$arrivalTime','$departureCity', '$arrivalCity')";

    if (mysqli_query($conn, $sql)) {
        handleFlightSuccess("Flight added successfully.");
        exit(); // Stop further execution
    } else {
        // echo "hey3";
        // exit;
        handleFlightError("Error adding flight: " . mysqli_error($conn));
        exit(); // Stop further execution
    }
} else {
    // echo "hey";
    // exit;
    // Redirect to the form page if accessed directly without form submission
    header("Location: ../admin/flight.php");
    exit();
}

function handleFlightError($errorMessage)
{
    $_SESSION["flight_added"] = false;
    $_SESSION["flight_message"] = $errorMessage;
    header("Location: ../admin/flight.php");
    exit();
}

function handleFlightSuccess($successMessage)
{
    $_SESSION["flight_added"] = true;
    $_SESSION["flight_message"] = $successMessage;
    header("Location: ../admin/flight.php");
    exit();
}
?>