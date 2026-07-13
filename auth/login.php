<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        echo "<script>alert('All fields are required!');</script>";
    } else {

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){

            $user = mysqli_fetch_assoc($result);

            if(password_verify($password, $user['password'])){

                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: ../dashboard.php");
                exit();

            } else {
                echo "<script>alert('Invalid Password!');</script>";
            }

        } else {
            echo "<script>alert('User Not Found!');</script>";
        }

        mysqli_stmt_close($stmt);
    }
}
?><!DOCTYPE html><html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"><title>CRUD Blog | Login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"><style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#4F46E5,#7C3AED);
    overflow:hidden;
}

.glass-card{
    width:420px;
    padding:40px;
    border-radius:25px;
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,.2);
    box-shadow:0 20px 40px rgba(0,0,0,.2);
}

.logo{
    font-size:50px;
    text-align:center;
    margin-bottom:10px;
}

.title{
    text-align:center;
    color:white;
    font-weight:700;
    margin-bottom:5px;
}

.subtitle{
    text-align:center;
    color:#e0e7ff;
    margin-bottom:30px;
}

.form-control{
    border-radius:15px;
    padding:14px;
    border:none;
    background:rgba(255,255,255,.2);
    color:white;
}

.form-control::placeholder{
    color:#e5e7eb;
}

.form-control:focus{
    background:rgba(255,255,255,.3);
    color:white;
    box-shadow:none;
}

.form-label{
    color:white;
    font-weight:500;
}

.btn-login{
    width:100%;
    border:none;
    border-radius:15px;
    padding:14px;
    background:white;
    color:#4F46E5;
    font-weight:700;
    transition:.3s;
}

.btn-login:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,.2);
}

.btn-register{
    width:100%;
    border-radius:15px;
    padding:12px;
    font-weight:600;
}

.divider{
    text-align:center;
    color:#e5e7eb;
    margin:20px 0;
}

.footer{
    text-align:center;
    color:#e5e7eb;
    font-size:14px;
    margin-top:20px;
}

</style></head><body><div class="glass-card"><div class="logo">📝</div><h2 class="title">Welcome Back</h2><p class="subtitle">Login to manage your CRUD Blog</p><form method="POST"><div class="mb-3">
<label class="form-label">Username</label>
<input
type="text"
name="username"
class="form-control"
placeholder="Enter Username"
required>
</div><div class="mb-4">
<label class="form-label">Password</label>
<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required
minlength="6">
</div><button type="submit" name="login" class="btn-login">
🔐 Login
</button></form><div class="divider">or</div><a href="register.php" class="btn btn-outline-light btn-register">
✨ Create New Account
</a><div class="footer">
© 2026 CRUD Blog | Made with ❤️ by Nagasai
</div></div></body>
</html>