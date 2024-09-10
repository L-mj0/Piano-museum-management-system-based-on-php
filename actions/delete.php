<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');

if (!$conn) {
    $_SESSION['message'] = '数据库连接失败';
    header('Location: ../');
    exit();
}


if($conn && isset($_GET['name'])) {
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $sql_delete = "delete from items where name='$name'";
    $ret = mysqli_query($conn, $sql_delete);
    if ($ret) {
        $_SESSION['message'] = '删除成功！';
    } else {
        $_SESSION['message'] = '删除失败！';
    }
}
else{
    $_SESSION['message'] = '未提供名称！';
}

mysqli_close($conn);
header('Location: ../');