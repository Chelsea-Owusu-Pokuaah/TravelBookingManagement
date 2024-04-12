<?php
include "../settings/connection.php";
function getStatus()
{
    global $conn;
    $select_type_query = "SELECT `status_id`, `status_name` FROM Status";
    $result = mysqli_fetch_all(mysqli_query($conn, $select_type_query), MYSQLI_ASSOC);
    return $result;
}

// var_dump(getPassengerTypes());
// exit();