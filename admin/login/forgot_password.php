<?php
session_start();
include "../../connect/connect.php";

$error = '';

if (isset($_POST['username']) && isset($_POST['answer1']) && isset($_POST['answer2'])) {
    $username = $_POST['username'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];

    // Escape user inputs for security
    $username = mysqli_real_escape_string($con, $username);
    $answer1 = mysqli_real_escape_string($con, $answer1);
    $answer2 = mysqli_real_escape_string($con, $answer2);

    // Fetch the stored answers for the user
    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the provided answers match the stored answers
        if ($row['security_answer_1'] === $answer1 && $row['security_answer_2'] === $answer2) {
            $_SESSION['reset_user'] = $username; // Store username in session for password reset
            header("Location: reset_password.php");
            exit();
        } else {
            $error = "Incorrect answers to security questions.";
        }
    } else {
        $error = "No account found with that username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/dejaaay/Cabelen/main/assets/img/Cabalen.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/forgot_password.css">
</head>

<body>
    <!-- Back Button -->
    <div class="d-flex justify-content-start mt-3">
        <a href="admin-login.php" class="btn btn-secondary row-button">Back</a>
    </div>
    <div class="container vh-100 align-items-center d-flex justify-content-start mt-0">
        <div class="wrapper">
            <div class="title text-center"><span>Forgot Password</span></div>
            <form action="forgot_password.php" method="POST">
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Enter your username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="answer1" class="form-label">Security Question 1: What's your favorite subject?</label>
                    <input type="text" class="form-control" id="answer1" name="answer1" required>
                </div>
                <div class="mb-3">
                    <label for="answer2" class="form-label">Security Question 2: Who's your favorite professor?</label>
                    <input type="text" class="form-control" id="answer2" name="answer2" required>
                </div>
                <div class="mb-3">
                    <label for="answer3" class="form-label">Security Question 3: Who's the most handsome professor?</label>
                    <input type="text" class="form-control" id="answer3" name="answer3" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary row-button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>