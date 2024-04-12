<?php
include "../settings/connection.php";
include "../settings/core.php";

// Function to fetch flight details for a user
function getUserFlightDetails($userID) {
    global $conn;

    // SQL query to fetch flight details
    $sql = "SELECT departureCity, arrivalCity, Flight.flightID, name 
            FROM Booking 
            JOIN Flight ON Flight.flightID = Booking.flightID 
            JOIN BookingRequest ON BookingRequest.requestID = Booking.requestID 
            JOIN Airline ON Airline.airlineID = Flight.airlineID
            WHERE BookingRequest.pid = '$userID'
            LIMIT 4;";

    // Initialize an empty array to store the results
    $flightDetails = array();

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch data from the result set and add it to the array
        while ($row = mysqli_fetch_assoc($result)) {
            $flightDetails[] = $row;
        }
    } else {
        // Handle query error
        echo "Error executing query: " . mysqli_error($conn);
    }


    // Return the associative array containing flight details
    return $flightDetails;
}

