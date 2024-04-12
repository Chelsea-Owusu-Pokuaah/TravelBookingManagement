<?php
// Include the necessary files and configurations
include_once "../settings/connection.php";
include_once "../settings/core.php";
userIdExist();
$roleID = userRoleIdExist();
// Check if the requestID parameter is provided in the URL
if (isset($_GET["requestID"])) {
    // Sanitize the requestID to prevent SQL injection
    $requestID = mysqli_real_escape_string($conn, $_GET["requestID"]);

    // Check the status of the booking
    $statusQuery = "SELECT status_name FROM BookingRequest JOIN Status ON Status.status_ID = BookingRequest.statusID WHERE requestID = '$requestID'";
    $statusResult = mysqli_query($conn, $statusQuery);
    $statusRow = mysqli_fetch_assoc($statusResult);
    $currentStatus = $statusRow['status_name'];

    if ($roleID == 2) {
        // Prepare SQL statement to delete the booking
        $sql = "DELETE FROM BookingRequest WHERE requestID = '$requestID'";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Booking deleted successfully
            handleBookingSuccess("Booking deleted successfully");
        } else {
            // Error occurred while deleting the booking
            handleBookingError("Error deleting booking: " . $conn->error);
        }
    }
    // Allow deletion only if the status is not "Booked" or "Canceled"
    else if($currentStatus != 'Booked' && $currentStatus != 'Cancelled') {
        // Prepare SQL statement to delete the booking
        $sql = "DELETE FROM BookingRequest WHERE requestID = '$requestID'";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Booking deleted successfully
            handleBookingSuccess("Booking deleted successfully");
        } else {
            // Error occurred while deleting the booking
            handleBookingError("Error deleting booking: " . $conn->error);
        }
    } else {
        // Booking cannot be deleted if status is "Booked" or "Canceled"
        handleBookingError("Cannot delete a booking that is already booked or canceled.");
    }
} else {
    // RequestID parameter is not provided
    handleBookingError("Invalid request. Booking ID not provided.");
}

// Close the database connection
$conn->close();

// Function to handle booking success
function handleBookingSuccess($successMessage) {
    $_SESSION["update"] =true;
    $_SESSION["booking_updated"] = $successMessage;
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit();
}

// Function to handle booking error
function handleBookingError($errorMessage) {
    $_SESSION["update"] = false;
    $_SESSION["booking_updated"] = $errorMessage;
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
    exit();
}
?>
