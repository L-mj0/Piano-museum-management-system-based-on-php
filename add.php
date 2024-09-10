<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php $_GET['name'] ?></title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <?php
    if (!session_id()) session_start();
    if (!empty($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "')</script>";
        $_SESSION['message'] = null;
    }
    ?>

    <div>
        <ul class="ul1">
            <li class="li1"><a class="active" href="./">主页</a></li>
            <?php
            if (!isset($_SESSION['username'])) {
                header("Location: ./login.php");
            } else {
                if($_SESSION['username'] == 'admin'){
                    echo "<li class='li1''><a class='active' href='#'>添加</a></li>";
                    echo "<li class='li1' style='float: right'><a href='actions/logout.php'>注销</a></li>";
                    echo "<li class='li1' style='float: right'><a href='#'>" . $_SESSION['username'] . "</a></li>";
                }else{
                    echo "<li class='li1' style='float: right'><a href='actions/logout.php'>注销</a></li>";
                    echo "<li class='li1' style='float: right'><a href='#'>" . $_SESSION['username'] . "</a></li>";
                }

            }
            ?>
        </ul>
    </div>
    <div class="add-form">
        <h1>添加新藏品</h1>
        <form action="actions/add.php" method="post" enctype="multipart/form-data">
            <h2>藏品名：</h2>
            <input type="text" name="name" required>
            <h2>藏品时期：</h2>
            <input type="text" name="era" required>
            <h2>藏品状态：</h2>
            <input type="text" name="state" required>
            <h2>介绍：</h2>
            <textarea name="introduction" rows="5" required></textarea>
            <h2>上传图片：</h2>
            <input type="file" name="image" accept="image/*" required>
            <h2>上传音频：</h2>
            <input type="file" name="audio" accept="audio/*" >
            <button type="submit">提交</button>
        </form>
    </div>


</body>
</html>