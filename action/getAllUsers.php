<?php
include "../settings/connection.php";

// SQL query to select all users and their details
$sql = "SELECT * FROM People WHERE roleID = 1";

// Perform the query
$result = mysqli_query($conn, $sql);

$results = mysqli_fetch_all($result , MYSQLI_ASSOC);

foreach($results as $result){
    // Determine gender text based on the gender value
    $genderText = ($result['gender'] == 1) ? "Male" : "Female";

    echo '
    <tr>
        <td>' . $result['fname'] . " ".$result['lname']. '</td>
        <td>
            ' . $result['email']. ' 
        </td>
        <td>
        ' . $result['telnum'] . ' 
        </td>
        <td>
        ' . $result['dob'] . ' 
    </td>
    <td>
    ' . $genderText . ' 
    </td>
    
    </tr>
    ';
}

