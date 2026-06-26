<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn, "UPDATE posts SET title='$title', content='$content' WHERE id=$id");
    header("Location: read.php");
}

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Blog | Update Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg p-4">

<h2 class="text-center text-warning mb-4">✏️ Update Post</h2>

<form method="POST">

<div class="mb-3">
<label class="form-label">Title</label>
<input type="text" name="title" class="form-control"
value="<?php echo $row['title']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Content</label>
<textarea name="content" class="form-control" rows="5" required><?php echo $row['content']; ?></textarea>
</div>

<button type="submit" name="update" class="btn btn-warning w-100">
Update Post
</button>

</form>

<br>

<a href="read.php" class="btn btn-secondary w-100">
⬅ Back to Posts
</a>

</div>

</div>

</body>
</html>