<?php
session_start();
require_once "../../connect/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login</span></div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error text-center"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success text-center"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <form action="login.php" method="POST"> <!-- Specify method as POST -->
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="row password-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i id="eyeIcon" class="fas fa-eye" id="toggleEye"></i>
                    </span>
                </div>
                <div class="row button">
                    <input type="submit" value="Login">
                </div>
                <a href="forgot_password.php">Forgot your password?</a>
            </form>
            <div id="result"><?php echo $msg ?></div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleEye = document.getElementById('toggleEye');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleEye.classList.remove('fa-eye');
                toggleEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleEye.classList.remove('fa-eye-slash');
                toggleEye.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>