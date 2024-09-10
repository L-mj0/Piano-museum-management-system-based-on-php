<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'root','museum_database');

if ($conn && isset($_POST['original_name']) && isset($_POST['name']) && isset($_POST['era']) && isset($_POST['introduction']) && isset($_POST['state'])) {
    // 用户输入的数据进行转义
    $original_name = mysqli_real_escape_string($conn, $_POST['original_name']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $era = mysqli_real_escape_string($conn, $_POST['era']);
    $introduction = mysqli_real_escape_string($conn, $_POST['introduction']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);

    $sql_update = "update items set name='$name', era='$era', introduction='$introduction' state='$state' where name='$original_name'";

    if(mysqli_query($conn, $sql_update)){
        $upload_dir = "../images/items/";
        if(!file_exists($upload_dir)){
            mkdir($upload_dir, 0777, true);
        }
        //获取表单上传的文件的原始文件名的
        if (!empty($_FILES['image']['name'])) {
            $image_path = $upload_dir . base64_encode($name) . ".jpg";
            // 获取表单上传的文件在服务器上的临时存储路径
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        }
        if (!empty($_FILES['audio']['name'])) {
            $audio_dir = "../audio/";
            if (!file_exists($audio_dir)) {
                mkdir($audio_dir, 0777, true);
            }
            $audio_path = $audio_dir . base64_encode($name) . ".mp3";
            move_uploaded_file($_FILES['audio']['tmp_name'], $audio_path);
        }
        $_SESSION['message'] = '修改成功';
        header('Location: ../detail.php?name=' . urlencode($name));
    } else {
        $_SESSION['message'] = '修改失败';
        header('Location: ../modify.php?name=' . urlencode($original_name));
    }
    mysqli_close($conn);
} else {
    $_SESSION['message'] = '数据库连接失败或数据不完整';
    header('Location: ../modify.php?name=' . urlencode($_POST['original_name']));
}
?>
