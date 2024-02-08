<?php
require 'config.php';

// 获取所有制作者信息
function getCreators() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM creators");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("数据库查询失败: " . $e->getMessage());
    }
}

// 添加新的制作者
function addCreator($name, $qq, $homepage) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO creators (name, qq, homepage) VALUES (:name, :qq, :homepage)");
        $stmt->execute(['name' => $name, 'qq' => $qq, 'homepage' => $homepage]);
    } catch (PDOException $e) {
        die("数据库写入失败: " . $e->getMessage());
    }
}

// 更新制作者信息
function updateCreator($id, $name, $qq, $homepage) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE creators SET name = :name, qq = :qq, homepage = :homepage WHERE id = :id");
        $stmt->execute(['id' => $id, 'name' => $name, 'qq' => $qq, 'homepage' => $homepage]);
    } catch (PDOException $e) {
        die("数据库更新失败: " . $e->getMessage());
    }
}

// 删除制作者
function deleteCreator($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM creators WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        die("数据库删除失败: " . $e->getMessage());
    }
}

function nicknameExists($name, $excludeId = null) {
    global $pdo;
    $query = "SELECT COUNT(*) FROM creators WHERE name = :name";
    if ($excludeId !== null) {
        $query .= " AND id != :id";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    if ($excludeId !== null) {
        $stmt->bindParam(':id', $excludeId);
    }

    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

?>
