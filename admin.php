<?php
require 'config.php';
require 'functions.php';

// 检查用户是否登录
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$message = ''; // 用于存储消息

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $qq = $_POST['qq'];
    $homepage = $_POST['homepage'] ?? '';

    if (isset($_POST['add'])) {
        if (!nicknameExists($name)) {
            // 添加制作者
            addCreator($name, $qq, $homepage);
            $message = "成员 {$name} 已成功添加。";
        } else {
            $message = "昵称 '{$name}' 已存在，请选择其他昵称。";
        }
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        if (!nicknameExists($name, $id)) {
            // 更新制作者
            updateCreator($id, $name, $qq, $homepage);
            $message = "成员 {$name} 的信息已成功更新。";
        } else {
            $message = "昵称 '{$name}' 已存在，请选择其他昵称。";
        }
    } elseif (isset($_POST['delete'])) {
        // 删除制作者
        deleteCreator($_POST['id']);
        $message = "制作者已成功删除。";
    }
}

// 获取当前所有制作者
$creators = getCreators();
?>

<!DOCTYPE html>
<html>
	<head>
	    <meta name="baidu-site-verification" content="code-T3SmGL0Gr8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	    <meta name="renderer" content="webkit">
	    <title>管理界面</title>
	    <link rel="icon" type="image/x-icon" href="https://you.yourwebsite.com/favicon.ico">
	    <meta name="force-rendering" content="webkit">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta charset="utf-8">
		<style>
			body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    color: #333;
}

h1 {
    color: #333;
    text-align: center;
}

/* 显示消息的样式 */
.message {
    position: relative;
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
    text-align: center;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background-color: transparent;
    cursor: pointer;
    font-size: 20px;
    color: #31708f;
}

form {
    background: #ffffff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}

.logout-button {
    background-color: #d3d3d3;
    color: white;
    width: 100%;
    margin-bottom: 20px;
}

.logout-button:hover {
    background-color: #f44336;
    color: white;
}

.update-button {
    background-color: #4CAF50;
    color: white;
}

.delete-button {
    background-color: #f44336;
    color: white;
}

.update-button:hover {
    background-color: #388E3C;
}

.delete-button:hover {
    background-color: #c5302c;
}

button[type="submit"] {
    width: 48%;
    display: inline-block;
}

@media screen and (max-width: 600px) {
    button[type="submit"] {
        width: 100%;
        display: block;
        margin-bottom: 10px;
    }
}

form + form {
    border-top: 2px solid #eee;
    padding-top: 20px;
}

@media screen and (max-width: 600px) {
    /* 适应小屏幕的样式调整 */

    form {
        width: 100%;
        box-shadow: none;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 8px;
    }

    button[type="submit"] {
        width: 100%; /* 在小屏幕上按钮宽度设为100% */
        margin-bottom: 10px;
    }

    .logout-button {
        width: 100%;
        margin-bottom: 20px;
    }

    .update-button, .delete-button {
        width: 48%; /* 小屏幕上按钮并排 */
        display: inline-block;
    }

    .update-button:hover, .delete-button:hover {
        color: white;
    }

    .message {
        font-size: 14px; /* 减小消息字体大小 */
        padding: 8px;
    }

    .close-button {
        font-size: 18px; /* 调整关闭按钮大小 */
    }
}

/* 分隔不同的表单 */
form + form {
    border-top: 2px solid #eee;
    padding-top: 20px;
}

    </style>
	</head>
	<body>
		<h1>管理界面</h1>
		<?php if ($message): ?>
		<div class="message" id="message-box">
			<p>
				<?php echo $message; ?>
			</p>
			<button onclick="document.getElementById('message-box').style.display='none'" class="close-button">&times;</button>
		</div>
		<?php endif; ?>
		<form method="post" action="logout.php">
			<button type="submit" name="logout" class="logout-button">退出登录</button>
			<p>电脑端：搜索昵称可以Ctrl+F。</p>
			<p>iOS手机端：Safari搜索昵称可以随便选择一个文字然后长按有一个“查找所选内容”，然后在输入框里面改为成你想输入的名字即可。</p>
			<p>安卓手机端：由于种类太多，请从浏览器搜索方法。</p>
		</form>
		<!-- 添加制作者表单 -->
		<form method="post">
			<input type="text" name="name" placeholder="昵称（可以在昵称添加头衔；如：张三[管理组成员]）" required autocomplete="off">
			<input type="text" name="qq" placeholder="QQ号（选填，不会展示出来，只是来获取头像）" autocomplete="off">
			<input type="text" name="homepage" placeholder="个人主页链接（选填，不填不显示；如：B站主页链接，微博主页链接，博客网站链接）" autocomplete="off">
			<button type="submit" name="add">添加成员</button>
		</form>

		<!-- 制作者列表和修改/删除表单 -->
		<?php foreach ($creators as $creator): ?>
		<form method="post">
			<input type="hidden" name="id" value="<?php echo $creator['id']; ?>">
			<input type="text" name="name" value="<?php echo htmlspecialchars($creator['name']); ?>" placeholder="昵称（可以在昵称添加头衔；如：张三[管理组成员]）" required autocomplete="off">
			<input type="text" name="qq" value="<?php echo htmlspecialchars($creator['qq']); ?>" placeholder="QQ号（选填，不会展示出来，只是来获取头像）" autocomplete="off">
			<input type="text" name="homepage" value="<?php echo htmlspecialchars($creator['homepage'] ?? ''); ?>" placeholder="个人主页链接（选填，不填不显示；如：B站主页链接，微博主页链接，博客网站链接）" autocomplete="off">
			<button type="submit" name="update" class="update-button">更新信息</button>
			<button type="submit" name="delete" class="delete-button">删除</button>
		</form>
		<?php endforeach; ?>

	</body>
</html>