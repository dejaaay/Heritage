<?php
session_start();
include '../../connect/connect.php';

// Check for database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// login first
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: ../login/admin-login.php");
    exit();
}

// Redirect to login page if user is not authenticated
// if (!isset($_SESSION['admin_user'])) {
//     header("Location: ../../login/login.php");
//     exit;
// }

// Handle form submission
if (isset($_POST['submit']) && isset($_POST['news_name'])) {
    $upload_image = '';

    // Get form data
    $news_img = $_FILES['news_img'] ?? null;
    $news_name = $_POST['news_name'];
    $news_desc = $_POST['news_desc'];
    $news_date = $_POST['news_date'];
    $news_time = $_POST['news_time'];

    // Debugging: Check if form data is received
    var_dump($news_name, $news_desc, $news_date, $news_time, $news_img);

    // Handle image upload
    if ($news_img && $news_img['error'] === UPLOAD_ERR_OK) {
        $news_imagefilename = $news_img['name'];
        $news_imagefiletemp = $news_img['tmp_name'];

        $news_filename_separate = explode('.', $news_imagefilename);
        $file_extension = strtolower(end($news_filename_separate));
        $allowed_extensions = ['jpeg', 'jpg', 'png'];

        if (in_array($file_extension, $allowed_extensions)) {
            $upload_image = 'images/' . $news_imagefilename;
            move_uploaded_file($news_imagefiletemp, $upload_image);
        }
    }

    // Prepare and execute the SQL query
    if ($upload_image && $news_name && $news_desc && $news_date && $news_time) {
        // Prepare the SQL statement to avoid SQL injection
        $stmt = $con->prepare("INSERT INTO `news` (news_name, news_desc, news_date, news_time, news_img)
                               VALUES (?, ?, ?, ?, ?)");

        // Bind the user inputs to the prepared statement
        $stmt->bind_param("sssss", $news_name, $news_desc, $news_date, $news_time, $upload_image);

        // Execute the prepared statement
        $result = $stmt->execute();

        // Handle the result
        if ($result) {
            header("Location: admin-news.php");
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

<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>News Creation</title>
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
            <h1 class="form-header">Add News</h1>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="input-container">
                        <input type="text" class="input form-control" id="newsname" name="news_name">
                        <label class="label">News Name</label>
                    </div>
                    <div class="input-container">
                        <textarea class="input form-control" id="newsdesc" rows="3" name="news_desc"></textarea>
                        <label class="label">News Description</label>
                    </div>
                    <div class="input-container">
                        <input class="input form-control" type="date" id="newsdate" name="news_date"  />
                        <label class="label">News Date</label>
                    </div>
                    <div class="input-container">
                        <input class="input form-control" type="time" id="newstime" name="news_time"  />
                        <label class="label">News Time</label>
                    </div>

                    <div class="input-image-container">
                        <label for="newsImage" class="label">
                        <button id="fileButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H11M13.5 3L19 8.625M13.5 3V7.625C13.5 8.17728 13.9477 8.625 14.5 8.625H19M19 8.625V11.8125" stroke="#fffffff" stroke-width="2"></path>
                            <path d="M17 15V18M17 21V18M17 18H14M17 18H20" stroke="#fffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Add Image
                        </button>
                    </label>
                    <input class="input form-control" type="file" id="newsimg" name="news_img" accept="image/jpeg, image/jpg, image/png">
                    </div>

                    <div class="buttons-container">
                        <input type="submit" class="btn btn-success" name="submit"></input>
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
    var newsname = document.getElementById('newsname').value;
    var newsdesc = document.getElementById('newsdesc').value;
    var newsdate = document.getElementById('newsdate').value;
    var newstime = document.getElementById('newstime').value;
    var imageInput = document.getElementById('news_img');
    var imageFile = imageInput.files[0];

    if (
        newsname.trim() === '' ||
        newsdesc.trim() === '' ||
        newsdate.trim() === '' ||
        newstime.trim() === '' ||
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

    // Validate date format
    const datePattern = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD format
    if (!datePattern.test(newsdate)) {
        displayError('News date must be in the format YYYY-MM-DD.');
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
    window.location.href = 'admin-news.php';
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
