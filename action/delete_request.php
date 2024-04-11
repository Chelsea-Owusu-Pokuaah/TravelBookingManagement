<?php
// Include the necessary files and configurations
include_once "../settings/connection.php";
include_once "../settings/core.php";

// Check if the requestID parameter is provided in the URL
if (isset($_GET["requestID"])) {
    // Sanitize the requestID to prevent SQL injection
    $requestID = mysqli_real_escape_string($conn, $_GET["requestID"]);

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
    // RequestID parameter is not provided
    handleBookingError("Invalid request. Booking ID not provided.");
}

// Close the database connection
$conn->close();

// Function to handle booking success
function handleBookingSuccess($successMessage) {
    $_SESSION["booking_deleted"] = $successMessage;
    header("Location: ../view/booking_view.php");
    exit();
}

// Function to handle booking error
function handleBookingError($errorMessage) {
    $_SESSION["booking_error"] = $errorMessage;
    header("Location: ../view/booking_view.php");
    exit();
}
?>
