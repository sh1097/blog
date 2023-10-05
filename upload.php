<?php
include("header.php");
?><?php

use frontend\components\QueryHelper;
// Define your Unsplash API access key
$curl = curl_init();


$accessKey = 'YOUR_ACCESS_KEY';

// Set the query parameters (e.g., search for "nature")
$query = 'nature';
$url = "https://api.unsplash.com/photos/random?query=$query&client_id=$accessKey";

// Send a GET request to the Unsplash API
$response = file_get_contents($url);

// Check if the request was successful
if ($response !== false) {
    // Parse the JSON response
    $data = json_decode($response, true);
    
    // Retrieve the image URL
    $image_url = $data['urls']['regular'];
    
    // Send a GET request to download the image
    $image_response = file_get_contents($image_url);

    // Check if the image request was successful
    if ($image_response !== false) {
        // Save the image to a file
        file_put_contents('downloaded_image.jpg', $image_response);
        echo 'Image downloaded successfully.';
    } else {
        echo 'Failed to download the image.';
    }
} else {
    echo 'Failed to retrieve data from the Unsplash API.';
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
 
    $targetDirectory = "uploads/";
    $originalFileName = basename($_FILES["profileImage"]["name"]);
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $newFileName = $username . "_" . time() . "." . $fileExtension;
    $targetFile = $targetDirectory . $newFileName;
    // print_r($targetFile);die;
    $uploadOk = 1;
    
    // Check if image file is a valid image
    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check file size (adjust as needed)
    if ($_FILES["profileImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats (you can customize this list)
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $fileExtension = strtolower($fileExtension);
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile) && $username && $password) {
            // $param[':']=$merchant_id;
            $param[':username']=$username;
            $param[':password']=$password;
            $param[':image_file']=$originalFileName;
            $param[':image_path']=$targetFile;
        $sql=" INSERT INTO `Customer` (`CustomerId`, `password`, `Image_file`, `Image_name`) VALUES (:username, :password, :image_file, :image_path)";
        $query_exec = QueryHelper::sqlRecords($sql, $param, 'insert');
        // echo "Data inserted into `Customer` table: " . $query_exec;
        $url='https://localhost/training/advanced/frontend/web/bestbuyca/user/view';
        echo "<script>
        $.ajax({
            method: 'post',
            url:".$url.",
            data: {postData: ".$query_exec."},
            dataType:'json'
        })
            .done(function (msg) {
               
            });
         </script>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
