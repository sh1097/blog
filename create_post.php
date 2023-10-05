<?php
session_start();
include("header.php");

include("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    if (empty($title) || empty($content)) {

        echo "Both title and content are required.";
        exit();
    }

    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
    $sql = "INSERT INTO blog_posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";

    if (mysqli_query($conn, $sql)) {

        header("Location: blog.php");
        exit();
 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
  
}