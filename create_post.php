<?php
include "config.php";

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle post submission
if (isset($_POST['post'])) {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image = "";

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $query = "INSERT INTO posts (user_id, content, image) VALUES ('$user_id', '$content', '$image')";
    mysqli_query($conn, $query);

    header("Location: feed.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<!-- NAVBAR (correct location) -->
<div class="navbar">
    <h3>Welcome, <?= $_SESSION['username'] ?> </h3>
    <div>
        <a href="feed.php">Home</a>
        <a href="create_post.php">Create Post</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- PAGE CONTENT -->
<div class="container">
    <h2>Create a Post</h2>

    <form method="POST" enctype="multipart/form-data">
        <textarea name="content" placeholder="Write something..." required></textarea><br>
        
        <label style="font-size:14px; font-weight:500; color:#555;">Choose an image (optional):</label><br>
        <input type="file" name="image"><br><br>

        <button name="post">Post</button>
    </form>
</div>

</body>
</html>
