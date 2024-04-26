<?php
include '../core/config.php';

//Creating session
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Store Form data to PHP variables
    $uname = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    //Retriving data from db to check whether user already exists.
    $sql_query = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql_query);
    $row = mysqli_fetch_assoc($result);

    if (empty($uname) || empty($email) || empty($pass)) {   //Check if any of the input field is empty.
        $_SESSION['alert'] = 'Please fill all fields!';
    } elseif ($email == $row['email']) {  
        $_SESSION['alert'] = 'User with the same email already exists!';
    } elseif ($pass != $cpass) {
        $_SESSION['alert'] = 'Passwords do not match!';
    } else {
        //Get Total no. of users
        $sql_count = "SELECT COUNT(*) AS total FROM users";
        $result_count = mysqli_query($connection, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $total_users = $row_count['total'];

        // Generate user ID [It must be unique]
        $user_id = (int) $total_users + 1;

        // Insert user data into the database
        $sql_insert = "INSERT INTO users (user_id, name, email, pass) VALUES ('$user_id', '$uname', '$email', '$pass')";
        if (mysqli_query($connection, $sql_insert)) {
            //Store variables in session.
            $_SESSION['uname'] = $uname;
            $_SESSION['alert'] = 'Registration successful!';
        } else {
            $_SESSION['alert'] = 'An error occurred. Please try again later.';
        }
    }

    header("Location: ../index.php");  //Redirect to Home Page
    exit();
}
?>
