<?php
include("db.php");
include("header.php");

session_start();

$user_id = $_SESSION['user_id']; 

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    $updateSql = "UPDATE users SET username = '$newUsername', email = '$newEmail' WHERE user_id = $user_id";
    if (mysqli_query($conn, $updateSql)) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        /* Style the form container */
form {
    max-width: 400px;
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

/* Style input fields */
input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
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
    <h1>Edit Profile</h1>
    
    <form method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
        
        <input type="submit" value="Update">
    </form>
    
    <a href="profile.php">Back to Profile</a>
</body>
</html>
