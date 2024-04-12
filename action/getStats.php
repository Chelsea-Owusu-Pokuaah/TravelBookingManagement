<?php
// Include the necessary files and configurations
include_once "../settings/connection.php";
include_once "../settings/core.php";

$userID = userIdExist();

// Function to get the count of canceled bookings for a user
function getCancelledBookingCount() {
    global $conn;
    $userID = userIdExist();
    $cancelledQuery = "SELECT COUNT(*) as cancelled_count FROM BookingRequest WHERE pid = '$userID' AND statusID = (SELECT status_ID FROM Status WHERE status_name = 'Cancelled')";
    $cancelledResult = mysqli_query($conn, $cancelledQuery);
    $cancelledRow = mysqli_fetch_assoc($cancelledResult);
    return $cancelledRow ? $cancelledRow['cancelled_count'] : 0;
}

// Function to get the count of booked bookings for a user
function getBookedBookingCount() {
    global $conn;
    $userID = userIdExist();
    $bookedQuery = "SELECT COUNT(*) as booked_count FROM BookingRequest WHERE pid = '$userID' AND statusID = (SELECT status_ID FROM Status WHERE status_name = 'Booked')";
    $bookedResult = mysqli_query($conn, $bookedQuery);
    $bookedRow = mysqli_fetch_assoc($bookedResult);
    return $bookedRow ? $bookedRow['booked_count'] : 0;
}

// Function to get the count of requested bookings for a user
function getRequestedBookingCount() {
    global $conn;
    $userID = userIdExist();
    $requestedQuery = "SELECT COUNT(*) as requested_count FROM BookingRequest WHERE pid = '$userID' AND statusID = (SELECT status_ID FROM Status WHERE status_name = 'Requested')";
    $requestedResult = mysqli_query($conn, $requestedQuery);
    $requestedRow = mysqli_fetch_assoc($requestedResult);
    return $requestedRow ? $requestedRow['requested_count'] : 0;
}

// Close the database connection
?>
