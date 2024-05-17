<?php
session_start();
include '../../connect/connect.php';

// Check for database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Redirect to login page if user is not authenticated
// if (!isset($_SESSION['admin_user'])) {
//     header("Location: ../../login/login.php");
//     exit;
// }

// Handle form submission
if (isset($_POST['submit']) && isset($_POST['restos_name'])) {
    $upload_image = '';

    // Get form data
    $restos_img = $_FILES['restos_img'] ?? null;
    $restos_name = $_POST['restos_name'];
    $restos_desc = $_POST['restos_desc'];
    $restos_oprtn = $_POST['restos_oprtn'];
    $restos_link = $_POST['restos_link'];

    // Debugging: Check if form data is received
    var_dump($restos_name, $restos_desc, $restos_oprtn, $restos_link, $restos_img);

    // Handle image upload
    if ($restos_img && $restos_img['error'] === UPLOAD_ERR_OK) {
        $restos_imagefilename = $restos_img['name'];
        $restos_imagefiletemp = $restos_img['tmp_name'];

        $restos_filename_separate = explode('.', $restos_imagefilename);
        $file_extension = strtolower(end($restos_filename_separate));
        $allowed_extensions = ['jpeg', 'jpg', 'png'];

        if (in_array($file_extension, $allowed_extensions)) {
            $upload_image = 'images/' . $restos_imagefilename;
            move_uploaded_file($restos_imagefiletemp, $upload_image);
        }
    }

    // Prepare and execute the SQL query
    if ($upload_image && $restos_name && $restos_desc && $restos_oprtn && $restos_link) {
        // Prepare the SQL statement to avoid SQL injection
        $stmt = $con->prepare("INSERT INTO `restos` (restos_name, restos_desc, restos_oprtn, restos_link, restos_img)
                               VALUES (?, ?, ?, ?, ?)");

        // Bind the user inputs to the prepared statement
        $stmt->bind_param("sssss", $restos_name, $restos_desc, $restos_oprtn, $restos_link, $upload_image);

        // Execute the prepared statement
        $result = $stmt->execute();

        // Handle the result
        if ($result) {
            header("Location: admin-restos.php");
            exit();
        } else {
            // Log the error or display it for debugging
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restos Creation</title>
  <link rel="icon" type="image/x-icon" href="../../assets/images/SK-Icon.png">
  <link rel="stylesheet" href="../../css/addnews.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" href="../../assets/images/SK-Logo1.png">
</head>
<body>
<div>
    <?php include "admin-header.php" ?>
</div>
<div class="main-content-container">
    <div class="event-form-container">
        <div class="event-input-container">
            <h1 class="form-header">Add Restos</h1>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="input-container">
                        <input type="text" class="input form-control" id="restosname" name="restos_name" required>
                        <label class="label">Restos Name</label>
                    </div>
                    <div class="input-container">
                        <textarea class="input form-control" id="restosdesc" rows="3" name="restos_desc" required></textarea>
                        <label class="label">Restos Description</label>
                    </div>
                    <div class="input-container">
                        <input class="input form-control" type="time" id="restosoprtn" name="restos_oprtn" required />
                        <label class="label">Restos Operation</label>
                    </div>
                    <div class="input-container">
                        <input class="input form-control" type="text" id="restoslink" name="restos_link" required />
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
                    <input class="input form-control" type="file" id="restosimg" name="restos_img" accept="image/jpeg, image/jpg, image/png" required>
                    </div>

                    <div class="buttons-container">
                        <input type="submit" class="btn btn-success" name="submit" value="Submit">
                        <button type="button" class="btn btn-danger" name="cancel" onclick="goBack()">Cancel</button>
                    </div>
                </form>
            </div>
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
<script>
function validateForm(event) {
    var restosname = document.getElementById('restosname').value;
    var restosdesc = document.getElementById('restosdesc').value;
    var restosoprtn = document.getElementById('restosoprtn').value;
    var restoslink = document.getElementById('restoslink').value;
    var imageInput = document.getElementById('restosimg');
    var imageFile = imageInput.files[0];

    if (
        restosname.trim() === '' ||
        restosdesc.trim() === '' ||
        restosoprtn.trim() === '' ||
        restoslink.trim() === '' ||
        !imageFile
    ) {
        displayError('Please input all fields');
        return false;
    }

    // Validate image format
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(imageFile.name)) {
        displayError('Please upload an image with .jpg, .jpeg, or .png extension.');
        return false;
    }

    // If all validations pass, submit the form
    return true;
}

function displayError(message) {
    var errorMessage = document.getElementById('errorMessage');
    errorMessage.textContent = message;
    var popup = document.getElementById('errorPopup');
    popup.style.display = 'block';
}

function closePopup() {
    var popup = document.getElementById('errorPopup');
    popup.style.display = 'none';
}

function goBack() {
    window.location.href = 'admin-restos.php';
}
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>
</html>
