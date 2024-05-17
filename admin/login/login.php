<?php
session_start();
include "../../connect/connect.php";

// Initialize login attempts and consecutive failed attempts if not already set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (!isset($_SESSION['consecutive_failed_attempts'])) {
    $_SESSION['consecutive_failed_attempts'] = 0;
}

// Check if the user is blocked
if (isset($_SESSION['blocked_until']) && $_SESSION['blocked_until'] > time()) {
    $remaining_time = $_SESSION['blocked_until'] - time();
    header("Location: admin-login.php?error=You are temporarily blocked. Please try again in $remaining_time seconds.");
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
        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // Check if exactly one row was returned
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                // Verify the entered password against the stored hashed password
                if (password_verify($password, $row['password'])) {
                    // Store user data in session variables
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['login_attempts'] = 0; // Reset login attempts on successful login
                    $_SESSION['consecutive_failed_attempts'] = 0; // Reset consecutive failed attempts
                    header("Location: ../dashboard/admin-dashboard.php");
                    exit();
                } else {
                    // Invalid login credentials
                    $_SESSION['login_attempts'] += 1;
                    $_SESSION['consecutive_failed_attempts'] += 1;

                    if ($_SESSION['login_attempts'] >= 3) {
                        // Calculate blocking duration dynamically
                        $block_duration = 30 * ceil($_SESSION['consecutive_failed_attempts'] / 3);
                        $_SESSION['blocked_until'] = time() + $block_duration;
                        $_SESSION['login_attempts'] = 0; // Reset login attempts
                        header("Location: admin-login.php?error=You are temporarily blocked. Please try again in $block_duration seconds.");
                        exit;
                    } else {
                        // Provide error message with remaining attempts
                        $remaining_attempts = 3 - $_SESSION['login_attempts'];
                        header("Location: admin-login.php?error=Incorrect username or password. You have $remaining_attempts attempts remaining.");
                        exit();
                    }
                }
            } else {
                header("Location: admin-login.php?error=Incorrect username or password");
                exit();
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
