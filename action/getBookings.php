<?php
include_once "../settings/connection.php";
include_once "../settings/core.php";


function getAllBookings() {
    $userID= userIdExist();
    global $conn;
    $bookings = [];
    // Initialize an empty array to store the bookings

    // Query to fetch all bookings
    $sql = "SELECT requestID, destination, date,budget, numberOfPeople, typeName, duration, status_name FROM BookingRequest JOIN Status on BookingRequest.statusID= Status.status_id JOIN PassengerType on BookingRequest.passengerType = PassengerType.ptid Where pid = $userID";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Fetch each row and add it to the $bookings array
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
    }

    // Return the array of bookings
    return $bookings;
}


