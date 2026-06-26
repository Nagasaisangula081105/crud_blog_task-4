<?php
session_start();

if(isset($_SESSION['username'])){
    header("Location: dashboard.php");
}else{
    header("Location: auth/login.php");
}
exit();
?>