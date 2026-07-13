<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['username'])){
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_POST['submit'])){

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = mysqli_prepare($conn, "INSERT INTO posts (title, content) VALUES (?, ?)");

    mysqli_stmt_bind_param($stmt, "ss", $title, $content);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: read.php");
        exit();
    }else{
        echo "<script>alert('Error while adding post!');</script>";
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Create Post | CRUD Blog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#0d6efd,#6f42c1);
    min-height:100vh;
}

.card{
    border:none;
    border-radius:20px;
}

.form-control{
    border-radius:12px;
}

textarea{
    resize:none;
}

.btn{
    border-radius:12px;
}
</style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card shadow-lg">

<div class="card-header bg-success text-white text-center p-4">

<h2>📝 Create New Blog Post</h2>

<p class="mb-0">Write and publish your post</p>

</div>

<div class="card-body p-4">

<form method="POST">

<div class="mb-3">

<label class="form-label fw-bold">
Post Title
</label>

<input
type="text"
name="title"
class="form-control"
placeholder="Enter your post title"
required>

</div>

<div class="mb-4">

<label class="form-label fw-bold">
Post Content
</label>

<textarea
name="content"
class="form-control"
rows="7"
placeholder="Write your content here..."
required></textarea>

</div>

<div class="d-grid gap-2">

<button type="submit" name="submit" class="btn btn-success btn-lg">
➕ Publish Post
</button>

<a href="read.php" class="btn btn-primary">
📄 View All Posts
</a>

<a href="../dashboard.php" class="btn btn-dark">
🏠 Back to Dashboard
</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>