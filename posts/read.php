<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

$countQuery = "SELECT COUNT(*) AS total
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'";

$countResult = mysqli_query($conn, $countQuery);

$totalPosts = mysqli_fetch_assoc($countResult)['total'];

$totalPages = ceil($totalPosts / $limit);

$sql = "SELECT *
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error : " . mysqli_error($conn));
}
?><!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CRUD Blog | View Posts</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet" href="../style.css">

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand fw-bold fs-3" href="../dashboard.php">

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

<a href="../dashboard.php"
class="btn btn-primary me-2">

<i class="fas fa-home"></i>

Dashboard

</a>

</li>

<li class="nav-item">

<a href="../auth/logout.php"
class="btn btn-danger">

<i class="fas fa-right-from-bracket"></i>

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container mt-5">

<div class="card p-4">

<h2 class="text-center mb-4">

<i class="fas fa-book-open"></i>

View Blog Posts

</h2>

<form method="GET">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="search"
class="form-control"

placeholder="Search by title or content..."

value="<?php echo htmlspecialchars($search); ?>">

</div>

<div class="col-md-2">

<button
class="btn btn-success w-100">

<i class="fas fa-search"></i>

Search

</button>

</div>

</div>

</form>

<hr>

<div class="table-responsive">
    <table class="table table-hover align-middle text-center">

    <thead class="table-dark">

        <tr>

            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td class="fw-bold">
<?php echo htmlspecialchars($row['title']); ?>
</td>

<td style="max-width:300px;">
<?php echo htmlspecialchars(substr($row['content'],0,100)); ?>
</td>

<td>

<div class="d-flex justify-content-center gap-2 flex-wrap">

<a href="update.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-pen"></i>

Edit

</a>

<?php if(isset($_SESSION['role']) && $_SESSION['role']=="admin"){ ?>

<a href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this post?')">

<i class="fas fa-trash"></i>

Delete

</a>

<?php } ?>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- Pagination -->

<nav class="mt-4">

<ul class="pagination justify-content-center">

<?php if($page>1){ ?>

<li class="page-item">

<a class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page-1; ?>">

<i class="fas fa-angle-left"></i>

</a>

</li>

<?php } ?>

<?php for($i=1;$i<=$totalPages;$i++){ ?>

<li class="page-item <?php echo ($i==$page)?'active':''; ?>">

<a class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

</li>

<?php } ?>

<?php if($page<$totalPages){ ?>

<li class="page-item">

<a class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page+1; ?>">

<i class="fas fa-angle-right"></i>

</a>

</li>

<?php } ?>

</ul>

</nav>
<div class="d-flex justify-content-between flex-wrap gap-3 mt-4">

    <a href="read.php" class="btn btn-secondary">
        <i class="fas fa-rotate"></i>
        Clear Search
    </a>

    <a href="../dashboard.php" class="btn btn-primary">
        <i class="fas fa-house"></i>
        Back to Dashboard
    </a>

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
Professional Blog Management System
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

<p class="mb-0">
© 2026 CRUD Blog | Developed by <strong>Nagasai</strong>
</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>