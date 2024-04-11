<?php
include_once "../settings/connection.php";
include_once "../settings/core.php";

if (isset($_POST["editFlightBtn"]) && isset($_GET["flightID"])) {
    // Get the flight ID to update
    $flightID = mysqli_real_escape_string($conn, $_GET["flightID"]);

    // Check if departure date is not after arrival date
    $departureDate = mysqli_real_escape_string($conn, $_POST["date"]);
    $arrivalDate = mysqli_real_escape_string($conn, $_POST["arrivalDate"]);

    if (!empty($departureDate) && !empty($arrivalDate)) {
        if ($departureDate > $arrivalDate) {
            handleFlightError("Arrival date cannot be before departure date.");
            exit(); // Stop further execution
        }

        // If departure and arrival are on the same day, check arrival time
        if (!empty($_POST["departureTime"]) && !empty($_POST["arrivalTime"])) {
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
        }
    }

    // Check for duplicates
    $departureCity = mysqli_real_escape_string($conn, $_POST["departureCity"]);
    $arrivalCity = mysqli_real_escape_string($conn, $_POST["arrivalCity"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $arrivalDate = mysqli_real_escape_string($conn, $_POST["arrivalDate"]);
    $airline = mysqli_real_escape_string($conn, $_POST["airline"]);

    // Perform duplicate check query
    $duplicateQuery = "SELECT * FROM Flight WHERE departureCity = '$departureCity' AND arrivalCity = '$arrivalCity' AND departureDate = '$date' AND arrivalDate = '$arrivalDate' AND flightID != '$flightID'";
    $result = mysqli_query($conn, $duplicateQuery);

    // Check if any duplicate found
    if (mysqli_num_rows($result) > 0) {
        handleFlightError("Duplicate flight found. Please enter unique flight details.");
        exit(); // Stop further execution
    }

    // If no duplicates found, proceed with updating the flight details

    // Initialize an empty array to store the update statements
    $updateStatements = array();

    // Check if each field is empty and construct the corresponding update statement
    if (!empty($departureCity)) {
        $updateStatements[] = "departureCity = '$departureCity'";
    }
    if (!empty($arrivalCity)) {
        $updateStatements[] = "arrivalCity = '$arrivalCity'";
    }
    if (!empty($date)) {
        $updateStatements[] = "departureDate = '$date'";
    }
    if (!empty($arrivalDate)) {
        $updateStatements[] = "arrivalDate = '$arrivalDate'";
    }
    if (!empty($airline)) {
        $updateStatements[] = "airlineID = '$airline'";
    }
    // Construct the final update query by joining the update statements
    $updateQuery = "UPDATE Flight SET " . implode(", ", $updateStatements) . " WHERE flightID = '$flightID'";
    // echo $updateQuery;
    // exit;
    // Perform the update query
    if (mysqli_query($conn, $updateQuery)) {
        handleFlightSuccess("Flight updated successfully.");
        exit(); // Stop further execution
    } else {
        handleFlightError("Error updating flight: " . mysqli_error($conn));
        exit(); // Stop further execution
    }
} else {
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
