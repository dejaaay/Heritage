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
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<style>
    .position-relative .fas {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .ps-5 {
        padding-left: 2.5rem;
    }

    .show-password {
        right: 10px;
        cursor: pointer;
        display: none;
        /* Initially hidden */
    }
</style>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login</span></div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error text-center m-3 mb-0 "><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success text-center m-3 mb-0 "><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <form action="login.php" method="POST">
                <div class="mb-3 position-relative">
                    <i class="fas fa-user position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                    <input type="text" name="username" id="username" class="form-control ps-5" placeholder="Username">
                </div>
                <div class="mb-3 position-relative">
                    <i class="fas fa-lock position-absolute" style="left: 10px;"></i>
                    <input type="password" name="password" id="password" class="form-control ps-5" placeholder="Password" required>
                    <i class="fas fa-eye show-password position-absolute" style="right: 10px;" onclick="togglePasswordVisibility()"></i>
                </div>
                <div class="row button m-0 d-flex align-items-center justify-content-center">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
                <div>
                    <a href="forgot_password.php">Forgot your password?</a>
                </div>
            </form>

        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const showPasswordIcon = document.querySelector('.show-password');
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

        // Show the eye icon when the password input is focused
        document.getElementById('password').addEventListener('focus', function() {
            document.querySelector('.show-password').style.display = 'block';
        });

        // Hide the eye icon when the password input is blurred and empty
        document.getElementById('password').addEventListener('blur', function() {
            if (!this.value) {
                document.querySelector('.show-password').style.display = 'none';
            }
        });
    </script>
</body>

</html>