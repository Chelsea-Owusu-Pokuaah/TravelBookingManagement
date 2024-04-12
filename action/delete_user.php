<?php
// Include the connection file
include "../settings/connection.php";

// Function to handle error during flight operation
function handleFlightError($errorMessage)
{
    $_SESSION["delete"] = false;
    $_SESSION["delete_message"] = $errorMessage;
    header("Location: ../admin/users.php");
    exit();
}

// Function to handle success during flight operation
function handleFlightSuccess($successMessage)
{
    $_SESSION["delete"] = true;
    $_SESSION["delete_message"] = $successMessage;
    header("Location: ../admin/users.php");
    exit();
}

// Check if the PID parameter is set in the URL
if(isset($_GET['pid'])) {
    // Sanitize the PID to prevent SQL injection
    $pid = mysqli_real_escape_string($conn, $_GET['pid']);

    // Construct the SQL query to delete the user
    $sql = "DELETE FROM People WHERE pid = '$pid'";

    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // User deleted successfully
        // Redirect the user to a success page or back to the user list
        handleFlightSuccess("User deleted successfully.");
    } else {
        // Error occurred while deleting the user
        // You can handle the error in various ways, such as displaying an error message or redirecting to an error page
        handleFlightError("Error deleting user: " . mysqli_error($conn));
    }
} else {
    // PID parameter is not set in the URL
    // Redirect the user to an error page or back to the user list with an error message
    handleFlightError("User ID not provided.");
}

