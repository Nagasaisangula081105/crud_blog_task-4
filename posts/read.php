<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;

$countQuery = "SELECT COUNT(*) AS total
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'";

$countResult = mysqli_query($conn,$countQuery);
$totalPosts = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalPosts/$limit);

$sql = "SELECT *
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>CRUD Blog | View Posts</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:linear-gradient(135deg,#4f46e5,#06b6d4);
min-height:100vh;
}

.main-card{
border:none;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.2);
}

.table{
border-radius:12px;
overflow:hidden;
}

.btn{
border-radius:30px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">

<a class="navbar-brand fw-bold" href="../dashboard.php">
📝 CRUD Blog
</a>

<div>

<span class="text-white me-3">
Welcome,
<b><?php echo $_SESSION['username']; ?></b>
</span>

<a href="../dashboard.php"
class="btn btn-light btn-sm">
Dashboard
</a>

</div>

</div>

</nav>

<div class="container mt-5">

<div class="card main-card p-4">

<h2 class="text-center text-primary fw-bold mb-4">
📚 Blog Posts
</h2>

<form method="GET" class="row g-2 mb-4">

<div class="col-md-10">

<input
type="text"
name="search"
class="form-control"
placeholder="Search posts..."
value="<?php echo htmlspecialchars($search); ?>">

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">
🔍 Search
</button>

</div>

</form>

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle text-center">

<thead class="table-primary">

<tr>

<th>ID</th>

<th>Title</th>

<th>Content</th>

<th width="200">Actions</th>

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

<td>
<?php echo htmlspecialchars($row['content']); ?>
</td>

<td>

<a href="update.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-warning btn-sm">
✏️ Edit
</a>

<?php if($_SESSION['role'] == "admin"){ ?>

<a href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this post?');">
🗑️ Delete
</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
<nav class="mt-4">

<ul class="pagination justify-content-center">

<?php if($page > 1){ ?>

<li class="page-item">

<a class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page-1; ?>">

⬅ Previous

</a>

</li>

<?php } ?>

<?php for($i=1; $i<=$totalPages; $i++){ ?>

<li class="page-item <?php echo ($i==$page)?'active':''; ?>">

<a class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

</li>

<?php } ?>

<?php if($page < $totalPages){ ?>

<li class="page-item">

<a class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page+1; ?>">

Next ➡

</a>

</li>

<?php } ?>

</ul>

</nav>

<div class="d-flex justify-content-between mt-4">

<a href="read.php"
class="btn btn-outline-secondary">
🔄 Clear Search
</a>

<a href="../dashboard.php"
class="btn btn-dark">
🏠 Back to Dashboard
</a>

</div>

</div>

</div>

<footer class="text-center text-white mt-5 mb-3">
<p>© 2026 CRUD Blog Application | Made with ❤️ using PHP & Bootstrap</p>
</footer>

</body>
</html>