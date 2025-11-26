<?php
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$post_id = $_GET['post_id'];

if (isset($_POST['comment'])) {
    $comment = $_POST['comment_text'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO comments (post_id, user_id, comment) 
              VALUES ('$post_id', '$user_id', '$comment')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comments</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<a href="feed.php">⬅ Back to Feed</a>

<h2>Comments</h2>

<?php
$query = "SELECT comments.*, users.username 
          FROM comments JOIN users ON comments.user_id = users.id 
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

<div class="container">
    <form method="POST">
        <textarea name="comment_text" placeholder="Write a comment..." required></textarea><br>
        <button name="comment">Comment</button>
    </form>
</div>

</body>
</html>
