<?php
include("../action/getUserDetails.php");

function userDetails(){
    $result = getProfileDetails() ;

    echo "<p><strong>Name: </strong> $result[fname] $result[lname]</p>";
    echo "<p><strong>Email:</strong>$result[email]</p>";
    echo"<p><strong>Date of Birth:</strong> $result[dob]</p>";
    if($result['gender']==1){
        echo"<p><strong>Gender:</strong> Female</p>";
    
    }
    else{
        echo"<p><strong>Gender:</strong> Male</p>";
    }
}


   
