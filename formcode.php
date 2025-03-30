<?php
session_start();
include_once 'include/config.php';
if (isset($_POST['register'])) {
    $status = true;
    $insert = array();

    // Validate name (used as username)
    if (empty($_POST['name'])) {
        $insert['name']['error'] = "Name field is required";
        $status = false;
    } else {
        $name = $_POST['name'];
        $insert['name']['value'] = $name;
    }

    // Validate mobile
    if (empty($_POST['mobile'])) {
        $insert['mobile']['error'] = "Mobile field is required";
        $status = false;
    } else {
        $mobile = $_POST['mobile'];
        $insert['mobile']['value'] = $mobile;
    }

    // Validate email
    if (empty($_POST['email'])) {
        $insert['email']['error'] = "Email field is required";
        $status = false;
    } else {
        $email = $_POST['email'];
        $insert['email']['value'] = $email;
    }

    // Validate password and confirm password
    if (empty($_POST['password'])) {
        $insert['password']['error'] = "Password field is required";
        $status = false;
    } elseif ($_POST['password'] !== $_POST['cpassword']) {
        $insert['password']['confirm_error'] = "Passwords do not match";
        $status = false;
    } else {
        $password = md5($_POST['password']);
    }

    $_SESSION['insert'] = $insert;

    if ($status) {
        // Include username in the INSERT query
        $sql_user_insert = "INSERT INTO users (username, user_email, user_mobile, user_password) 
                            VALUES ('$name', '$email', '$mobile', '$password')";
        $x = mysqli_query($conn, $sql_user_insert);

        if ($x) {
            unset($_SESSION['insert']); // Correct the typo here
            header("Location: login.php");
            exit();
        } else {
            // Handle query error
            $_SESSION['insert']['error'] = "Registration failed: " . mysqli_error($conn);
            header("Location: register.php");
            exit();
        }
    } else {
        header("Location: register.php");
        exit();
    }
}
?>