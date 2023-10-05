<?php

include("db.php");

// Start a session
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Blog Post</title>
   
<script src="https://cdn.tiny.cloud/1/vevg942zc9texn5cc010j4kz8et2pp246sjurx8lkf07h4t8/tinymce/5/tinymce.min.js"></script>

<script>
    function initializeRichTextEditor() {
        tinymce.init({
            selector: '#content', 
            plugins: 'autolink lists link image',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image',
        });
    }

    document.addEventListener("DOMContentLoaded", initializeRichTextEditor);
</script>
<style>
    /* Style the form container */
form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

/* Style labels */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Style text input */
input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

/* Style the content area (rich text editor) */
#content {
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 10px;
    font-size: 16px;
    min-height: 200px;
    margin-bottom: 15px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
}

/* Style the submit button on hover */
input[type="submit"]:hover {
    background-color: #555;
}

</style>
</head>
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
</div></body>
</html>







