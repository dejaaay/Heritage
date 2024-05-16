<?php
session_start();
include "../../connect/connect.php";

// Initialize login attempts if not already set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Check if the user is blocked
if (isset($_SESSION['blocked']) && $_SESSION['blocked'] === true) {
    header('Location: admin-login.php?error=You are temporarily blocked due to multiple failed login attempts.');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        } elseif (empty($password)) {
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
                // Store user data in session variables
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../dashboard/admin-dashboard.php");
                exit();
            } else {
                // Invalid login credentials
                $_SESSION['login_attempts'] += 1;

                if ($_SESSION['login_attempts'] >= 3) {
                    // Block the user after 3 failed attempts
                    $_SESSION['blocked'] = true;
                    header('Location: admin-login.php?error=You are temporarily blocked due to multiple failed login attempts.');
                    exit;
                } else {
                    // Provide error message with remaining attempts
                    $remaining_attempts = 3 - $_SESSION['login_attempts'];
                    header("Location: admin-login.php?error=Incorrect username or password. You have $remaining_attempts attempts remaining.");
                    exit;
                }
            }
        } else {
            header("Location: admin-login.php?error=Query failed");
            exit();
        }
    }
} else {
    header("Location: admin-login.php");
    exit();
}
