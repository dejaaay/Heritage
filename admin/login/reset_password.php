<?php
session_start();
include "../../connect/connect.php";

if (isset($_SESSION['reset_user']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $username = $_SESSION['reset_user'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $password = validate($password);
    $confirm_password = validate($confirm_password);

    if ($password !== $confirm_password) {
        header("Location: reset_password.php?error=Passwords do not match");
        exit();
    } else {

        // Update the user's password in the database
        $sql = "UPDATE admin SET password='$password' WHERE username='$username'";
        if (mysqli_query($con, $sql)) {
            // Unset the reset_user session variable
            unset($_SESSION['reset_user']);
            header("Location: admin-login.php?success=Your password has been reset successfully");
            exit();
        } else {
            header("Location: reset_password.php?error=Something went wrong. Please try again.");
            exit();
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4">
            <h2 class="text-center mb-4">Reset Password</h2>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
            <form action="reset_password.php" method="POST">
                <div class="mb-3">
                    <label for="password" class="form-label">Enter your new password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm your new password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>