<?php
// include("../settings/core.php");
// userIdExist();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="../css/register_style.css" rel="stylesheet">
    <script src="../js/register_user.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>


</head>

<body>
  
    <div class="container">
        <div class="left">
            <h2>
                Register here to start NOW
            </h2>
        </div>
        <div class="right">

            <form name="register_user" method="POST" action="../action/register_action.php" class="register_user" onsubmit="return registerUser(event)">

                <div class="input-group">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                </div>

                <div class="input-group-gender-group">
                    <label>Gender</label>
                    <label for="male">Male</label>
                    <input type="radio" id="male" name="gender" value="0" required>
                    <label for="female">Female</label>
                    <input type="radio" id="female" name="gender" value="1" required>
                </div>

                <div class="input-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
<!-- 
                <div class="input-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option disabled selected value="0">Choose a role</option>
                        <option disabled selected value="1">Client</option>
                        <option disabled selected value="2">Employee</option>

                        </select>
                    
                </div> -->
     
                <div class="input-group">
                    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <input type="password" id="retypePassword" name="retypePassword" placeholder="Retype Password"
                    required>
                </div>

                <button type="submit" class="signUpbtn" id="signUpbtn" name="signUpbtn">Register</button>
                <p>Already have an account? <a href="../Login/login_view.php" id="registerHere">Login here</a></p>
            </form>

        </div>
    </div>
    <script>
    <?php
    // Check the value of $_SESSION["login"]
    if (isset($_SESSION["register"])) {
      // Check if it's a success or error
      $type = ($_SESSION["register"] === true) ? 'success' : 'error';

      // Get the message from $_SESSION["register_msg"]
      $message = $_SESSION["register_msg"];
      // Unset the session variables
      unset($_SESSION["register"]);
      unset($_SESSION["register_msg"]);
      // Output JavaScript code to show the alert
      echo "showAlert('$message', '$type');";
    }
    ?>
    function showAlert(message, type) {
      Swal.fire({
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 2000
      });

    }
  </script>
</body>

</html>