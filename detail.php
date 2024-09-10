<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php $_GET['name'] ?></title>
    <link rel="stylesheet" href="css/detail.css">
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
            echo "<script>alert('请登录再查看！'); window.location.href = './login.php';</script>";
        } else {
            if($_SESSION['username'] == 'admin'){
                echo "<li class='li1'><a class='active' href='./add.php'>添加</a></li>";
                echo "<li class='li1'><a href='actions/delete.php?name=" . $_GET['name']. "'>删除</a></li>";
                echo "<li class='li1'><a href='./modify.php?name=" . $_GET['name'] . "'>信息修改</a></li>";
                echo "<li class='li1' style='float: right'><a href='actions/logout.php'>注销</a></li>";
                echo "<li class='li1' style='float: right'><a href='#'>" . $_SESSION['username'] . "</a></li>";
            } else {
                echo "<li class='li1' style='float: right'><a href='actions/logout.php'>注销</a></li>";
                echo "<li class='li1' style='float: right'><a href='#'>" . $_SESSION['username'] . "</a></li>";
            }
        }
        ?>
    </ul>
</div>

<div class="container">

    <?php
    session_start();
    if (!empty($_SESSION['message'])) {
        // 将会话变量 $_SESSION['message'] 中的内容进行 HTML 实体编码，以便安全地在网页中显示
        echo "<script>alert('" . htmlspecialchars($_SESSION['message']) . "')</script>";
        $_SESSION['message'] = null;
    }

    $conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');
    if ($conn && isset($_GET['name'])) {
        // 插入 SQL 查询语句中的字符串进行转义，以防止 SQL 注入攻击
        $name = mysqli_real_escape_string($conn, $_GET['name']);
        $sql_select = "select * from items where name='$name'";
        $ret = mysqli_query($conn, $sql_select);
        if ($ret) {
            $row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
            if ($row) {
                echo "<div class='container'>\n";
                echo "<h1 class = 'item_name'>".$row['name']."</h1>\n";
                $imgfile = "images/items/" . base64_encode($row['name']) . ".jpg";
                $audiofile = "audio/" . base64_encode($row['name']) . ".mp3";
                echo "<div class='item_img' style='background-image: url(" . $imgfile . "); cursor: pointer;' onclick='playAudio()'></div>\n";
                echo "<audio id='audio' src='" . $audiofile . "'></audio>\n";
                echo "<h2 class='detail'>时期 " . $row['era'] . "</h2>\n";
                echo "<h2 class='detail'>馆藏状态 " . $row['state'] ? "在馆" : "不在馆" . "</h2>\n";
                echo "<h2 class='detail'>简介</h2>\n";
                echo "<p class='introduction'>" . htmlspecialchars($row['introduction']) . "</p>\n";
                echo "</div>\n";
            } else {
                echo "<p>未找到相关展品。".$row."</p>";
            }
        } else {
            echo "<p>查询失败！</p>";
        }
        mysqli_close($conn);
    } else {
        echo "<p>数据库连接失败或未提供名称！</p>";
    }
    ?>

    <script>
        function playAudio() {
            var audio = document.getElementById('audio');
            audio.play();
        }
    </script>
</div>
</body>
</html>
