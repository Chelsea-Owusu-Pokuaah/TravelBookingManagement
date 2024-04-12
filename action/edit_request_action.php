<?php
include("../settings/connection.php");
include("../settings/core.php");

userIdExist();

if (isset($_POST['updateBookingBtn'])) {
    // Check if the required variables are set
    if (isset($_GET['requestID'])) {
        // Sanitize input
        $requestID = mysqli_real_escape_string($conn, $_GET['requestID']);

        // Check if the current status is not booked or canceled
        $statusQuery = "SELECT status_name FROM BookingRequest JOIN Status ON Status.status_ID = BookingRequest.statusID WHERE requestID = '$requestID'";
        $statusResult = mysqli_query($conn, $statusQuery);
        $statusRow = mysqli_fetch_assoc($statusResult);
        $currentStatus = $statusRow['status_name'];

        if ($currentStatus != 'Booked' && $currentStatus != 'Canceled') {
            // Continue with the update process

            // Continue with the update process

            $destination = isset($_POST['destination']) ? mysqli_real_escape_string($conn, $_POST['destination']) : '';
            $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';
            $duration = isset($_POST['duration']) ? mysqli_real_escape_string($conn, $_POST['duration']) : '';
            $people = isset($_POST['people']) ? mysqli_real_escape_string($conn, $_POST['people']) : '';
            $budget = isset($_POST['budget']) ? mysqli_real_escape_string($conn, $_POST['budget']) : '';
            $passengerType = isset($_POST['passengerType']) ? mysqli_real_escape_string($conn, $_POST['passengerType']) : '';

            // Ensure at least one field is provided
            if (empty($destination) && empty($date) && empty($duration) && empty($people) && empty($budget) && empty($passengerType)) {
                $_SESSION['booking_updated'] = 'At least one field must be entered';
                $_SESSION['update'] = false;
                header('Location: ../view/booking_view.php');
                exit();
            }

            // Check if the new date is in the future
            $currentDate = date("Y-m-d");
            if (!empty($date) && strtotime($date) <= strtotime($currentDate)) {
                $_SESSION["booking_updated"] = "Booking date must be in the future.";
                $_SESSION["update"] = false;
                header("Location: ../view/booking_view.php");
                exit();
            }

            // Check for duplicate bookings
            $check_duplicate_query = "SELECT * FROM `BookingRequest` WHERE destination = '$destination' AND date = '$date'";
            $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);
            if (mysqli_num_rows($check_duplicate_result) > 0) {
                $_SESSION["booking_updated"] = "A similar booking already exists.";
                $_SESSION["update"] = false;
                header("Location: ../view/booking_view.php");
                exit();
            }

            // Update query
            $update_query = "UPDATE BookingRequest SET";
            $update_fields = array();

            if (!empty($destination)) {
                $update_fields[] = " destination = '$destination'";
            }
            if (!empty($date)) {
                $update_fields[] = " date = '$date'";
            }
            if (!empty($duration)) {
                $update_fields[] = " duration = '$duration'";
            }
            if (!empty($people)) {
                $update_fields[] = " numberOfPeople = '$people'";
            }
            if (!empty($budget)) {
                $update_fields[] = " budget = '$budget'";
            }
            if (!empty($passengerType)) {
                $update_fields[] = " passengerType = '$passengerType'";
            }

            $update_query .= implode(', ', $update_fields);
            $update_query .= " WHERE requestID = '$requestID'";

            $update_query_result = mysqli_query($conn, $update_query);

            if ($update_query_result) {
                $_SESSION['booking_updated'] = 'Booking updated successfully';
                $_SESSION['update'] = true;
                header('Location: ../view/booking_view.php');
                exit();
            } else {
                $_SESSION['booking_updated'] = 'Failed to update booking';
                $_SESSION['update'] = false;
                header('Location: ../view/booking_view.php');
                exit();
            }

        } else {
            // If the current status is booked or canceled, show an error message
            $_SESSION['booking_updated'] = 'Cannot edit a booking that is already booked or canceled.';
            $_SESSION['update'] = false;
            header('Location: ../view/booking_view.php');
            exit();
        }
    } else {
        // Handle case where requestID is not set
        $_SESSION['booking_updated'] = 'Missing request ID';
        $_SESSION['update'] = false;
        header('Location: ../view/booking_view.php');
        exit();
    }
}
?>
