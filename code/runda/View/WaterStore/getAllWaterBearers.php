<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
    <div>
	   <table class="table table-bordered table-hover">
	       <tr><td>送水工账号ID</td><td>最大载重量</td><td>状态</td><td>详细信息</td><td>修改信息</td></tr>
	       <?php
	       if($waterbearers != null){
	            foreach ($waterbearers as $key=>$value){
	               echo '<tr><td>'.$value['userId'].'</td><td>'.$value['maxLoadCapacity'].'</td><td>'.$waterBearerStatueArray[$value['statue']].'</td><td><a href="">查看</a></td><td><a href="">修改信息</a></td></tr>';
	            }
	       }
	       ?>
        </table>
	</div>
	<div>
	<?php
	    //分页导航栏 
	    echo $pageBar;
    ?>
	</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>