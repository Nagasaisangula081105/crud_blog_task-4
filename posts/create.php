
<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $content = mysqli_real_escape_string($conn, trim($_POST['content']));

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

    if (mysqli_query($conn, $sql)) {
        header("Location: read.php");
        exit();
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Create Post | CRUD Blog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet" href="../style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand fw-bold fs-3" href="../dashboard.php">

<i class="fas fa-blog"></i>

CRUD BLOG

</a>

<div>

<a href="../dashboard.php" class="btn btn-primary me-2">

<i class="fas fa-house"></i>

Dashboard

</a>

<a href="../auth/logout.php" class="btn btn-danger">

<i class="fas fa-right-from-bracket"></i>

Logout

</a>

</div>

</div>

</nav>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow-lg">

<div class="card-header text-center">

<h2>

<i class="fas fa-pen-to-square"></i>

Create New Blog Post

</h2>

<p class="mb-0">

Share your thoughts with everyone.

</p>

</div>

<div class="card-body p-4">

<form method="POST">
    <div class="mb-4">

<label class="form-label fw-bold">
<i class="fas fa-heading text-primary"></i>
Post Title
</label>

<input
type="text"
name="title"
class="form-control form-control-lg"
placeholder="Enter your blog title..."
required>

</div>

<div class="mb-4">

<label class="form-label fw-bold">
<i class="fas fa-file-lines text-success"></i>
Post Content
</label>

<textarea
name="content"
class="form-control"
rows="8"
placeholder="Write your blog content here..."
required></textarea>

</div>

<div class="row mt-4">

<div class="col-md-4 mb-3">

<button
type="submit"
name="submit"
class="btn btn-success btn-lg w-100">

<i class="fas fa-paper-plane"></i>

Publish

</button>

</div>

<div class="col-md-4 mb-3">

<a href="read.php"
class="btn btn-primary btn-lg w-100">

<i class="fas fa-book-open"></i>

View Posts

</a>

</div>

<div class="col-md-4 mb-3">

<a href="../dashboard.php"
class="btn btn-dark btn-lg w-100">

<i class="fas fa-house"></i>

Dashboard

</a>

</div>

</div>
</form>

</div>

</div>

</div>

</div>

</div>

<footer class="mt-5 py-4 text-center text-white">

<div class="container">

<h5 class="fw-bold">
<i class="fas fa-blog"></i>
CRUD BLOG
</h5>

<p class="mb-2">
Create and manage your blog posts with ease.
</p>

<div class="mb-3">

<a href="../dashboard.php" class="btn btn-primary me-2">
<i class="fas fa-house"></i> Dashboard
</a>

<a href="read.php" class="btn btn-success me-2">
<i class="fas fa-book-open"></i> View Posts
</a>

<a href="../auth/logout.php" class="btn btn-danger">
<i class="fas fa-right-from-bracket"></i> Logout
</a>

</div>

<p class="mb-0">
© 2026 CRUD Blog | Developed by <strong>Nagasai</strong>
</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>