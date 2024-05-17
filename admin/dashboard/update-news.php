<?php
session_start();
include '../../connect/connect.php';

// Check if user is authenticated
// if (!isset($_SESSION['admin_user'])) {
//     header("Location: ../../login/login.php");
//     exit;
// }

// Handle the update request
if (isset($_GET['updateid'])) {
    $news_id = mysqli_real_escape_string($con, $_GET['updateid']);
    $sql = "SELECT * FROM `news` WHERE news_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $news_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $news_name = $row['news_name'];
        $news_desc = $row['news_desc'];
        $news_date = $row['news_date'];
        $news_time = $row['news_time'];
        $news_img = $row['news_img'];
    } else {
        header('Location: admin-news.php');
        exit;
    }
    $stmt->close();
} else {
    header('Location: admin-news.php');
    exit;
}

// Handle form submission
$errors = [];

if (isset($_POST['submit'])) {
    $news_name = mysqli_real_escape_string($con, $_POST['news_name']);
    $news_desc = mysqli_real_escape_string($con, $_POST['news_desc']);
    $news_date = mysqli_real_escape_string($con, $_POST['news_date']);
    $news_time = mysqli_real_escape_string($con, $_POST['news_time']);

    // Handle file upload for news image if a new image is selected
    if (!empty($_FILES['news_img']['name'])) {
        $news_img = 'images/' . $_FILES['news_img']['name'];
        $news_image_tmp = $_FILES['news_img']['tmp_name'];

        move_uploaded_file($news_image_tmp, $news_img);
    } else {
        // Use existing image path if a new image is not provided
        $news_img = $row['news_img'];
    }

    // Validate required fields
    if (empty($news_name) || empty($news_desc) || empty($news_date) || empty($news_time)) {
        $errors[] = "All fields are required.";
    }

    // Check if no validation errors occurred
    if (empty($errors)) {
        // Update the news data
        $sql = "UPDATE `news` SET news_name=?, news_desc=?, news_date=?, news_time=?, news_img=? WHERE news_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssi', $news_name, $news_desc, $news_date, $news_time, $news_img, $news_id);

        if ($stmt->execute()) {
            header('Location: admin-news.php?success=1');
            exit();
        } else {
            $errors[] = "Failed to update news: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit news</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/SK-Icon.png">
    <link rel="stylesheet" href="../../css/addnews.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div>
    <?php include "admin-header.php" ?>
</div>

<div class="main-content-container">
<div class="event-form-container">
    <div class="event-input-container">
        <h1 class="form-header">Edit News</h1>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="input-container">
                <input type="text" class="input form-control" id="newsName" name="news_name" value="<?php echo $news_name; ?>">
                <label class="label">News Name</label>
            </div>
            <div class="input-container">
                <textarea class="input form-control" id="newsDescription" name="news_desc" rows="3"><?php echo $news_desc; ?></textarea>
                <label class="label">News Description</label>
            </div>
            <div class="input-container">
                <input type="date" class="input form-control" id="newsDate" name="news_date" value="<?php echo $news_date; ?>">
                <label class="label">News Date</label>
            </div>
            <div class="input-container">
                <input type="time" class="input form-control" id="newsTime" name="news_time" value="<?php echo $news_time; ?>">
                <label class="label">News Time</label>
            </div>

            <div class="input-image-container">
                <label for="newsImage" class="label">
                <button id="fileButton" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125" stroke="#fffffff" stroke-width="2"></path>
                    <path d="M17 15V18M17 21V18M17 18H14M17 18H20" stroke="#fffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Add Image
                </button>
            </label>
            <input class="input form-control" type="file" id="newsImage" name="news_img" accept="image/jpeg, image/jpg, image/png">
            </div>

            <div class="buttons-container">
                <input type="submit" class="btn btn-success" name="submit" value="Update">
                <button type="button" class="btn btn-danger" name="cancel" onclick="goBack()">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div>

<div id="errorPopup" class="popup">
  <div class="popup-content">
    <span class="close" onclick="closePopup()">&times;</span>
    <p id="errorMessage"></p>
    <center>
      <dotlottie-player src="https://lottie.host/23175b72-edf2-4781-a175-7e7ca03fc3ab/t4kdPVrxsW.json" background="transparent" speed="1" style="width: 150px; height: 150px;" loop autoplay></dotlottie-player>
    </center>
  </div>
</div>

<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
// Function to validate form
function validateForm() {
    const newsName = document.getElementById('newsName').value.trim();
    const newsDescription = document.getElementById('newsDescription').value.trim();
    const newsDate = document.getElementById('newsDate').value.trim();
    const newsTime = document.getElementById('newsTime').value.trim();
    const newsImage = document.getElementById('newsImage').value;

    // Validate image format
    if (newsImage) {
        const fileName = newsImage.trim().toLowerCase();
        const validImageExtensions = ['jpg', 'jpeg', 'png'];
        const imageExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (!validImageExtensions.includes(imageExtension)) {
            displayError('Please upload a valid image (jpg, jpeg, or png).');
            return false;
        }
    }

    // Validate other fields not empty
    if (newsName === '' || newsDescription === '' || newsDate === '' || newsTime === '') {
        displayError('Please input all fields.');
        return false;
    }

    // Validate date format
    const datePattern = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD format
    if (!datePattern.test(newsDate)) {
        displayError('News date must be in the format YYYY-MM-DD.');
        return false;
    }

    return true;
}

// Function to go back
function goBack() {
    window.location.href = 'admin-news.php';
}

// Function to display error message
function displayError(message) {
    const errorMessage = document.getElementById('errorMessage');
    errorMessage.textContent = message;
    const popup = document.getElementById('errorPopup');
    popup.style.display = 'block';
}

// Function to close error popup
function closePopup() {
    const popup = document.getElementById('errorPopup');
    popup.style.display = 'none';
}
</script>
</body>
</html>
