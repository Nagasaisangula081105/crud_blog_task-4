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

// Search
// Number of posts per page
$limit = 5;

// Current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Offset
$offset = ($page - 1) * $limit;

// Total Posts
$countQuery = "SELECT COUNT(*) AS total FROM posts
               WHERE title LIKE '%$search%'
               OR content LIKE '%$search%'";

$countResult = mysqli_query($conn, $countQuery);
$totalPosts = mysqli_fetch_assoc($countResult)['total'];

$totalPages = ceil($totalPosts / $limit);

// Fetch Posts
$sql = "SELECT * FROM posts
        WHERE title LIKE '%$search%'
        OR content LIKE '%$search%'
        LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Blog | View Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../dashboard.php">
            📝 CRUD Blog
        </a>

        <a href="../dashboard.php" class="btn btn-light btn-sm">
            Dashboard
        </a>
    </div>
</nav>
<div class="container mt-5">

    <div class="card shadow-lg p-4">

        <h2 class="text-center text-primary mb-4">📄 All Posts</h2>
<div class="card shadow-sm p-3 mb-4">
        <!-- Search Form -->
        <form method="GET" class="row mb-4">

            <div class="col-md-10">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by Title or Content"
                    value="<?php echo $search; ?>">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    🔍 Search
                </button>
            </div>

        </form>
</div>
<div class="table-responsive">

<table class="table table-bordered table-hover table-striped align-middle">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th width="180">Action</th>
        </tr>
    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <tr>

        <td><?php echo $row['id']; ?></td>

        <td><?php echo $row['title']; ?></td>

        <td><?php echo $row['content']; ?></td>

        <td>
            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                ✏️ Edit
            </a>

            <a href="delete.php?id=<?php echo $row['id']; ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure you want to delete this post?');">
                🗑️ Delete
            </a>
        </td>

    </tr>

    <?php } ?>

    </tbody>

</table>

</div>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['title']; ?></td>

                    <td><?php echo $row['content']; ?></td>

                    <td>

                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
    ✏️ Edit
</a>

<a href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this post?');">
    🗑️ Delete
</a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>
<nav class="mt-3">
<ul class="pagination justify-content-center">

<?php if($page > 1){ ?>
<li class="page-item">
<a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page-1; ?>">
Previous
</a>
</li>
<?php } ?>

<?php for($i=1; $i<=$totalPages; $i++){ ?>
<li class="page-item <?php echo ($i==$page)?'active':''; ?>">
<a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>">
<?php echo $i; ?>
</a>
</li>
<?php } ?>

<?php if($page < $totalPages){ ?>
<li class="page-item">
<a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page+1; ?>">
Next
</a>
</li>
<?php } ?>

</ul>
</nav>
        <a href="read.php" class="btn btn-secondary">
            Clear Search
        </a>

        <a href="../dashboard.php" class="btn btn-dark">
            ⬅ Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>