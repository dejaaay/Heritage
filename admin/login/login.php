<?php
session_start();
include "../../connect/connect.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: admin-login.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: admin-login.php?error=Password is required");
        exit();
    }

    // Execute SQL query to check if the user exists
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Check if exactly one row was returned
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // Check if username and password match
            if ($row['username'] === $username && $row['password'] === $password) {
                // Store user data in session variables
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../dashboard/admin-dashboard.php");
                exit();
            } else {
                header("Location: admin-login.php?error=Incorrect username or password");
                exit();
            }
        } else {
            header("Location: admin-login.php?error=Incorrect username or password");
            exit();
        }
    } else {
        header("Location: admin-login.php?error=Query failed");
        exit();
    }
} else {
    header("Location: admin-login.php");
    exit();
}
