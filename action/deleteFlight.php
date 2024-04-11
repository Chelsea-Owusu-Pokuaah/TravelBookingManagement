<?php
include_once "../settings/connection.php";
include_once "../settings/core.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["flightID"])) {
    // Sanitize the flight ID
    $flightID = mysqli_real_escape_string($conn, $_GET["flightID"]);

    // Perform the deletion query
    $sql = "DELETE FROM Flight WHERE flightID = '$flightID'";

    if (mysqli_query($conn, $sql)) {
        handleFlightSuccess("Flight deleted successfully.");
        exit(); // Stop further execution
    } else {
        handleFlightError("Error deleting flight: " . mysqli_error($conn));
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