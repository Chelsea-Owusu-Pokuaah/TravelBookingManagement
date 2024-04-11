<?php
include "../settings/connection.php";
function getFlights()
{
    global $conn;
    $select_type_query = "SELECT `flightID`, `name`, `departureDate`, `departureTime`, `arrivalTime`, `arrivalDate`, `departureCity`, `arrivalCity` FROM `Flight` JOIN Airline ON Airline.airlineID = Flight.airlineID ";
    $result = mysqli_fetch_all(mysqli_query($conn, $select_type_query), MYSQLI_ASSOC);
    return $result;
}
// var_dump(getPassengerTypes());
// exit();