<?php
include("../action/getUserDetails.php");

function userDetails(){
    $result = getProfileDetails() ;

    echo "<div><p><strong>Name: </strong> $result[fname] $result[lname]</p></div>";
    echo "<div><p><strong>Email:</strong> $result[email]</p></div>";
    echo "<div><p><strong>Date of Birth:</strong> $result[dob]</p></div>";
    if ($result['gender'] == 1) {
        echo "<div><p><strong>Gender:</strong> Female</p></div>";
    } else {
        echo "<div><p><strong>Gender:</strong> Male</p></div>";
    }
}


   
