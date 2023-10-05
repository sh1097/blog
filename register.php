<?php include("db.php");
include("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $uploadDir = "profile_pictures/";
        $uploadFile = $uploadDir . basename($_FILES["profile_picture"]["name"]);
        // Check if the file is an image (you may want to enhance this check)
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        if ($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg") {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadFile)) {

                // Save the file path or unique identifier in the database
                $profilePicturePath = $uploadFile;
                // Update the user's profile with the new picture path
                // ...
            } else {
                echo "File upload failed.";
            }
        } else {
            echo "Invalid file format. Only JPG, JPEG, and PNG files are allowed.";
        }
    }
    $sql = "INSERT INTO users (username, email, password,profile_picture) VALUES ('$username', '$email', '$password','$profilePicturePath')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}