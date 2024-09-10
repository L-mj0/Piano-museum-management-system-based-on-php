<?php
// 数据库连接参数
$servername = "localhost";
$username = "root";
$password = "root";
$database = "museum_database";

//// 创建数据库连接
//$conn = mysqli_connect($servername, $username, $password);
////
//// 检查连接是否成功
//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//} else {
//    echo "Connection successful<br>";
//}
//
//// 创建数据库的SQL语句
//$sql = "CREATE DATABASE museum_database CHARACTER SET utf8 COLLATE utf8_general_ci;";
//
//// 执行SQL语句并检查结果
//if (mysqli_query($conn, $sql)) {
//    echo "Database created successfully<br>";
//} else {
//    echo "Error creating database: " . mysqli_error($conn) . "<br>";
//}

//// 关闭数据库连接
//mysqli_close($conn);


$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
    die('connect error<br>'.mysqli_connect_error());
}
echo "connect success<br>";

//创建数据库
//$sql = "create database museum_database";
//if(mysqli_query($conn,$sql))
//{
//    echo "database success<br>";
//}
//else{
//    echo "database failed<br>".mysqli_error($conn);
//}

$sql = "use museum_database;";

//创建users表
//$sql .= "create table users(
//	username varchar(200) primary key not null,
//	password varchar(800) not null,
//	email varchar(800) not null,
//  address varchar(800) not null
//);";
//if(mysqli_query($conn,$sql))
//{
//    echo "table success<br>";
//}
//else{
//    echo "table failed<br>".mysqli_error($conn);
//}

//$sql .= "CREATE TABLE users (
//    username VARCHAR(250) PRIMARY KEY NOT NULL,
//    password VARCHAR(800) NOT NULL,
//    email VARCHAR(800) NOT NULL,
//    address VARCHAR(800) NOT NULL
//) CHARACTER SET utf8 COLLATE utf8_general_ci;";
//if(mysqli_query($conn, $sql)) {
//    echo "table success<br>";
//} else {
//    echo "table failed<br>" . mysqli_error($conn);
//}
//

//创建items表
//$sql .= "CREATE TABLE items (
//    name VARCHAR(255) PRIMARY KEY NOT NULL,
//    era VARCHAR(255) NOT NULL,
//    introduction TEXT NOT NULL,
//    state varchar TEXT NOT NULL
//)CHARACTER SET utf8 COLLATE utf8_general_ci;";
//if(mysqli_query($conn, $sql)) {
//    echo "table success<br>";
//} else {
//    echo "table failed<br>" . mysqli_error($conn);
//}


////插入数据
//$sql = "insert into items * values('Collard & Collard','19世纪初','此琴产于19世纪初，已使用了铸铁框架,琴弦是纵向的，上门的精美雕花是用细木纯手工镶嵌的。黑键是圆弧形的，这是它最主要的特色，也是早期“科勒德”钢琴最重要的特征。1767年科勒德钢琴诞生于英国伦敦，后由著名的钢琴家、作曲家克莱门蒂管理。19世纪上半叶到19世纪末，科勒德公司在欧洲钢琴制造业名列前茅。克莱门蒂、莫扎特、海顿，贝多芬等都终身使用该品牌的琴。科勒德钢琴是世界上回键声最小的钢琴之一。');";
////$sql .= "insert into goods() values(10005,'sgf','China',308000,'2024-5-10');";
//
//$sql = "insert into items(name,era,introduction) values('Collard & Collard','19世纪初','此琴产于19世纪初，已使用了铸铁框架,琴弦是纵向的，上门的精美雕花是用细木纯手工镶嵌的。黑键是圆弧形的，这是它最主要的特色，也是早期“科勒德”钢琴最重要的特征。1767年科勒德钢琴诞生于英国伦敦，后由著名的钢琴家、作曲家克莱门蒂管理。19世纪上半叶到19世纪末，科勒德公司在欧洲钢琴制造业名列前茅。克莱门蒂、莫扎特、海顿，贝多芬等都终身使用该品牌的琴。科勒德钢琴是世界上回键声最小的钢琴之一。');";
//
//
//
//if(mysqli_multi_query($conn,$sql))
//{
//    echo "insert values success<br>";
//}
//else{
//    echo "insert values failed<br>".mysqli_error($conn);
//}

// 测试插入数据
//$username = 'A123456';
//$password = md5('A123456');
//$email = 'A123456@outlook.com';
////
//$sql = "insert into users(username,password,email) values('$username', '$password', '$email');";
//echo mysqli_query($conn, $sql);
//if(mysqli_query($conn,$sql))
//{
//    echo "insert values success<br>";
//}
//else{
//    echo "insert values failed<br>".mysqli_error($conn);
//}


////插入数据
//$sql = "select * from 'goods'";
//$result = mysqli_query($conn,$sql);
//
//if(mysqli_num_rows($result)>0)
//{
//    echo "insert values success<br>";
//}
//else{
//    echo "insert values failed<br>".mysqli_error($conn);
//}

//# 删除数据
//$sql = "delete from items where name=10005";
//if(mysqli_query($conn,$sql))
//{
//    echo "delete values success<br>";
//}
//else{
//    echo "delete values failed<br>".mysqli_error($conn);
//}

// 删表
//$sql = "drop table users";
//if(mysqli_query($conn,$sql))
//{
//    echo "delete table success<br>";
//}
//else{
//    echo "delete table failed<br>".mysqli_error($conn);
//}


//
//
$conn->close();
//
//



