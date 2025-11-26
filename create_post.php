<?php
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_POST['post'])) {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image = "";

    if ($_FILES['image']['name']) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $query = "INSERT INTO posts (user_id, content, image) VALUES ('$user_id', '$content', '$image')";
    mysqli_query($conn, $query);

    header("Location: feed.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<div class="container">
    <h2>Create a Post</h2>

    <form method="POST" enctype="multipart/form-data">
        <textarea name="content" placeholder="Write something..." required></textarea><br>
        <input type="file" name="image"><br>
        <button name="post">Post</button>
    </form>

</div>

</body>
</html>
