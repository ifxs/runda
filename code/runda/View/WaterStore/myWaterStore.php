<!-- 顶部 -->
<?php
	$title = "我的水站--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
	// echo "<pre>";
	// print_r($waterStoreResult);
	// print_r($hottestBWGoods);
	// print_r($newestBWGoods);
	// print_r($waterStoreStatusArr);
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_mywaterstore.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">

<div class="head">
	<div class="logo_box">
		<?php
			$imageSrc = strstr($waterStoreResult['waterStoreImage'],"/Content");
		 	echo '<img src="'.$imageSrc.'" width="200px" height="200" />'; 
		 	echo $waterStoreResult['waterStoreName'];
		?>
	<div class="name_box">
	<?php
	 	echo $waterStoreResult['waterStoreName']; 
	?>
	</div>
	</div>
</div>
<!-- <div class="clear_float"></div> -->
<div class="left_box">
<?php
echo "<pre>";
print_r($newestBWGoods);
?>
</div>
<div class="right_box">
<?php
echo "<pre>";
print_r($waterStoreResult);
?>
	sdfdsfdsright_box
</div>
<div class="clear_float"></div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>