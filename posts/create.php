<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['username'])){
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts(title, content) VALUES('$title','$content')";

    if(mysqli_query($conn, $sql)){
        echo "Post Added Successfully!";
    } else {
        echo "Error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Blog | Create Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg p-4">

<h2 class="text-center text-success mb-4">➕ Create New Post</h2>

<form method="POST">

<div class="mb-3">
<label class="form-label">Title</label>
<input type="text" name="title" class="form-control" placeholder="Enter Post Title" required>
</div>

<div class="mb-3">
<label class="form-label">Content</label>
<textarea name="content" class="form-control" rows="5" placeholder="Write your post here..." required></textarea>
</div>

<button type="submit" name="submit" class="btn btn-success w-100">
Add Post
</button>

</form>

<br>

<a href="../dashboard.php" class="btn btn-secondary w-100">
⬅ Back to Dashboard
</a>

</div>

</div>

</body>
</html>