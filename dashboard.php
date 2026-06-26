<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<footer class="text-center mt-5 mb-3">

<p class="text-dark">

© 2026 CRUD Blog Application

</p>

</footer>
<body  style="background:linear-gradient(to right,#74ebd5,#ACB6E5);">
    <nav class="navbar navbar-dark bg-dark shadow">
<div class="container">
<a class="navbar-brand fw-bold" href="#">📝 CRUD Blog</a>

<span class="text-white">
Welcome,
<b><?php echo $_SESSION['username']; ?></b>
</span>

</div>
</nav>

<div class="container mt-5">

<div class="card shadow-lg border-0 rounded-4 p-5">

<h2 class="text-center text-primary mb-4">
Welcome, <?php echo $_SESSION['username']; ?> 👋
</h2>

<p class="text-center text-muted">
manage your CRUD Blogs easily.
</p>

<div class="d-grid gap-3 mt-4">

<a href="posts/create.php" class="btn btn-success btn-lg">
📝 Create New Post
</a>

<a href="posts/read.php" class="btn btn-primary btn-lg">
📚 View All Posts
</a>

<a href="auth/logout.php" class="btn btn-danger btn-lg">
🔒 Logout
</a>

</div>

</div>

</div>

</body>
</html>