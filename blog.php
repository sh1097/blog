<?php
session_start();
include("db.php"); // Include your database configuration
// print_r($_SESSION['user_id']);die;
// Get the user ID from the URL parameter (e.g., profile.php?user_id=1)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query the database to get user information
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Style the container */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    border-radius: 5px;
}

/* Style headings */
h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

h2 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Style user information */
p {
    font-size: 16px;
    margin-bottom: 10px;
}

/* Style user's posts */
.container h3 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.container p {
    font-size: 16px;
    margin-bottom: 10px;
}

.container a {
    text-decoration: none;
    background-color: #333;
    color: #fff;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 14px;
    margin-right: 10px;
}

.container a:hover {
    background-color: #555;
}

/* Style delete confirmation links */
.delete-link {
    background-color: #ff3333; /* Red color for delete links */
}

    </style>
</head>
<body>
    <h1>User Profile</h1>
    
    <h2><?php echo $user['username']; ?></h2>
    <p>Email: <?php echo $user['email']; ?></p>

    <h2>Posts by <?php echo $user['username']; ?></h2>
    
    <?php
    $posts_sql = "SELECT * FROM blog_posts WHERE user_id = $user_id";
    $posts_result = mysqli_query($conn, $posts_sql);

    if ($posts_result && mysqli_num_rows($posts_result) > 0) {
        while ($post = mysqli_fetch_assoc($posts_result)) {
            echo "<div class='container'>";
            echo "<h3>{$post['title']}</h3>";
            echo "<p>{$post['content']}</p>";
            echo "<a href='edit_post.php?post_id={$post['post_id']}'>Edit</a>";

            echo "<a href='delete_post.php?post_id={$post['post_id']}' class='delete-link'>Delete</a>";
        
            echo "</div>";
        }
    } else {
        echo "<p>No posts found for this user.</p>";
    }
    ?>


</body>
</html>
<script>

document.addEventListener("DOMContentLoaded", function () {
    const deleteLinks = document.querySelectorAll(".delete-link");

    deleteLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const postId = <?php $post['post_id']?>;
            const confirmation = confirm("Are you sure you want to delete this post?");

            if (confirmation) {
                confirmDelete(postId); 
            }
        });
    });
});
    function confirmDelete(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            window.location.href = 'delete_post.php?post_id=' + postId;
        }
    }
</script>
