# 成员展示PHP+MySQL项目 MemberPresentation 
成员展示PHP+MySQL项目，主要分布展示修改成员信息

##### PHPWeb代码详细简介
###### 源码作者：北海的佰川
###### 代码修改：lzcn
----
采用纯PHP+MySQL的Web页面，页面布局简单体积小，可以在子页面使用，支持所有php版本

----
源码展示

1、index.php页面源码
```php
<?php
require 'config.php';
require 'functions.php';

// 获取成员信息
$creators = getCreators();
?>

<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta name="baidu-site-verification" content="code-T3SmGL0Gr8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		<meta name="renderer" content="webkit">
		<link rel="icon" type="image/x-icon" href="https://you.yourwebsite.com/favicon.ico">
		<meta name="force-rendering" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta charset="utf-8">
		<title>你的站点名称</title>
		<link rel="stylesheet" href="https://guild.hypcvgm.top/member/static/css/mdui.min.css">
		<script src="https://guild.hypcvgm.top/member/static/js/mdui.min.js"></script>
		<style>
			.share span {
			      font-weight: bold;
			    }
			
			    .share button {
			      border: none;
			      border-radius: 5px;
			      padding: 5px 10px;
			      cursor: pointer;
			    }
		</style>
	</head>
	<body class="mdui-theme-primary-blue-800 mdui-appbar-with-toolbar mdui-theme-layout-auto mdui-loaded">
		<header class="appbar mdui-appbar mdui-appbar-fixed">
			<div class="mdui-appbar">
				<div class="mdui-toolbar mdui-color-blue-800 mdui-shadow-8">
					<a href="/" class="mdui-typo-headline">你的站点名称</a>
					<small>资深成员 | 管理人员 | 鸣谢成员</small>
					<div class="mdui-toolbar-spacer"></div>
					<div class="mdui-toolbar-spacer"></div>
					<a href="https://you.yourwebsite.com">返回主页
					</a>
				</div>
			</div>
		</header>

		<div class="mdui-container">
			<div class="mdui-card mdui-shadow-7 mdui-m-b-2">
				<div class="mdui-card-primary">
					<div class="mdui-card-primary-title">成员</div>
					<div class="mdui-card-primary-subtitle">
						<small>你的信息</small>
					</div>
				</div>
				<div class="mdui-card-content">
					<ul class="mdui-list">
						<?php foreach ($creators as $creator): ?>
						<li class="mdui-list-item mdui-ripple">
							<div class="mdui-list-item-avatar">
								<img src="<?php echo " http://q.qlogo.cn/headimg_dl?dst_uin=" . $creator['qq'] . "&spec=640&img_type=jpg" ; ?>" class="image" alt="404">
							</div>
							<div class="mdui-list-item-content">
								<div class="mdui-list-item-title mdui-list-item-one-line">
									<?php echo htmlspecialchars($creator['name']); ?>
								</div>
							</div>
							<?php if (!empty($creator['homepage'])): ?>
							<a href="<?php echo htmlspecialchars($creator['homepage']); ?>" class="mdui-btn mdui-ripple mdui-shadow-3" target="_blank">个人主页</a>
							<?php endif; ?>
						</li>
						<li class="mdui-divider-inset mdui-m-y-0"></li>
						<?php endforeach; ?>
						<li class="mdui-divider-inset mdui-m-y-0"></li>
						<li class="mdui-list-item mdui-ripple">
							<div class="mdui-list-item-avatar">
								<img src="http://q.qlogo.cn/headimg_dl?dst_uin=10000&spec=640&img_type=jpg" class="image" alt="main_menu">
							</div>
							<div class="mdui-list-item-content">
								<div class="mdui-list-item-title mdui-list-item-one-line">我们等你加入！！！！</div>
							</div>
						</li>
						<li class="mdui-divider-inset mdui-m-y-0"></li>
					</ul>
					<div class="mdui-text-color-black-secondary">
						<p>
							填写你的信息
						</p>
						<p>
							源码作者：北海的佰川
							<br><p>Copyright &copy; 2024 北海的佰川 保留所有权益</p>
						</p>
						<div class="share">
							<span>分享网站：</span>
							<button id="copy">复制链接</button>
							<button id="bilibili">分享到B站</button>
							<button id="qq">分享到QQ</button>
						</div>
					</div>
				</div>
			</div>
			<script src="static/js/jquery.min.js"></script>
			<script>
				var copy = document.getElementById("copy");
				    var bilibili = document.getElementById("bilibili");
				    var qq = document.getElementById("qq");
				    var wechat = document.getElementById("wechat");
				    var link = "https://you.yourwebsite.com";
				    function copyLink() {
				      var input = document.createElement("input");
				      input.value = link;
				      document.body.appendChild(input);
				      input.select();
				      document.execCommand("copy");
				      document.body.removeChild(input);
				    }
				
				    function shareToBilibili() {
				      copyLink();
				      window.open("https://t.bilibili.com/");
				    }
				
				    function shareToQQ() {
				      copyLink();
				      // 打开QQ的程序
				      window.location.href = "tencent://message/?Menu=yes";
				    }
				
				    function shareToWechat() {
				      copyLink();
				      // 打开微信的程序
				      window.location.href = "weixin://";
				    }
				
				    copy.addEventListener("click", copyLink);
				    bilibili.addEventListener("click", shareToBilibili);
				    qq.addEventListener("click", shareToQQ);
				    wechat.addEventListener("click", shareToWechat);
			</script>
	</body>
</html>
```
----
2、admin.php页面源码
```
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
```
----
3、login.php页面源码
```
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
```
----
4、functions.php界面
```
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

```
----
5、config.php页面源码
```
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

```
----
6、logout.php页面源码
```
<?php
// 开始会话
session_start();

// 清除所有会话变量
$_SESSION = array();

// 销毁会话
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// 重定向到登录页面
header("Location: login.php");
exit;
?>

```
----
上面就是PHP代码的所有文件，简单小巧，目前不支持特殊符号以及特殊字符，所有文件可以在同一个文件夹下面，你也可以自己更改目录，下面是MySQL注入php代码

注入文件名称必须是setup.php
```
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
```

----
##### 注意事项
1、index.php页面里面的
```
<meta charset="utf-8">
		<title>你的站点名称</title>
		<link rel="stylesheet" href="https://guild.hypcvgm.top/member/static/css/mdui.min.css">
		<script src="https://guild.hypcvgm.top/member/static/js/mdui.min.js"></script>
```
一定要是`https://guild.hypcvgm.top/member/static/js/mdui.min.js` 和 `https://guild.hypcvgm.top/member/static/css/mdui.min.css`你也可以在Github上面拉Git回去CSS和JS

2、本代码是以简单小巧为主，删除了安全部分，请你们自行添加，如果导致数据库丢失，后果自负

3、本代码属于开源项目

4、禁止商用
