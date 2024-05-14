<?php
session_start();
include "../../connect/connect.php";

if (isset($_SESSION['reset_user']) && isset($_POST['password'])) {
    $username = $_SESSION['reset_user'];
    $password = $_POST['password'];
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $password = validate($_POST['password']);

    // Update the user's password in the database
    $sql = "UPDATE admin SET password='$password' WHERE username='$username'";
    if (mysqli_query($con, $sql)) {
        // Unset the reset_user session variable
        unset($_SESSION['reset_user']);
        header("Location: admin-login.php");
        echo "Your password has been reset successfully.";
    } else {
        echo "Something went wrong. Please try again.";
    }
} elseif (!isset($_SESSION['reset_user'])) {
    header("Location: reset_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="reset_password.php" method="POST">
            <div>
                <label for="password">Enter your new password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>