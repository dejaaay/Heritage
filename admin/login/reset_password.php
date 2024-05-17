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
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/reset_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<style>
    .position-relative {
        position: relative;
    }

    .show-password {
        position: absolute;
        top: 72%;
        right: 12px;
        /* Adjust the right distance */
        transform: translateY(-50%);
        cursor: pointer;
        display: none;
    }
</style>

<body>
    <div class="d-flex justify-content-start mt-3">
        <a href="admin-login.php" class="btn btn-secondary row-button">Back</a>
    </div>
    <div class="container vh-100 align-items-center d-flex justify-content-start mt-0">
        <div class="wrapper">
            <h2 class="title text-center m-0">Reset Password</h2>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger m-3 mb-0" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
            <form action="reset_password.php" method="POST">
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Enter your new password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <i class="fas fa-eye show-password position-absolute" onclick="togglePasswordVisibility('password')"></i>
                </div>
                <div class="mb-3 position-relative">
                    <label for="confirm_password" class="form-label">Confirm your new password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    <i class="fas fa-eye show-password position-absolute" onclick="togglePasswordVisibility('confirm_password')"></i>
                </div>
                <div class="row button m-0 d-flex align-items-center justify-content-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>
    <script>
        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            const showPasswordIcon = passwordInput.nextElementSibling;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordIcon.classList.remove('fa-eye');
                showPasswordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                showPasswordIcon.classList.remove('fa-eye-slash');
                showPasswordIcon.classList.add('fa-eye');
            }
        }

        function handleFocus(event) {
            const showPasswordIcon = event.target.nextElementSibling;
            showPasswordIcon.style.display = 'block';
        }

        function handleBlur(event) {
            const showPasswordIcon = event.target.nextElementSibling;
            if (!event.target.value) {
                showPasswordIcon.style.display = 'none';
            }
        }

        document.getElementById('password').addEventListener('focus', handleFocus);
        document.getElementById('password').addEventListener('blur', handleBlur);
        document.getElementById('confirm_password').addEventListener('focus', handleFocus);
        document.getElementById('confirm_password').addEventListener('blur', handleBlur);
    </script>
</body>

</html>