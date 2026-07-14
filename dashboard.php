<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>CRUD Blog | Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand fw-bold fs-3" href="dashboard.php">

<i class="fas fa-blog"></i>

CRUD BLOG

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbar">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="navbar">

<ul class="navbar-nav ms-auto align-items-center">

<li class="nav-item me-3">

<span class="badge bg-light text-dark fs-6 p-2">

<i class="fas fa-user-circle"></i>

<?php echo htmlspecialchars($_SESSION['username']); ?>

</span>

</li>

<li class="nav-item">

<a href="auth/logout.php"
class="btn btn-danger">

<i class="fas fa-sign-out-alt"></i>

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<!-- Main Container -->

<div class="container-fluid mt-4">

<div class="row">
    <!-- Sidebar -->

<div class="col-lg-3 col-md-4 mb-4">

    <div class="card p-4 shadow-lg">

        <div class="text-center mb-4">

            <i class="fas fa-user-circle fa-5x mb-3 text-info"></i>

            <h4><?php echo htmlspecialchars($_SESSION['username']); ?></h4>

            <p class="text-light">Welcome to your dashboard</p>

        </div>

        <div class="d-grid gap-3">

            <a href="dashboard.php" class="btn btn-warning">
                <i class="fas fa-house"></i> Dashboard
            </a>

            <a href="posts/create.php" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Create New Post
            </a>

            <a href="posts/read.php" class="btn btn-success">
                <i class="fas fa-book-open"></i> View All Posts
            </a>

            <a href="auth/logout.php" class="btn btn-danger">
                <i class="fas fa-right-from-bracket"></i> Logout
            </a>

        </div>

    </div>

</div>

<!-- Main Dashboard -->

<div class="col-lg-9 col-md-8">

    <div class="card p-5 shadow-lg">

        <h1 class="mb-3">
            👋 Welcome,
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </h1>

        <p class="mb-5">
            Manage your blog posts quickly using the options below.
        </p>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="dashboard-box text-center">

                    <i class="fas fa-pen fa-3x mb-3"></i>

                    <h4>Create Post</h4>

                    <p>Add a new blog article.</p>

                    <a href="posts/create.php"
                       class="btn btn-primary w-100">
                        Create
                    </a>

                </div>
                </div>

    </div>

</div>

</div>

</div>

<footer class="mt-5 py-4 text-center">

    <div class="container">

        <h5 class="mb-2">
            <i class="fas fa-blog"></i> CRUD BLOG
        </h5>

        <p class="mb-2">
            A Modern Blog Management System
        </p>

        <div class="mb-3">

            <a href="#" class="text-white me-3">
                <i class="fab fa-github fa-lg"></i>
            </a>

            <a href="#" class="text-white me-3">
                <i class="fab fa-linkedin fa-lg"></i>
            </a>

            <a href="#" class="text-white">
                <i class="fas fa-envelope fa-lg"></i>
            </a>

        </div>

        <small>
            © 2026 CRUD Blog | Developed by <strong>Nagasai</strong>
        </small>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>