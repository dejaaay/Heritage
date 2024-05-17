<?php
session_start();
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

            <form action="login.php" method="POST">
                <div class="mb-3 position-relative">
                <i class="fas fa-user position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="username" id="username" class="form-control ps-5" placeholder="Username">
                </div>
                <div class="mb-3 position-relative">
                <i class="fas fa-lock position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                <input type="password" name="password" id="password" class="form-control ps-5" placeholder="Password" required>
                </div>
                <div class="row button mb-3">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
                <div class="text-center">
                    <a href="forgot_password.php">Forgot your password?</a>
                </div>
            </form>

        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>

</html>
