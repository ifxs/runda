<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<link href="/Content/style/admin/push/layout_send_push.css" rel="stylesheet">

<div class="body">
	<div class="broadcast_box">
		<h2>发广播推送</h2>
		<br />
		<form class="form-horizontal" id="sendBroadCastForm" role="form" method="post">
		<!-- <form class="form-horizontal" action="index.php?controller=Admin&method=sendBroadCastPush" id="sendBroadCastForm" role="form" method="post"> -->
			<div class="form-group has-success">
			<label class="col-sm-2  control-label">推送消息</label>
			<div class="col-sm-6">
			<textarea name="broadcastText" class="form-control" rows="3"></textarea>
			</div>
			<div class="col-sm-6">
				<div id="res" style="display:none" class="col-sm-10 text-danger">
				</div>
			</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn btn-success" type="submit">
					<span id="send_btn">&nbsp;发&nbsp;送&nbsp;</span>
					</button>
				</div>
			</div>
		</form>
	</div>
	<hr />
	<hr />
	<div class="pppcast_box">
		<h2>单发</h2>
	</div>
	<!-- <div class="broadcast_box"></div> -->
</div>
<!-- 主体结束 -->
<?php 
    include DOC_PATH_ROOT.'/View/Admin/footer_inner.php';
?>
<script src="/Content/javascript/js/admin/push/send_broadcast_ajax.js"></script>