<?php
// 数据库配置信息
$host = 'localhost'; // 数据库服务器地址
$dbname = ''; // 数据库名
$user = ''; // 数据库用户名
$pass = ''; // 数据库密码

try {
    // 创建PDO实例并设置连接属性
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // 设置PDO错误模式为异常，这将允许我们使用try...catch来捕获错误
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // 连接失败时的错误处理
    die("数据库连接失败: " . $e->getMessage());
}
?>
