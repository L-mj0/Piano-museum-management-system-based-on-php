<?php
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$address = $_POST['address'];

//echo 'username: ' . $username . '<br>';
//echo 'password: ' . $password . '<br>';
//echo 'password2: ' . $password2 . '<br>';
//echo 'email: ' . $email . '<br>';
//echo 'address' . $address. '<br>';

session_start();

if(!empty($username) && !empty($password) && !empty($email) && !empty($address)) {

    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{0,254}$/', $username)) {
        $_SESSION['error'] = "用户名必须以字母开头，并且只能包含字母、数字和下划线。";
        header('Location: ../register.php');
        exit();
    }

    if (strlen($password) < 6 || strlen($password) > 8) {
        echo "密码长度必须在6到8个字符之间。";
        exit();
    }

    if ($password != $password2){
        $_SESSION['error'] = '两次输入的密码不一致';
        header('Location: ../register.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "请输入有效的邮箱地址。";
        exit();
    }





    $conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');
//    if(!$conn)
//    {
//        die('connect error<br>'.mysqli_connect_error());
//    }
//    echo "connect success<br>";


    $sql_select = "select username from users where username='$username'";
    $result = mysqli_query($conn, $sql_select);
    // 遍历查询结果集
    $row = mysqli_fetch_array($result);

    if(!empty($row['username'])){
        $_SESSION['error'] = '用户名已存在';
        header('Location: ../register.php');
        exit();
    }
    else{
        $password = md5($password);
//        echo 'password: ' . $password . '<br>';
        $_SESSION['message'] = '注册成功';
        $sql_intert = "insert into users(username,password,email,address) values('$username', '$password', '$email','$address')";
        mysqli_query($conn, $sql_intert);
    }
    mysqli_close($conn);
     header('Location: ../login.php');
}else{
    $_SESSION['error'] = '请填写完整信息';
    header('Location: ../register.php');
}
