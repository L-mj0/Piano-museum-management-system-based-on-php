<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>信息修改_<?php $_GET['name'] ?></title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
<?php
session_start();

if ($_SESSION['username'] != 'admin') {
    $_SESSION['message'] = '不是admin无权限';
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    header("Location: ./");
}

$conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');

if (!$conn) {
    $_SESSION['message'] = '数据库连接失败';
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    header('Location: ./');
}


if(isset($_GET['name'])){
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $sql_select = "select * from items where name='$name'";
    $ret = mysqli_query($conn, $sql_select);
    if($ret && $row = mysqli_fetch_array($ret, MYSQLI_ASSOC)){
        $item = $row;
    }
    else{
        $_SESSION['message'] = '未找到该藏品！';
        echo "<script>alert('" . $_SESSION['message'] . "')</script>";
        header('Location: ./');
    }
}else{
    $_SESSION['message'] = '未提供名称！';
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    header('Location: ./');
}
mysqli_close($conn);

if (!empty($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "')</script>";
    $_SESSION['message'] = null;
}
?>
<div>
    <ul class="ul1">
        <li class="li1"><a class="active" href="./">主页</a></li>
        <li class='li1''><a class='active' href='./add.php'>添加</a></li>
        <li class='li1' style='float: right'><a href='actions/logout.php'>注销</a></li>
        <li class='li1' style='float: right'><a href='#'><?= $_SESSION['username'] ?></a></li>
    </ul>
</div>

<div class="add-form">
    <h1>修改藏品信息</h1>
    <form action="actions/modify.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="original_name" value="<?php echo $item['name']; ?>">
        <h2>藏品名：</h2>
        <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
        <h2>藏品时期：</h2>
        <input type="text" name="era" value="<?php echo $item['era']; ?>" required>
        <h2>藏品状态：</h2>
        <input type="text" name="state" value="<?php echo $item['state']; ?>" required>
        <h2>介绍：</h2>
        <textarea name="introduction" rows="5" required><?php echo htmlspecialchars($item['introduction']); ?></textarea>
        <h2>上传图片：</h2>
        <input type="file" name="image" accept="image/*">
        <h2>上传音频：</h2>
        <input type="file" name="audio" accept="audio/*">
        <div class="form-actions">
            <button type="submit">提交</button>
            <a href="actions/delete.php?name=<?php echo $item['name']; ?>" class="delete-button">删除</a>
        </div>
    </form>
</div>

</body>
</html>