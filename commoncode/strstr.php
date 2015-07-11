<?php

	$imageSrc = strstr($goods['waterGoodsDefaultImage'],"/Content");


	$logInfo = date("Y-m-d H:i:s")." ->系统已为您分配送水工:xxxxx<br />";
		$sql = "update orderDetail set waterBearerID=?,orderStatue=3,
		logisticeInformation=concat(orderDetail.logisticeInformation,{$logInfo})
		 where id=?";
