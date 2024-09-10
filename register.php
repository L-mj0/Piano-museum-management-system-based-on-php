<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
    <title>注册</title>
</head>

<body>
<?php
session_start();
if (!empty($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    $_SESSION['message'] = null;
}
?>
<div class="login-form">
    <h2>Register</h2>
    <form action="actions/register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="password2">Repeat Password:</label>
        <input type="password" id="password2" name="password2" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required/>

        <label for="address">Adress</label>
        <input type="text" id="address" name="address" required/>

        <?php
        if (array_key_exists('error', $_SESSION)) {
            echo "<p>" . $_SESSION['error'] . "</p>";
            $_SESSION['error'] = null;
        }
        ?>

        <button type="submit">Register</button>
        <button onclick="window.location.href='./login.php'" type="button">Log in</button>
    </form>
</div>

</body>
</html>