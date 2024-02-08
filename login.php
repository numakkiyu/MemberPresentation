<?php
session_start();

// 定义默认的管理员凭据
const ADMIN_USERNAME = 'yourusername';
const ADMIN_PASSWORD = 'yourpassword';

// 检查是否已经登录
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}

$loginError = '';

// 处理登录请求
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        // 登录成功
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        // 登录失败
        $loginError = '无效的用户名或密码';
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="baidu-site-verification" content="code-T3SmGL0Gr8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		<meta name="renderer" content="webkit">
		<title>管理员登录</title>
		<link rel="icon" type="image/x-icon" href="./favicon.ico">
		<meta name="force-rendering" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta charset="utf-8">
		<style>
			body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('https://t.mwm.moe/pc'); /* PC端背景图片 */
    background-size: cover;
}

.login-container {
    background: rgba(255, 255, 255, 0.5); /* 半透明白色背景 */
    backdrop-filter: blur(10px); /* 毛玻璃效果 */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 300px;
}


h2 {
    color: #333;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
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
    background-color: #008cba;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #005f73;
}

.error {
    color: #f44336;
    text-align: center;
    margin-bottom: 15px;
}

/* 通用样式重置，移除超链接的下划线和颜色 */
a {
    text-decoration: none;
    color: inherit;
}

/* 居中文本样式 */
.center-text {
    text-align: center;
}

/* 左对齐文本样式 */
.left-text {
    text-align: left;
}

/* 右对齐文本样式 */
.right-text {
    text-align: right;
}

/* 登录页底部容器样式 */
.login-footer {
    display: flex;
    justify-content: space-between;
    margin-top: 20px; /* 增加顶部间距 */
}

/* 提示框样式 */
#alert-box {
    color: #d9534f; /* 红色调整为更柔和的色调 */
    text-align: center;
    margin-top: 10px;
    font-size: 0.9em; /* 调整字体大小 */
}

/* QQ登录链接样式 */
.center-text a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #55acee; /* QQ蓝色 */
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    font-size: 14px; /* 调整字体大小 */
    transition: background-color 0.3s;
}

/* QQ图标样式 */
.center-text img {
    width: 20px; /* 调整图片大小以匹配文本高度 */
    height: 20px;
    margin-right: 8px; /* 在图标和文本之间增加一些间距 */
}

/* 超链接悬停效果 */
.center-text a:hover, .login-footer a:hover {
    background-color: #3b88c3; /* 深蓝色 */
    text-decoration: none; /* 移除下划线 */
}

/* 媒体查询，针对小屏幕设备 */
@media screen and (max-width: 600px) {
    body {
        background-image: url('https://t.mwm.moe/mp');
        background-size: cover;
    }

    .login-container {
        width: 100%; /* 将宽度设为100% */
        max-width: none; /* 移除最大宽度限制 */
        border-radius: 25px; /* 略微增加圆角 */
        padding: 40px; /* 增加内边距 */
        margin: 30px auto; /* 增加外边距并居中 */
        box-sizing: border-box;
    }

    h2 {
        font-size: 20px; /* 增加标题字体大小 */
        margin-top: 10px; /* 调整标题顶部边距 */
    }

    .form-group label {
        font-size: 16px; /* 增加标签字体大小 */
    }

    input[type="text"], input[type="password"] {
        padding: 20px; /* 增加输入框内边距 */
        font-size: 16px; /* 增加输入框字体大小 */
        width: 100%; /* 使输入框填满容器宽度 */
    }

    button {
        padding: 20px 25px; /* 增加按钮内边距 */
        font-size: 18px; /* 增加按钮字体大小 */
        width: 100%; /* 使按钮填满容器宽度 */
    }
}

    </style>
	</head>
	<body>
		<div class="login-container">
			<h2>管理员登录</h2>
			<?php if ($loginError): ?>
			<p class="error">
				<?php echo $loginError; ?>
			</p>
			<?php endif; ?>
			<form method="post">
				<div class="form-group">
					<label for="username">管理员用户名</label>
					<input type="text" id="username" name="username" required>
				</div>
				<div class="form-group">
					<label for="password">管理员密码</label>
					<input type="password" id="password" name="password" required>
				</div>
				<button type="submit">登录</button>
				<!-- QQ登录链接 没有制作-->
				<p class="center-text">
					<a href="#" target="_blank">
						<img src="./static/png/QQ.png" alt="" width="15" height="15">使用QQ登录
					</a>
				</p>

				<!-- 注册与找回密码 -->
				<div class="login-footer">
					<p class="left-text">
						还没有账号? <a href="#" id="register-link">注册</a>
					</p>
					<p class="right-text">
						<a href="#" id="forgot-password-link">忘记账号密码?</a>
					</p>
				</div>

				<!-- 提示框 -->
				<div id="alert-box" style="display:none;">
					本网站目前不支持在线注册和忘记账号密码找回，网站账号密码为一个，且永不改变，如果想要改变密码，请你修改底层代码。
				</div>
			</form>
		</div>
		<script>
			document.getElementById('register-link').addEventListener('click', function(event) {
			        event.preventDefault();
			        alert('本网站目前不支持在线注册。');
			    });
			
			    document.getElementById('forgot-password-link').addEventListener('click', function(event) {
			        event.preventDefault();
			        alert('本网站目前不支持找回账号密码。');
			    });
		</script>

	</body>
</html>