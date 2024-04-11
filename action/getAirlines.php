<?php
include "../settings/connection.php";
function getAirlines()
{
    global $conn;
    $select_type_query = "SELECT * FROM `Airline` ";
    $result = mysqli_fetch_all(mysqli_query($conn, $select_type_query), MYSQLI_ASSOC);
    return $result;
}
// var_dump(getPassengerTypes());
// exit();