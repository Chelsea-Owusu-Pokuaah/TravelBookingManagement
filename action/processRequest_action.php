<?php
include "../settings/connection.php";

if (isset($_GET["requestID"])) {
    $rid = $_GET["requestID"];
}

if (isset($_POST["updateBookingBtn"])) {
    // Check if both status and flightType are selected
    if (isset($_POST["status"]) && isset($_POST["flightType"])) {
        // Get the selected status and flight ID
        $status = mysqli_escape_string($conn, $_POST["status"]);
        $flightID = mysqli_real_escape_string($conn, $_POST["flightType"]);

        if($flightID!=0){
        // Retrieve the details of the booking request
        $bookingRequestQuery = "SELECT destination, date, budget, numberOfPeople FROM BookingRequest WHERE requestID = '$rid'";
        $bookingRequestResult = mysqli_query($conn, $bookingRequestQuery);
        $bookingRequestDetails = mysqli_fetch_assoc($bookingRequestResult);

        // Retrieve the details of the selected flight
        $flightQuery = "SELECT departureDate, arrivalCity FROM Flight WHERE flightID = '$flightID'";
        $flightResult = mysqli_query($conn, $flightQuery);
        $flightDetails = mysqli_fetch_assoc($flightResult);

        // Check if the flight details match the booking request details
        if ($bookingRequestDetails['destination'] == $flightDetails['arrivalCity'] &&
            $bookingRequestDetails['date'] == $flightDetails['departureDate']){
            // Update the status in the BookingRequest table
            $updateStatusQuery = "UPDATE BookingRequest SET statusID = '$status' WHERE requestID = '$rid'";
            $updateStatusResult = mysqli_query($conn, $updateStatusQuery);

            // Add the booking to the Bookings table
            $addBookingQuery = "INSERT INTO Booking (flightID,requestID) VALUES ('$flightID','$rid')";
            // echo $addBookingQuery;
            // exit;
            $addBookingResult = mysqli_query($conn, $addBookingQuery);

            if ($updateStatusResult && $addBookingResult) {
                // Handle success
                handleBookingSuccess("Booking processed successfully.");
            } else {
                // Handle error
                handleBookingError("Error processing booking.");
            }
        }else {
            // If flight details don't match, show an error message
            handleBookingError("Flight details do not match the booking request.");
        }}
        else{
            $updateStatusQuery = "UPDATE BookingRequest SET statusID = '$status' WHERE requestID = '$rid'";
            $updateStatusResult = mysqli_query($conn, $updateStatusQuery);
            $sql= "Select * from Booking where requestID = '$rid'";
            $sql_result = mysqli_query($conn, $sql);
            if($sql_result){
                $updateStatusQuery = "UPDATE Booking SET flightID = '$flightID' WHERE requestID = '$rid'";
                $updateBookingResult = mysqli_query($conn, $updateStatusQuery);

            }else{
                $addBookingQuery = "INSERT INTO Booking (flightID,requestID) VALUES ('$flightID','$rid')";
                $updateBookingsResult = mysqli_query($conn, $addBookingQuery);
            }
            if ($updateStatusResult && $updateBookingsResult ) {
                // Handle success
                handleBookingSuccess("Booking processed successfully.");
            } else {
                // Handle error
                handleBookingError("Error processing booking.");
            }

        }
    } else {
        // If either status or flightType is not selected, show an error message
        handleBookingError("Please select both status and flight.");
    }
}

// Function to handle booking success
function handleBookingSuccess($successMessage) {
    $_SESSION["booking_processed"] = true;
    $_SESSION["process_msg"] = $successMessage;
    header("Location: ../admin/booking_requests.php");
    exit();
}

// Function to handle booking error
function handleBookingError($errorMessage) {
    $_SESSION["booking_processed"] = false;
    $_SESSION["process_msg"] = $errorMessage;
    header("Location: ../admin/booking_requests.php");
    exit();
}
?>
