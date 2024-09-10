<?php

$username = $_POST['username'];
$password = $_POST['password'];
$remember = $_POST['remember'];


session_start();
if(!empty($username)&&!empty($password)) {
    $conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');
    $sql_select = "select username, password from users where username = '$username'";
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    echo $row['username'];
    if($username == $row['username'] && md5($password) == $row['password']){
        if($remember == 'on'){
            setcookie('username', $username, time()+3600*24*7);
        }
        $_SESSION['username'] = $username;
        mysqli_close($conn);
        header("Location: ../index.php");

    }
    else{
        // 用户名密码错误，err = 1;
        $_SESSION['error'] = "用户名或密码错误";
        header("Location: ../login.php");
    }
}
else{
    // 用户名密码为空，err = 2;
    $_SESSION['error'] = "用户名或密码不能为空,请输入用户名或密码";
    header("Location: ../login.php");
}

