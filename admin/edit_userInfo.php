
<?php
    session_start();
if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User Information</h1>
        <?php
        // Check if there's any success or error message to display
        if (isset($_SESSION["edit_user_message"])) {
            $type = $_SESSION["edit_user"] ? 'success' : 'danger';
            echo '<div class="alert alert-' . $type . '">' . $_SESSION["edit_user_message"] . '</div>';
            unset($_SESSION["edit_user_message"]);
            unset($_SESSION["edit_user"]);
        }
        ?>
        <form action='<?php echo "../action/edit_userInfo.php?pid=" . $pid ?>' method="POST">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" >
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-3">
                <label for="telnum" class="form-label">Telephone Number</label>
                <input type="tel" class="form-control" id="telnum" name="telnum">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <label for="male">Male</label>
                    <input type="radio" id="male" name="gender" value="0" >
                    <label for="female">Female</label>
                    <input type="radio" id="female" name="gender" value="1" >
            </div>
            <button type="submit" class="btn btn-primary" name="editUserBtn">Submit</button>
        </form>
    </div>
</body>
</html>
