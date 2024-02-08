<?php
$host = 'localhost'; // 数据库服务器
$user = ''; // 数据库用户名
$pass = ''; // 数据库密码
$dbname = ''; // 数据库名称

// 创建数据库连接
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// 设置PDO错误模式为异常
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // 插入初始数据
    $insertSql = "
    INSERT INTO creators (name, qq) VALUES 
    ('张三', '100000');
    ";

    $pdo->exec($insertSql);
    echo "初始数据插入成功。";
} catch(PDOException $e) {
    echo "数据库操作失败: " . $e->getMessage();
}
?>