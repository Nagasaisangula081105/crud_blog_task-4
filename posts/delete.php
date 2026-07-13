<?php
session_start();
include("../config/db.php");

// User must be logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Only Admin can delete posts
if ($_SESSION['role'] != "admin") {
    die("❌ Access Denied! Only Admin can delete posts.");
}

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Post ID!");
}

$id = (int)$_GET['id'];

// Prepared Statement
$stmt = mysqli_prepare($conn, "DELETE FROM posts WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: read.php");
    exit();
} else {
    echo "Error deleting post!";
}

mysqli_stmt_close($stmt);
?>