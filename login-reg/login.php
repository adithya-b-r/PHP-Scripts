<?php
//Create a folder core and store the scripts within it
include '../core/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailPhone = $_POST['emailPhone'];
    $pass = $_POST['pass'];

    //Retrive data from db
    $sql_query = "SELECT * FROM users WHERE emailphone = '$emailPhone' AND pass = '$pass'";
    $result = mysqli_query($connection, $sql_query);  //Execute sql query in db

    if (mysqli_num_rows($result) == 1) {
        //If user found, set session variables and redirect to Home page
        $row = mysqli_fetch_assoc($result);
        $_SESSION['uname'] = $row['name'];
        $_SESSION['alert'] = 'Login successful!';
    } else {
        $_SESSION['alert'] = 'Invalid email/phone or password!';
    }

    header("Location: ../index.php"); // Redirect to Home page
    exit();
}
?>
