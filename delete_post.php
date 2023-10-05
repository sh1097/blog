<?php
include("db.php");
include("header.php");

$postId = $_GET['post_id'];

$sql = "DELETE FROM blog_posts WHERE post_id = $postId";
if (mysqli_query($conn, $sql)) {
    echo "Post deleted successfully.";
    header("Location: blog.php");

} else {
    echo "Error deleting post: " . mysqli_error($conn);
}

?>
