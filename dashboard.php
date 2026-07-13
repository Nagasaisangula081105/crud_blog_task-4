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

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#4F46E5,#7C3AED);
    min-height:100vh;
}

.navbar{
    background:#111827;
    box-shadow:0 10px 20px rgba(0,0,0,.25);
}

.logo{
    font-size:28px;
    font-weight:bold;
}

.user-box{
    background:white;
    color:#4F46E5;
    padding:8px 18px;
    border-radius:30px;
    font-weight:600;
}

.dashboard-card{

    max-width:600px;
    margin:70px auto;
    background:white;
    border-radius:20px;
    padding:45px;
    box-shadow:0 20px 45px rgba(0,0,0,.25);

}

.icon{

    font-size:70px;

}

h1{

    font-weight:700;
    color:#4F46E5;

}

.subtitle{

    color:#6b7280;
    font-size:17px;
    margin-bottom:35px;

}

.btn-dashboard{

    width:100%;
    padding:16px;
    border-radius:12px;
    font-size:18px;
    font-weight:600;
    margin-bottom:18px;
    transition:.3s;

}

.btn-dashboard:hover{

    transform:translateY(-3px);

}

.footer{

    text-align:center;
    color:white;
    margin-top:30px;

}

</style>

</head>

<body>

<nav class="navbar navbar-dark">

<div class="container">

<span class="navbar-brand logo">
📝 CRUD BLOG
</span>

<span class="user-box">
👤 <?php echo htmlspecialchars($_SESSION['username']); ?>
</span>

</div>

</nav>

<div class="dashboard-card text-center">

<div class="icon">
📚
</div>

<h1>Welcome Back</h1>

<h4 class="mt-2">
<?php echo htmlspecialchars($_SESSION['username']); ?>
</h4>

<p class="subtitle">
Manage your blog posts easily with a secure and professional dashboard.
</p>

<a href="posts/create.php" class="btn btn-success btn-dashboard">
➕ Create New Post
</a>

<a href="posts/read.php" class="btn btn-primary btn-dashboard">
📄 View All Posts
</a>

<a href="auth/logout.php" class="btn btn-danger btn-dashboard">
🚪 Logout
</a>

</div>

<div class="footer">

<h6>
© 2026 CRUD Blog | Developed by <b>Nagasai</b>
</h6>

</div>

</body>
</html>