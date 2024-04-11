<?php
//the session global variable is used to return error messages 
// process of debigging: check all your variable names, try to print statements to find where the code breaks
// 
include "../settings/connection.php";

if (isset($_POST["signUpbtn"])) {
    // Collecting inputs from user
    $fname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $telnum = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    // $family_role = mysqli_real_escape_string($conn, $_POST['familyRole']);
    $roleID = 1;

    // Ensure that the user email is unique
    $check_email_query = "SELECT * FROM People WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);



    if (mysqli_num_rows($check_email_result) > 0) {
        $_SESSION["register"] = false;
        $_SESSION["register_msg"] = "Email has already been used";
        header("Location: ../Login/login_view.php");
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $insert_person_query = "INSERT INTO `People`(`fname`, `lname`, `email`, `telnum`, `dob`, `roleID`, `gender`, `passwd`) VALUES ( '$fname', '$lname', '$email', '$telnum', '$dob', '$roleID', '$gender', '$hashed_password')";
    // echo $insert_person_query;
    // exit;

    if (mysqli_query($conn, $insert_person_query)) {
        // Successful registration
        // echo "success";
        // exit;
        $_SESSION["register"] = true;
        $_SESSION["register_msg"] = "Registration succesful";
        header("Location: ../Login/login_view.php");
        // echo "success";
        exit();
    } else {
        // Registration failed
        $_SESSION["register"] = false;
        $_SESSION["register_msg"] = "Error occures, Try again";
        header("Location: ../Login/register_view.php");
        // echo "failed";
        $conn->close();
        exit();
    }
} else {
    $_SESSION["register"] = false;
    $_SESSION["register_msg"] = "Error occured, Try again";
    header("Location: ../Login/register_view.php");
    $conn->close();
    exit();
}

