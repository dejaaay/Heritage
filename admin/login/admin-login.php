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

            <form action="login.php" method="POST"> <!-- Specify method as POST -->
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Email or Phone">
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="row button">
                    <input type="submit" value="Login">
                </div>
                <a href="forgot_password.php">Forgot your password?</a>
            </form>
        </div>
    </div>
</body>

</html>