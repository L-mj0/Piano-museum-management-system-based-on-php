<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect('localhost', 'root', 'root', 'museum_database');
    if (!$conn) {
        die("连接失败: " . mysqli_connect_error());
    }

    # 处理成字符串
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $era = mysqli_real_escape_string($conn, $_POST['era']);
    $introduction = mysqli_real_escape_string($conn, $_POST['introduction']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);

    $targetidir = "../images/items/";
    $targetadir = "../audio/";
    $baseName = base64_encode($name);

    $targetImage = $targetidir . $baseName . ".jpg";
    $targetAudio = $targetadir . $baseName . ".mp3";


    // 尝试移动上传的文件到目标位置 $_FILES['image']['name']：原始文件名 / $_FILES['image']['tmp_name']：文件上传后在服务器上的临时文件名和路径。
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetImage)) {
        move_uploaded_file($_FILES["audio"]["tmp_name"], $targetAudio);
        $sql = "insert into items(name,era,introduction,state) values ('$name', '$era', '$introduction','$state');";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('藏品添加成功！'); window.location.href = '../index.php';</script>";
        } else {
            echo "添加失败: " . mysqli_error($conn);
        }
    } else {
//        $s = "files[img]: ".$_FILES["image"]["tmp_name"]."    targetimge: " .$targetImage;
//        echo $s;
        echo "<script>alert('文件上传失败'.s); window.location.href = './add.php';</script>";
    }

    mysqli_close($conn);
} else {
    header("Location: ../add.php");
    exit();
}