<?php
include("../settings/core.php");
include "../settings/connection.php";

// $requestID =
function getUserDetails(){
    if(isset($_GET['requestID'])){
        $reqID = $_GET['requestID'];
    }
    global $conn;
    $profile_data_query = "SELECT fname,lname,email, gender, telnum FROM `People` JOIN BookingRequest ON BookingRequest.pid = People.pid WHERE requestID = '$reqID'";
    $profile_data_result = mysqli_query($conn, $profile_data_query);
    $result = mysqli_fetch_assoc($profile_data_result);
    return $result;
}
getUserDetails();