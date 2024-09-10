<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-uA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>登录</title>
</head>
<body>
<?php
session_start();
if (!empty($_SESSION['message'])) {
    echo "<script> alert('{$_SESSION['message']}')</script>";
    $_SESSION['message'] = null;
}
if(!empty($_SESSION['username'])){
    header("Location: index.php");
}
?>
<div class="login-form">
    <h2>Login</h2>
    <form action="actions/login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <?php
        // 检查 _SESSION 数组中是否存在名为 'error' 的键
        if(array_key_exists('error', $_SESSION)){
            echo "<p style='color: red'>".$_SESSION['error']."</p>";
            $_SESSION['error'] = null;
        }
        ?>
        <div class="remember-me">
            <label for="checkboxtext">记住我的用户ID</label>
            <input type="checkbox" name="remember">
        </div>
        <button type="submit">Log in</button>
        <button type="button" onclick="window.location.href='./register.php'">Register</button>
    </form>
</div>

</body>
</html>