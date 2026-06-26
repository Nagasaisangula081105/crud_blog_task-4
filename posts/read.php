<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['username'])){
    header("Location: ../auth/login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM posts");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Blog | View Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg p-4">

<h2 class="text-center text-primary mb-4">📄 All Posts</h2>

<table class="table table-bordered table-hover table-striped">

<thead class="table-dark">

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
Edit
</a>

<a href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this post?');">
Delete
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="../dashboard.php" class="btn btn-secondary">
⬅ Back to Dashboard
</a>

</div>

</div>

</body>
</html>