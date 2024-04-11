<?php
include("../settings/core.php");
include "../settings/connection.php";

function getProfileDetails(){
global $conn;
$userID = userIdExist();
$profile_data_query = "SELECT fname,lname, dob, email, gender, telnum FROM `People` WHERE pid = '$userID'";
$profile_data_result = mysqli_query($conn, $profile_data_query);
$result = mysqli_fetch_assoc($profile_data_result);
return $result;
}
