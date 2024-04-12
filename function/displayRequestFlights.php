<?php
include "../action/flightsBooking.php";
// Fetch requests and their booked flights
$requests = getRequestsAndFlights();

// Check if requests were fetched successfully
if ($requests !== false) {
    // Requests were fetched successfully
    // Display requests and their booked flights
    foreach ($requests as $request) {
        echo "<h2>Request ID: " . $request['requestID'] . "</h2>";
        echo "<p>Status: " . $request['status'] . "</p>";

        // Display booked flights for the request
        if (!empty($request['flights'])) {
            echo "<h3>Booked Flights:</h3>";
            echo "<ul>";
            foreach ($request['flights'] as $flight) {
                echo "<li>Flight ID: " . $flight['flightID'] . ", Departure City: " . $flight['departureCity'] . ", Arrival City: " . $flight['arrivalCity'] . ", Airline: " . $flight['airlineName'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No flights booked for this request.</p>";
        }
    }
} else {
    // Failed to fetch requests
    echo "<p>Failed to retrieve requests. Please try again later.</p>";
}
?>