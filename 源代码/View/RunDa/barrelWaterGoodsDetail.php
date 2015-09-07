<!-- 顶部 -->
<?php
	$title = '桶装水详情 '.$barrelWaterGoodsResult['waterGoodsName'].' --润达送水 润你生活';
	// $title = "桶装水详情----润达送水 润你生活";  barrelWatetGoodsPhotosResult
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/runda/layout_barrelwatergoodsdetail.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<!-- 桶装水图片展示，价格，销量的属性框 -->
	<div class="photo_params">
		<!-- 左边图片 -->
		<div class="photo">
				<div class="v_out v_out_p">
					<div class="v_show">
						<div class="v_cont">
						<ul>
							<?php
								if($barrelWatetGoodsPhotosResult != null){
									for($i = 0;$i < count($barrelWatetGoodsPhotosResult);$i++) {
										$imageSrc = "/".substr($barrelWatetGoodsPhotosResult[$i]['waterGoodsPhotoPath'],strrpos($barrelWatetGoodsPhotosResult[$i]['waterGoodsPhotoPath'],"Content"));
										echo '<li index="'.$i.'"><img src="'.$imageSrc.'" /></li>';
									}
								}
							?>
						<!-- 	<li index="0"></li>
							<li index="1"></li>
							<li index="2" style="background:#f0f"></li>
							<li index="3" style="background:#999"></li>
							<li index="4" style="background:#666"></li> -->
						</ul>
						</div>
					</div>
						<ul class="circle">
							<?php
								if($barrelWatetGoodsPhotosResult != null){
									for($i = 0;$i < count($barrelWatetGoodsPhotosResult);$i++) {
										if($i == 0){
											echo '<li class="circle-cur"></li>';
										}else{
											echo '<li></li>';
										}
										if(($i+1) % 3 == 0){
											echo '<br />';
										}
									}
								}
							?>
							<!-- <li class="circle-cur"></li>
							<li></li>
							<li></li>
							<br />
							<br />
							<li></li>
							<li></li> -->
						</ul>
					</div>
		</div>
		<!-- 右边参数 -->
		<div class="params">
			<br />
			桶装水名称:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['waterGoodsName']; ?><br /><hr />
			上架时间:&nbsp;&nbsp;&nbsp;<?php echo date("Y-m-d H:i:s",$barrelWaterGoodsResult['groundingDate']); ?><br /><hr />
			库存:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['waterGoodsInventory']; ?><br /><hr />
			销量:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['salesVolume']; ?><br /><hr />
			桶装水价格:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['waterGoodsPrice']; ?><br /><hr />
			<br />
			<br />
			<p>
	        	<button class="btn btn-danger" role="button" onclick="addCartFun(<?php echo $barrelWaterGoodsResult['id']; ?>);">加购物车</button>
	        	<button class="btn btn-danger" role="button">加收藏&nbsp;&nbsp;<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></button>
	        	<!-- <button class="btn btn-danger" role="button">已收藏&nbsp;&nbsp;<span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button> -->
        	</p>
		</div>
	</di>
<!-- 桶装水图片展示，价格，销量的属性框 结束-->
<!-- 中下部的选项卡 -->
	<div class="descript_comments_afterSS">
		<div role="tabpanel">

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#waterGoodsDescript" aria-controls="waterGoodsDescript" role="tab" data-toggle="tab">桶装水介绍</a></li>
		    <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">桶装水评价(<?php echo count($barrelWaterGoodsCommentsResult); ?>)</a></li>
		    <li role="presentation"><a href="#afterSaleService" aria-controls="afterSaleService" role="tab" data-toggle="tab">售货保障</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="waterGoodsDescript">
		    		<?php
		    			echo $barrelWaterGoodsResult['waterGoodsDescript']; 

		    		?>
		    </div>

		    <div role="tabpanel" class="tab-pane" id="comments">
		    	<?php
		    		if($barrelWaterGoodsCommentsResult != null){
		    			foreach ($barrelWaterGoodsCommentsResult as $key => $value) {
		    				echo $value['CommentContent'].$value['CommentTime'].$value['userID'].$value['agreeCount'].$value['againstCount'].'<hr />';
		    			}

		    		}
		    	?>


		    	<hr />
		    		挺好用，物流速度快！ 　2015-04-28 20:21
 
							颜色：金色
							型号：10400毫安
							j***b
							铜牌会员
							2014-12-26 23:47 购买
							来自京东Android客户端
							回复（0） 赞（0）
							不怎好充电老充不满不知什么原因 　2015-04-28 20:21
							<br />
							颜色：金色
							型号：10400毫安
							j***a
							铜牌会员 江苏
							2015-01-23 22:16 购买
							来自京东Android客户端
							回复（0） 赞（0）
							作为一个米粉，没有挑剔！ 　2015-04-28 20:20
							 <br />
							颜色：红色
							型号：10400毫安
							9***7
							铜牌会员
							2015-04-27 19:43 购买
							来自京东Android客户端
							回复（0） 赞（0）
							买的奖品还不错，应该是正品 　2015-04-28 20:19
							 <br />
							颜色：金色
							型号：10400毫安
							卷***娃
							银牌会员 重庆
							2015-01-15 22:38 购买
							来自京东iPhone客户端
							回复（0） 赞（0）
							速度还是那样的快，京东买电子产品就是放心 　2015-04-28 20:19
							 <br />
							颜色：金色
							型号：10400毫安
							j***刀
							银牌会员 北京
							2015-04-27 16:50 购买
							来自京东Android客户端
							回复（0） 赞（0）
							京东价格便宜，东西也是正品 　2015-04-28 20:19
							包装不错
							 <br />
							颜色：银色
							型号：10400毫安
							d***0
							钻石会员 北京
							2015-04-28 10:50 购买
							回复（0） 赞（0）
		    </div>

		    <div role="tabpanel" class="tab-pane" id="afterSaleService">
		    		本产品全国联保，享受三包服务，质保期为：一年质保
						您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......
						<br />
						品牌官方网站：http://www.xiaomi.com/
						售后服务电话：400-100-5678
						正品行货
						京东商城向您保证所售商品均为正品行货，京东自营商品开具机打发票或电子发票。
						全国联保
						凭质保证书及京东商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由京东联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。京东商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！ 
						<br />
						注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！
						无忧退换货
						客户购买京东自营商品7日内（含7日，自客户收到商品之日起计算），在保证商品完好的前提下，可无理由退货。（部分商品除外，详情请见各商品细则）<br />
		    </div>
		  </div>
		</div>
	</div>
<!-- 中下部的选项卡结束 -->
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<script src="/Content/javascript/js/runda/barrelwatergoodsdetail_photo_scale.js"></script>
<script src="Content/javascript/js/runda/common_addcart_ajax.js"></script>
