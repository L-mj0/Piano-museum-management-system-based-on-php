<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>钢琴博物馆</title>
    <link rel="stylesheet" href="css/index.css">
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
            echo "<li class='li1' style='float: right'><a href='login.php'>登录</a></li>";
            echo "<li class='li1' style='float: right'><a href='register.php'>注册</a></li>";
        } else {
            if($_SESSION['username'] == 'admin'){
                echo "<li class='li1''><a class='active' href='./add.php'>添加</a></li>";
            }
            echo "<li class='li1' style='float: right'><a href='actions/logout.php'>注销</a></li>";
            echo "<li class='li1' style='float: right'><a href='#'>" . $_SESSION['username'] . "</a></li>";
        }
        ?>
    </ul>
</div>



<div class="container">
    <div class="search-box">
        <form>
            <table style="table-layout: fixed;border-collapse: collapse;height:2px">
                <tr>
                    <td style="width:80%">
                        <div class="input-box">
                            <input type="text" name="name" placeholder="哦~看来你已经有想要了解的piano咯@_@" style="color:white"/>
                        </div>
                    </td>
                    <td style="width: 20%">
                        <div class='btn-box'>
                            <div>
                                <button type='submit' formmethod='get'>查询</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php

    function show_result(array $row, mysqli_result $ret): void {
        $count = 0;
        echo "<div class='row'>\n";
        while ($row) {
            if ($count > 0 && $count % 3 == 0) {
                echo "</div>\n<div class='row'>\n"; // 每行显示三个小方框
            }

            $urlname = "images/items/" . base64_encode($row['name']) . ".jpg";
            echo "<div class='box'>\n";
            echo "<a href='detail.php?name=" . $row['name'] . "'>\n"; // 添加链接
            echo "<div class='item_img' style='background-image: url(" . $urlname . ")'></div>\n";
            echo "<h2 class='item_name'>" . $row['name']. "</h2>\n";
            echo "</a>\n";
            echo "</div>\n";

            $count++;
            // 从由 mysqli_query() 返回的结果集中获取一行数据。它将结果集中的下一行作为一个关联数组、一个索引数组或两者兼而有之返回。
            $row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
        }
        echo "</div>\n"; // 关闭最后一个row div
    }

    $conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');

    if (!empty($_GET['name'])) {
        //准备SQL语句
        $sql_select = "SELECT * FROM items WHERE name LIKE '%" . $_GET['name'] . "%'"; //执行SQL语句
        $ret = mysqli_query($conn, $sql_select);
        if ($ret) {
            $row = mysqli_fetch_array($ret);
            if (empty($row)) {
                $_SESSION['message'] = "未找到相关书籍";
                header("Location:./index.php");
            }
            show_result($row, $ret);
        } else {
            echo "<script>alert('查询失败！')</script>\n";
        }
    } else {
        $sql_select = "SELECT * FROM items;";
        $ret = mysqli_query($conn, $sql_select);
        if ($ret) {
            $row = mysqli_fetch_array($ret);
            show_result($row, $ret);
        } else {
            echo "<script>alert('库存为空！')</script>";
        }
    }
    mysqli_close($conn);

    ?>



</div>
</body>
</html>
