<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>xx</title>
<body>
<?php

	$p0 = fopen("./data/0.txt","a"); // 主纪录
	$p1 = fopen("./data/1.txt","a"); //basicParam
	$p2 = fopen("./data/2.txt","a"); //printPreform
	$p3 = fopen("./data/3.txt","a"); //mediumStandard
	$p4 = fopen("./data/4.txt","a"); //consumable
	$p5 = fopen("./data/5.txt","a"); //otherParam
	$p6 = fopen("./data/6.txt","a"); //accessory
//------------------------------------------------------------

	//打印机的id
	$pid = 0;
	//读一行
	//$line = fgets($fd);
	$line = "激光打印机|惠普|HP 1020plus|http://detail.zol.com.cn/105/104284/param.shtml";
	//拆分
	$arr = explode("|",$line);

	//插入主纪录
	$sql = "insert into printer (id,category,name,band,model,basicParam,printPreform,mediumStandard,consumable,otherParam,accessory,guarantee) values({$pid},0,'{$arr[0]}','{$arr[1]}','{$arr[2]}',{$pid},{$pid},{$pid},{$pid},{$pid},{$pid},{$pid})\r\n";
	fwrite($p0, $sql);

	//由url取网页
	$wbCon = file_get_contents($arr[3]);
	//按table拆分
	$tabArr = explode("<table>",$wbCon);

//-------1基本参数--------------------------------------------------------
	//1 基本参数
	$arr01 = explode("<td>",$tabArr[1]);
	$arr011 = explode("<li>",$arr01[1]);
	$count = count($arr011);
	$sql1 = "insert into basicParam (pID,productType,productPositioning,maximumPrintFormat,highestResolution,blackWhitePrintSpeed,processor,memory,networkPrint,doubleSidedPrinting) values({$pid},";
	for($f=1;$f<$count;$f++){
			//产品类型  $arr011[1]
			$arr0111 = explode("span>",$arr011[$f]);
			// echo "<pre>";
			// print_r($arr0111);
			$reg = "/>.*</";
			//只要 0 和 1
			// for($i=0;$i<2;$i++){
			// 	if(preg_match($reg,$arr0111[$i],$arrC)){
			// 		echo "<pre>";
			// 		print_r($arrC);
			// 	}
			// // 	Array
			// // 		(
			// //    	 [0] => >产品类型<
			// // 		)
			// // Array
			// // 		(
			// //     [0] => >黑白激光打印机<
			// //      )
			// }

			if(preg_match($reg,$arr0111[1],$arrC)){
					// echo "<pre>";
					// echo $arrC[0];
					// 编号 产品类型 产品定位 最大打印幅面 
					// 最高分辨率 黑白打印速度 处理器 内存 络打印 双面打印
					// $sql = "insert into basicParam({$first},)";
					if($f == $count-1){
						$sql1 .= $arrC[0];
					}else{
						$sql1 .= $arrC[0].",";
					}
			}
	}
	fwrite($p1, $sql1.")\r\n");
//-------2打印性能--------------------------------------------------------
	//2 打印性能
	$arr02 = explode("<td>",$tabArr[2]);
	$arr021 = explode("<li>",$arr02[1]);
	$count2 = count($arr021);
	$sql2 = "insert into printPreform (pID,preheatingTime,firstPrintTime,monthlyPrintLoad,interfaceType) values({$pid},";
	for($f=1;$f<$count2;$f++){
		$arr0211 = explode("span>",$arr021[$f]);
		$reg = "/>.*</";

		if(preg_match($reg,$arr0211[1],$arrC)){
			// $sql2 .= $arrC[0].",";
			if($f == $count2-1){
						$sql2 .= $arrC[0];
					}else{
						$sql2 .= $arrC[0].",";
					}
		}
	}
	fwrite($p2, $sql2.")\r\n");
//-------3介质规格--------------------------------------------------------
	//3 介质规格
	$arr03 = explode("<td>",$tabArr[3]);
	$arr031 = explode("<li>",$arr03[1]);
	$count3 = count($arr031);
	$sql3 = "insert into mediumStandard (pID,mediaType,mediumSize,mediumWeight,inputTrayCapacity,outputCapacity) values({$pid},";
	for($f=1;$f<$count3;$f++){
		$arr0311 = explode("span>",$arr031[$f]);
		$reg = "/>.*</";
		if(preg_match($reg,$arr0311[1],$arrC)){
			// $sql3 .= $arrC[0].",";
			if($f == $count3-1){
						$sql3 .= $arrC[0];
					}else{
						$sql3 .= $arrC[0].",";
					}
		}
	}
	fwrite($p3, $sql3.")\r\n");
//-------4耗材--------------------------------------------------------
	//4 耗材
	$arr04 = explode("<td>",$tabArr[4]);
	$arr041 = explode("<li>",$arr04[1]);
	$count4 = count($arr041);
	$sql4 = "insert into consumable (pID,suppliestype,tonerCartridges,cartridgeLife) values({$pid},";
	for($f=1;$f<$count4;$f++){
		$arr0411 = explode("span>",$arr041[$f]);
		$reg = "/>.*</";
		if(preg_match($reg,$arr0411[1],$arrC)){
			// $sql4 .= $arrC[0].",";
			if($f == $count4-1){
						$sql4 .= $arrC[0];
					}else{
						$sql4 .= $arrC[0].",";
					}
		}
	}
	fwrite($p4, $sql4.")\r\n");
//-------5其它参数--------------------------------------------------------
	//5 其它参数
	$arr05 = explode("<td>",$tabArr[5]);
	$arr051 = explode("<li>",$arr05[1]);
	$count5 = count($arr051);
	$sql5 = "insert into otherParam (pID,productSize,productWeight,systemPlatform,powerVoltage,environmentalParameters,listingDate) values({$pid},";
	for($f=1;$f<$count5;$f++){
		$arr0511 = explode("span>",$arr051[$f]);
		$reg = "/>.*</";
		if(preg_match($reg,$arr0511[1],$arrC)){
			// $sql5 .= $arrC[0].",";
			if($f == $count5-1){
						$sql5 .= $arrC[0];
					}else{
						$sql5 .= $arrC[0].",";
					}
		}
	}
	fwrite($p5, $sql5.")\r\n");
//-------6激光打印机附件--------------------------------------------------------
	//6 激光打印机附件
	$arr06 = explode("<td>",$tabArr[6]);
	$arr061 = explode("<li>",$arr06[1]);
	$count6 = count($arr061);
	$sql6 = "insert into accessory (pID,packingList) values({$pid},";



	// for($f=1;$f<$count6;$f++){
	// 	$arr0611 = explode("span>",$arr061[$f]);
	// 	$reg = "/>.*</";
	// 	if(preg_match($reg,$arr0611[1],$arrC)){
	// 		// $sql6 .= $arrC[0].",";
	// 		if($f == $count6-1){
	// 					$sql6 .= $arrC[0];
	// 				}else{
	// 					$sql6 .= $arrC[0].",";
	// 				}
	// 	}
	// }

	$count61 =0;
	for($f=1;$f<$count6;$f++){
		$arr0611 = explode("span>",$arr061[$f]);
		$count61 = count($arr0611);
		for($g=1;$g<$count6;$g++){
			$arr06111 = explode("br",$arr0611[$g]);
			$count611 = count($arr06111);
			for($h=0;$h<$count611;$h++){
				if($h == $count611-1){
					$sql6 = $sql6.$arr06111[$h].")<br />";
				}else{
					$sql6 .= $arr06111[$h].",";
				}
			}
		}
	}


	fwrite($p6, $sql6.")\r\n");
// echo $sql.")<br />";
// echo $sql1.")<br />";
// echo $sql2.")<br />";
// echo $sql3.")<br />";
// echo $sql4.")<br />";
// echo $sql5.")<br />";
// echo $sql6.")<br />";
?>

</body>
</html>