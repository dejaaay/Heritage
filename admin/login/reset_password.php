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
        // Hash the new password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET password='$hashed_password' WHERE username='$username'";
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
    <link rel="stylesheet" href="../../css/reset_password.css">
</head>

<body>
<div class="d-flex justify-content-start mt-3">
        <a href="admin-login.php" class="btn btn-secondary row-button">Back</a>
    </div>
    <div class="container vh-100 align-items-center d-flex justify-content-start mt-0">
        <div class="wrapper">
            <h2 class="title text-center m-0">Reset Password</h2>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
            <form action="reset_password.php" method="POST">
                <div class="mb-3 position-relative>
                    <label for="password" class="form-label">Enter your new password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="confirm_password" class="form-label">Confirm your new password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="row button m-0 d-flex align-items-center justify-content-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
