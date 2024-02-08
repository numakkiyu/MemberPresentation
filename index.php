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