<?php
include "config.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = $_GET['post_id'];

// Handle comment submission
if (isset($_POST['comment'])) {
    $comment = $_POST['comment_text'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO comments (post_id, user_id, comment) 
              VALUES ('$post_id', '$user_id', '$comment')";
    mysqli_query($conn, $query);

    header("Location: comments.php?post_id=$post_id");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comments</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h3>Welcome, <?= $_SESSION['username'] ?> </h3>
    <div>
        <a href="feed.php">Home</a>
        <a href="create_post.php">Create Post</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- PAGE CONTENT -->
<div class="container" style="max-width:800px; margin-top:30px;">
    
    <a class="back-link" href="feed.php">⬅ Back to Feed</a>
    <h2>Comments</h2>

    <?php
    $query = "SELECT comments.*, users.username 
              FROM comments 
              JOIN users ON comments.user_id = users.id 
              WHERE post_id = '$post_id'
              ORDER BY comments.created_at DESC";
    $result = mysqli_query($conn, $query);

    while ($c = mysqli_fetch_assoc($result)) {
        echo "<div class='comment'>
                <strong>".$c['username']."</strong>
                <p>".$c['comment']."</p>
              </div>";
    }
    ?>

    <!-- Add Comment Box -->
    <form method="POST" style="margin-top:20px;">
        <textarea name="comment_text" placeholder="Write a comment..." required></textarea><br>
        <button name="comment">Comment</button>
    </form>

</div>

</body>
</html>
