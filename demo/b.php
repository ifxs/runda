
<!-- 顶部 -->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>润达智能水-用户注册 --润达送水 润你生活</title>
<link href="/Content/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/Content/style/layout_reset.css" rel="stylesheet">
<link href="/Content/style/layout_basic.css" rel="stylesheet">
	<!--[if lt IE 9]>
       <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!-- 顶部 -->
	<div class="header">
		<div class="topBar">
			<a href="index.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></button></a>&nbsp;&nbsp;
			
			
					<a href="index.php?controller=Home&method=login"><button type="button" class="btn btn-default btn-sm">登录</button></a>
					<a href="index.php?controller=Home&method=register"><button type="button" class="btn btn-default btn-sm">免费注册</button></a>
			<a href="index.php?controller=RunDa&method=aboutRunDa" target="_blank"><button type="button" class="btn btn-default btn-sm">关于润达</button></a>
			<a href="index.php?controller=RunDa&method=connectToRunDa" target="_blank"><button type="button" class="btn btn-default btn-sm">联系我们</button></a>
		</div>
		<div class="logoBar">
			<div class="logo">
				<a href="index.php"><img src="/Content/image/logo.png" alt="润达"></a>
			</div>
		</div>
	</div>
<!-- 顶部结束 -->
<!-- 主体 --><!-- 顶部结束 -->
<link href="/Content/style/home/layout_register.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
	<form class="form-horizontal" role="form" action="/index.php?controller=Home&method=registerProc" id="registerForm" method="post">
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">用户名</label>
			<div class="col-sm-3">
				<input type="text" id="userName" name="userName" class="form-control" placeholder="用户名" onblur="checkUserNmae()" />
			</div>
			<div id="userNameErr" class="col-sm-3 text-danger">
				<h2>*</h2>(字母或数字或_组成)
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
			<div class="col-sm-3">
				<input type="password" id="password" name="passWord" class="form-control" placeholder="密码" onblur="checkPassWord()" />
			</div>
			<div id="pwdErr" class="col-sm-3 text-danger">
				<h2>*</h2>(字母或数字或_组成,长度至少12位)
			</div>
		</div>

		<div class="form-group has-success">
			<label class="col-sm-2  control-label">确认密码</label>
			<div class="col-sm-3">
				<input type="password" id="password2" name="password2" class="form-control" placeholder="确认密码" onblur="checkPassWord2()" />
			</div>
			<div id="pwdErr2" class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>

		<div class="form-group has-success">
			<label class="col-sm-2  control-label">昵&nbsp;&nbsp;&nbsp;&nbsp;称</label>
			<div class="col-sm-3">
				<input type="text" name="nickName" class="form-control"
					placeholder="昵称" />
			</div>
			<div class="col-sm-3">
				(字母或数字或_组成)
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">性&nbsp;&nbsp;&nbsp;&nbsp;别</label>
			<div class="col-sm-3">
				<select name="sex" class="form-control">
					<option value="男">男</option>
				  	<option value="女">女</option>
				  	<option value="保密"selected>保密</option>
				</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">真实姓名</label>
			<div class="col-sm-3">
				<input type="text" name="realName" class="form-control"
					placeholder="真实姓名" />
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">电话号码</label>
			<div class="col-sm-3">
				<input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
					placeholder="电话号码" onblur="checkPhoneNumber()" />
			</div>
			<div id="phoneErr" class="col-sm-3 text-danger">
				<h2>*</h2>(11位手机号码)
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
			<div class="col-sm-3">
				<input type="text" id="email" name="email" class="form-control"
					placeholder="邮箱" onblur="checkEmail()" />
			</div>
			<div id="emailErr" class="col-sm-3 text-danger">
			</div>
			<div id="emailErr2" style="display:none" class="col-sm-6 text-info">
				<h4>邮箱已注册,<a href="index.php?controller=Home&method=login">现在登录?</a></h4>
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">省&nbsp;&nbsp;&nbsp;&nbsp;份</label>
			<div class="col-sm-3">
			<select id="privince" name="province" class="form-control" onchange="getCities()">
				<option value="a">sa</option>
			</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">城&nbsp;&nbsp;&nbsp;&nbsp;市</label>
			<div class="col-sm-3">
			<select id="city" name="city" class="form-control" onchange="getCountries()">
				<option value="a">sa</option>
			</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">县/区</label>
			<div class="col-sm-3">
			<select id="country" name="country" class="form-control">
				<option value="a">sa</option>
			</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">详细地址</label>
			<div class="col-sm-3">
				<input type="text" id="detailAddress" name="detailAddress" class="form-control"
					placeholder="详细地址" onblur="checkAddr()" />
			</div>
			<div id="addErr" class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">验证码</label>
			<div class="col-sm-3">
				<input type="text" id="checkCode" name="checkCode" class="form-control" placeholder="验证码" onblur="checkCheckcode()" />
			</div>
			<div id="checkErr" class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group">
		     <label class="col-sm-2  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			 <div class="col-sm-8">
			 <img id="validcode" src="/index.php?controller=Home&method=getCode" />&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript:document.getElementById('validcode').src='index.php?controller=Home&method=getCode&'+Math.random()">换1张</a>
			 </div>
		</div>
		<div class="form-group">
	        <label class="col-sm-2  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<div class="col-sm-6">
		        <input type="checkbox" id="agreeProtocol" name="agreeProtocol" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;同意<a href="/index.php?controller=RunDa&method=rundaUserRigisterProtoclol" target="_blank">《润达智能送水用户注册协议》</a>
	        </div>
		</div>
		<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn btn-success" type="submit" id="register" name="register"><span id="register_stat">&nbsp;注&nbsp;册&nbsp;</span></button>
				</div>
		</div>
	</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<!-- 主体结束 -->
<!-- 底部 -->
<div class="footer">
	<p>
		<a href="index.php?controller=RunDa&method=aboutRunDa">润达简介&nbsp;&nbsp;</a>
		<span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
		<a href="index.php?controller=WaterStore&method=waterStoreEnter" target="_blank">水站入驻&nbsp;&nbsp;</a>
		<span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
		<a href="index.php?controller=RunDa&method=aboutRunDa">意见反馈&nbsp;&nbsp;</a>
		<span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
		<a href="index.php?controller=RunDa&method=connectToRunDa">联系我们&nbsp;&nbsp;</a>
		<span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>&nbsp;&nbsp;
		客服热线：400-567-1234
	</p>
	<p>
	技术支持&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
	<a href="http://v3.bootcss.com/">bootstrap</a>
	<a href="http://easyicon.net/">easyicon</a>
	<a href="http://jquery.com/">jquery</a>
	</p>
	<p>Copyright &copy; 2013 - 2014 润达版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
	<div class="web">
		<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
		<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
		<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
		<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
	</div>
</div>
<script src="/Content/javascript/jquery/jquery.min.js"></script>
<script src="/Content/javascript/bootstrap/js/bootstrap.min.js"></script>
</body>
</html><!-- 省市联动 -->
<script src="/Content/javascript/js/home/register_provinces_cities_counties.js"></script>
<!-- 表单验证 -->
<script src="/Content/javascript/js/home/resgiter_valide.js"></script>