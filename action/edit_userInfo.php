<?php
// Include the connection file
include "../settings/connection.php";

// Function to handle error during user editing
function handleEditUserError($errorMessage)
{
    $_SESSION["edit_user"] = false;
    $_SESSION["edit_user_message"] = $errorMessage;
    header("Location: ../admin/users.php");
    exit();
}

// Function to handle success during user editing
function handleEditUserSuccess($successMessage)
{
    $_SESSION["edit_user"] = true;
    $_SESSION["edit_user_message"] = $successMessage;
    header("Location: ../admin/users.php");
    exit();
}

// Check if the form is submitted
if(isset($_POST['editUserBtn'])) {
    // Retrieve form data
    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $fname = isset($_POST['fname']) ? mysqli_real_escape_string($conn, $_POST['fname']) : null;
    $lname = isset($_POST['lname']) ? mysqli_real_escape_string($conn, $_POST['lname']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $telnum = isset($_POST['telnum']) ? mysqli_real_escape_string($conn, $_POST['telnum']) : null;
    $dob = isset($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : null;
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : null;

    // Initialize an empty array to store the update statements
    $updateStatements = array();

    // Check if at least one field other than pid is entered for update
    $fieldsToUpdate = array('fname', 'lname', 'email', 'telnum', 'dob', 'gender');
    $atLeastOneFieldEntered = false;

    foreach ($fieldsToUpdate as $field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $atLeastOneFieldEntered = true;
            break;
        }
    }

    // If no field other than pid is entered for update, show error
    if (!$atLeastOneFieldEntered) {
        handleEditUserError("No fields entered for update.");
    }

    // Check for duplicate email if email field is entered for update
    if (!empty($email)) {
        $duplicateCheckQuery = "SELECT * FROM People WHERE email = '$email' AND pid != '$pid'";
        $duplicateCheckResult = mysqli_query($conn, $duplicateCheckQuery);
        if (mysqli_num_rows($duplicateCheckResult) > 0) {
            handleEditUserError("Email already exists. Please choose a different one.");
        }
    }

    // Construct the update statements
    if (!empty($fname)) {
        $updateStatements[] = "fname='$fname'";
    }
    if (!empty($lname)) {
        $updateStatements[] = "lname='$lname'";
    }
    if (!empty($email)) {
        $updateStatements[] = "email='$email'";
    }
    if (!empty($telnum)) {
        $updateStatements[] = "telnum='$telnum'";
    }
    if (!empty($dob)) {
        $updateStatements[] = "dob='$dob'";
    }
    if (!empty($gender)) {
        $updateStatements[] = "gender='$gender'";
    }

    // Construct the final update query by joining the update statements
    $updateQuery = "UPDATE People SET " . implode(", ", $updateStatements) . " WHERE pid='$pid'";

    // Execute the query
    if(mysqli_query($conn, $updateQuery)) {
        // User information updated successfully
        // Redirect the user to a success page or back to the user edit page
        handleEditUserSuccess("User information updated successfully.");
    } else {
        // Error occurred while updating user information
        // You can handle the error in various ways, such as displaying an error message or redirecting to an error page
        handleEditUserError("Error updating user information: " . mysqli_error($conn));
    }
} else {
    // Form is not submitted
    // Redirect the user to an error page or back to the user edit page with an error message
    handleEditUserError("Form data not submitted.");
}
?>
