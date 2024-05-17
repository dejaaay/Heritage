<?php
session_start();
include '../../connect/connect.php';

// Check if user is authenticated
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: ../login/admin-login.php");
    exit();
}

// Handle the update request
if (isset($_GET['updateid'])) {
    $restos_id = mysqli_real_escape_string($con, $_GET['updateid']);
    $sql = "SELECT * FROM `restos` WHERE restos_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $restos_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $restos_name = $row['restos_name'];
        $restos_desc = $row['restos_desc'];
        $restos_oprtn = $row['restos_oprtn'];
        $restos_link = $row['restos_link'];
        $restos_img = $row['restos_img'];
    } else {
        header('Location: admin-restos.php');
        exit;
    }
    $stmt->close();
} else {
    header('Location: admin-restos.php');
    exit;
}

// Handle form submission
$errors = [];

if (isset($_POST['submit'])) {
    $restos_name = mysqli_real_escape_string($con, $_POST['restos_name']);
    $restos_desc = mysqli_real_escape_string($con, $_POST['restos_desc']);
    $restos_oprtn = mysqli_real_escape_string($con, $_POST['restos_oprtn']);
    $restos_link = mysqli_real_escape_string($con, $_POST['restos_link']);

    // Handle file upload for restos image if a new image is selected
    if (!empty($_FILES['restos_img']['name'])) {
        $restos_img = 'images/' . $_FILES['restos_img']['name'];
        $restos_image_tmp = $_FILES['restos_img']['tmp_name'];

        move_uploaded_file($restos_image_tmp, $restos_img);
    } else {
        // Use existing image path if a new image is not provided
        $restos_img = $row['restos_img'];
    }

    // Valioprtn required fields
    if (empty($restos_name) || empty($restos_desc) || empty($restos_oprtn) || empty($restos_link)) {
        $errors[] = "All fields are required.";
    }

    // Check if no validation errors occurred
    if (empty($errors)) {
        // Update the restos data
        $sql = "UPDATE `restos` SET restos_name=?, restos_desc=?, restos_oprtn=?, restos_link=?, restos_img=? WHERE restos_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssi', $restos_name, $restos_desc, $restos_oprtn, $restos_link, $restos_img, $restos_id);

        if ($stmt->execute()) {
            header('Location: admin-restos.php?success=1');
            exit();
        } else {
            $errors[] = "Failed to update restos: " . $stmt->error;
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
    <title>Edit Restos</title>
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
                <input type="text" class="input form-control" id="restosName" name="restos_name" value="<?php echo $restos_name; ?>">
                <label class="label"> Restos Name</label>
            </div>
            <div class="input-container">
                <textarea class="input form-control" id="restosDescription" name="restos_desc" rows="3"><?php echo $restos_desc; ?></textarea>
                <label class="label">Restos Description</label>
            </div>
            <div class="input-container">
                <input type="time" class="input form-control" id="restosDate" name="restos_oprtn" value="<?php echo $restos_oprtn; ?>">
                <label class="label">Restos Date</label>
            </div>
            <div class="input-container">
                <input type="text" class="input form-control" id="restosTime" name="restos_link" value="<?php echo $restos_link; ?>">
                <label class="label">Restos Link</label>
            </div>

            <div class="input-image-container">
                <label for="restosImage" class="label">
                <button id="fileButton" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125" stroke="#fffffff" stroke-width="2"></path>
                    <path d="M17 15V18M17 21V18M17 18H14M17 18H20" stroke="#fffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Add Image
                </button>
            </label>
            <input class="input form-control" type="file" id="restosImage" name="restos_img" accept="image/jpeg, image/jpg, image/png">
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
    const restosName = document.getElementById('restosName').value.trim();
    const restosDescription = document.getElementById('restosDescription').value.trim();
    const restosDate = document.getElementById('restosDate').value.trim();
    const restosTime = document.getElementById('restosTime').value.trim();
    const restosImage = document.getElementById('restosImage').value;

    // Validate image format
    if (restosImage) {
        const fileName = restosImage.trim().toLowerCase();
        const validImageExtensions = ['jpg', 'jpeg', 'png'];
        const imageExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        if (!validImageExtensions.includes(imageExtension)) {
            displayError('Please upload a valid image (jpg, jpeg, or png).');
            return false;
        }
    }

    // Validate other fields not empty
    if (restosName === '' || restosDescription === '' || restosDate === '' || restosTime === '') {
        displayError('Please input all fields.');
        return false;
    }

    return true;
}

// Function to go back
function goBack() {
    window.location.href = 'admin-restos.php';
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
