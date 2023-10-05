<?php
include("header.php");
include("db.php");

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $sql = "SELECT * FROM blog_posts WHERE post_id = $post_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        echo "Post not found.";
        exit();
    }
} else {
    echo "Post ID not provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'];

    $updateSql = "UPDATE blog_posts SET content = '$newContent' WHERE post_id = $post_id";
    if (mysqli_query($conn, $updateSql)) {
        echo "Post updated successfully.";
    } else {
        echo "Error updating post: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <style>
form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

#content {
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 10px;
    font-size: 16px;
    min-height: 200px;
    margin-bottom: 15px;
}

input[type="submit"] {
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}

</style></head>
<body>
    <div class="container" style="margin-top:10%">
    <h2 style="text-align:center">Create Blog Post</h1>

<form action="create_post.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="content">Content:</label>
    <div id="content"></div>

    <input type="submit" value="Create Post">
</form>
    <a href="blog.php">Back to Profile</a>
</body>
</html>
