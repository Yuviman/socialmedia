<?php
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feed</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<div class="navbar">
    <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>
    <a href="create_post.php">Create Post</a>
    <a href="logout.php">Logout</a>
</div>

<h2>Feed</h2>

<?php
$query = "SELECT posts.*, users.username 
          FROM posts JOIN users ON posts.user_id = users.id 
          ORDER BY posts.created_at DESC";
$result = mysqli_query($conn, $query);

while ($post = mysqli_fetch_assoc($result)) {
    echo "<div class='post'>
            <h4>".$post['username']."</h4>
            <p>".$post['content']."</p>";

    if ($post['image']) {
        echo "<img src='uploads/".$post['image']."' class='post-img'>";
    }

    echo "<p><a href='comments.php?post_id=".$post['id']."'>View Comments</a></p>";
    echo "</div>";
}
?>

</body>
</html>
