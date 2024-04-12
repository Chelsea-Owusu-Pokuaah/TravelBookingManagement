<?php
include ('../settings/connection.php');

session_start();

if (isset($_POST['loginbtn'])) {

    $email = mysqli_escape_string($conn, $_POST['email']);
    // echo $email;
    // exit;
    $password = mysqli_escape_string($conn,$_POST['password']);

    // checking if email exists
    $get_user_sql = "SELECT * FROM People WHERE email = '$email'";
    $get_user_result = mysqli_query($conn, $get_user_sql);
    // $get_user->execute();
    // $result = $get_user->get_result();
    // echo $get_user_sql;
    // echo var_dump($get_user_result);
    // exit();
    if ($get_user_result->num_rows > 0) {
        $result = mysqli_fetch_all($get_user_result, MYSQLI_ASSOC);
        // var_dump($result);
        $result = $result[0];
        // var_dump($result);
        if (password_verify($password, $result["passwd"])) {

            $_SESSION['user_id'] = $result['pid'];
            $_SESSION['user_fname'] = $result['fname'];
            $_SESSION['user_lname'] = $result['lname'];
            $_SESSION['role_id'] = $result['roleID'];
            if ($_SESSION['role_id'] == 2){
                $_SESSION['login'] = true;
                $_SESSION['login_msg'] = "Login was successful";
                header('Location: ../admin/dashboard.php');
                $conn->close();
                exit();
            }
            // echo "here";
            // exit;
            $_SESSION['login'] = true;
            $_SESSION['login_msg'] = "Login succesful";
            // echo $_SESSION['login_msg'];
            // exit();
            header('Location: ../view/dashboard.php');
            $conn->close();
            exit();
         } else {
        //     echo "false";
        //     exit();
            $_SESSION['login'] = false;
            $_SESSION['login_msg'] = "Incorrect Password";
            // header('Location: ../Login/login_view.php');
            $conn->close();
            exit();
        }
    } else {
        // echo "false";
        // exit();
        $_SESSION['login'] = false;
        $_SESSION['login_msg'] = "Account doesn't exits";
        header('Location: ../Login/login_view.php');
        $conn->close();
        exit();
    }
} else {
    // redirect to login
    // echo "Th?";
    // exit();
    header('Location: ../Login/login_view.php');
    $conn->close();
    exit();
}
