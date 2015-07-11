<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>xx</title>
<body>
<?php

	// 1基本参数
	// 2打印性能
	// 3介质规格
	// 4耗材
	// 5其它参数
	// 6激光打印机附件
	// 7保修信息


	$p1 = fopen("./data/1.txt","a"); // 主纪录
	$p2 = fopen("./data/2.txt","a"); //信息表，纵表
//------------------------------------------------------------
	//打印机的id
	// $pid = 0;
	$pid = $_POST['id'];
	//读一行
	//$line = fgets($fd);
	// $line = "激光打印机|惠普|HP 1020plus|http://detail.zol.com.cn/105/104284/param.shtml";
	$line = $_POST['url'];
	//拆分
	$arr = explode("|",$line);


	//插入主纪录
	$sql = "insert into Printers (ID,Category,Name,Brand,Model) values({$pid},0,'{$arr[0]}','{$arr[1]}','{$arr[2]}')\r\n";
	fwrite($p1, $sql);
	//由url取网页
	$wbCon = file_get_contents($arr[3]);
	//按table拆分
	$tabArr = explode("<table>",$wbCon);

	$tabCount = count($tabArr);
	for($t = 1 ; $t <$tabCount;$t++){
		$arr = explode("<td>",$tabArr[$t]);

		// $r = '/th>.*<\/th/';
		$r = '/>.*</';
		if(preg_match($r,$arr[0],$arrC)){
			$leftTag = explode(">",$arrC[0]);
			// echo "<pre>";
			// print_r($leftTag);
			$rightTag = explode("<",$leftTag[1]);
			echo $rightTag[0].'-------------';
			// if(preg_match("/基本.*/", $arrC[0])){
			// 	echo "--------------基本参数-------------";
			// }

			echo mb_strpos($rightTag[0],"基本");

			// echo similar_text("基本参数",$rightTag[0]);
			echo "<hr />";

			// if(strcmp("基本参数",$rightTag[0]) == 0){
			// 	echo "--------------基本参数-------------";
			// 	// one($tabArr[$t]);
			// }
		}
	}


//-------1基本参数  $tabArr[1]--------------------------------------------------------
function one($str){
	echo $str;
	exit(0);
	//1 基本参数
	// $arr01 = explode("<td>",$tabArr[1]);
	$arr01 = explode("<td>",$str);
	$arr011 = explode("<li>",$arr01[1]);
	$count = count($arr011);
	for($f=1;$f<$count;$f++){
			//产品类型  $arr011[1]
			$arr0111 = explode("span>",$arr011[$f]);
			$reg = "/>.*</";
			$sql1 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,1";
			//属性名称
			if(preg_match($reg,$arr0111[0],$arrC)){
				$sql1 .= ",'".$arrC[0]."'";				
			}
			//属性值
			if(preg_match($reg,$arr0111[1],$arrC)){
				$sql1 .= ",'".$arrC[0]."'";
			}
		//一个子属性就要写一次文件
		fwrite($p2, $sql1.")\r\n");
		// echo $sql1;
		// echo "<hr />";
	}
}
//-------2打印性能  $tabArr[2]--------------------------------------------------------
function two($str){
	//2 打印性能
	// $arr02 = explode("<td>",$tabArr[2]);
	$arr02 = explode("<td>",$str);
	$arr021 = explode("<li>",$arr02[1]);
	$count2 = count($arr021);

	for($f=1;$f<$count2;$f++){
		$arr0211 = explode("span>",$arr021[$f]);
		$reg = "/>.*</";

		$sql2 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,2";

		if(preg_match($reg,$arr0211[0],$arrC)){
			// $sql2 .= $arrC[0].",";
			$sql2 .= ",'".$arrC[0]."'";	
		}
		if(preg_match($reg,$arr0211[1],$arrC)){
			// $sql2 .= $arrC[0].",";
			$sql2 .= ",'".$arrC[0]."'";	
		}

		fwrite($p2, $sql2.")\r\n");
	}
}
//-------3介质规格  $tabArr[3]--------------------------------------------------------
function three($str){
	//3 介质规格
	$arr03 = explode("<td>",$tabArr[3]);
	$arr031 = explode("<li>",$arr03[1]);
	$count3 = count($arr031);
	
	for($f=1;$f<$count3;$f++){
	$sql3 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,3";
		$arr0311 = explode("span>",$arr031[$f]);

		$reg = "/>.*</";
		if(preg_match($reg,$arr0311[0],$arrC)){
			// $sql3 .= $arrC[0].",";
			$sql3 .= ",'".$arrC[0]."'";
		}
		if(preg_match($reg,$arr0311[1],$arrC)){
			// $sql3 .= $arrC[0].",";
			$sql3 .= ",'".$arrC[0]."'";
		}
		fwrite($p2, $sql3.")\r\n");
	}
}
//-------4耗材      $tabArr[4]--------------------------------------------------------
function four($str){
	//4 耗材
	$arr04 = explode("<td>",$tabArr[4]);
	$arr041 = explode("<li>",$arr04[1]);
	$count4 = count($arr041);
	
	for($f=1;$f<$count4;$f++){
	$sql4 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,4";
		$arr0411 = explode("span>",$arr041[$f]);
		$reg = "/>.*</";
		if(preg_match($reg,$arr0411[0],$arrC)){
			// $sql4 .= $arrC[0].",";
			$sql4 .= ",'".$arrC[0]."'";
		}
		if(preg_match($reg,$arr0411[1],$arrC)){
			// $sql4 .= $arrC[0].",";
			$sql4 .= ",'".$arrC[0]."'";
		}
		fwrite($p2, $sql4.")\r\n");
	}
}
//-------5其它参数  $tabArr[5]--------------------------------------------------------
function five($str){
	//5 其它参数
	$arr05 = explode("<td>",$tabArr[5]);
	$arr051 = explode("<li>",$arr05[1]);
	$count5 = count($arr051);

	for($f=1;$f<$count5;$f++){
	$sql5 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,5";
		$arr0511 = explode("span>",$arr051[$f]);
		$reg = "/>.*</";
		if(preg_match($reg,$arr0511[0],$arrC)){
			// $sql5 .= $arrC[0].",";
			$sql5 .= ",'".$arrC[0]."'";
		}
		if(preg_match($reg,$arr0511[1],$arrC)){
			// $sql5 .= $arrC[0].",";
			$sql5 .= ",'".$arrC[0]."'";
		}
		fwrite($p2, $sql5.")\r\n");
	}
}
//-------6印机附件  $tabArr[6]--------------------------------------------------------
function six($str){
	//6 打印机附件
	$arr06 = explode("<td>",$tabArr[6]);
	$arr061 = explode("<li>",$arr06[1]);
	$count6 = count($arr061);
	for($f=1;$f<$count6;$f++){
	$sql6 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,6";
		$arr0611 = explode("span>",$arr061[$f]);
		$reg = "/>.*</";
		//属性名称
		if(preg_match($reg,$arr0611[0],$arrC)){
			$sql6 .= ",'".$arrC[0]."'";				
		}
		//获取属性值
		$arr0611[1]= str_replace(array("\r\n", "\r", "\n"), "", $arr0611[1]);
		$sql6 .= ",'".$arr0611[1]."'";
		fwrite($p2, $sql6.")\r\n");
	}
}
//-------7保修信息  $tabArr[7]--------------------------------------------------------
function seven($str){
	//7 保修信息
	$arr07 = explode("<td>",$tabArr[7]);

	//还要对$arr07[1]处理
	$arr0771 = explode("<tr>",$arr07[1]);
		// echo "<pre>";
		// print_r($arr0771);
		// exit(0);

	$arr071 = explode("<li>",$arr0771[0]);
	$count7 = count($arr071);


	// echo $count7;
	// echo "<hr />";

	for($f=1;$f<$count7;$f++){
		$sql7 = "insert into Printer_Informations (PrinterMacID,ParentAttributeID,AttributeName,AttributeValue) values($pid,7";
		
		$arr0711 = explode("span>",$arr071[$f]);


		$reg = "/>.*</";
		if(preg_match($reg,$arr0711[0],$arrC)){
			// $sql5 .= $arrC[0].",";
			$sql7 .= ",'".$arrC[0]."'";
		}
		if(preg_match($reg,$arr0711[1],$arrC)){
			// $sql5 .= $arrC[0].",";
			$sql7 .= ",'".$arrC[0]."'";
		}
		fwrite($p2, $sql7.")\r\n");
		// echo $sql7;
		// echo "<hr />";
	}
}
//写保修信息
// fwrite($p2, "insert into information (printMacID,parentAttributeID,attributeName,attributeValue) values($pid,7,'保修信息','{$arr[1]}'))\r\n");
// echo $sql.")<br />";
// echo $sql1.")<br />";
// echo $sql2.")<br />";
// echo $sql3.")<br />";
// echo $sql4.")<br />";
// echo $sql5.")<br />";
// echo $sql6.")<br />";



	$fn = "./printer.txt";
	$f= fopen($fn, "r");
	$line2 = fgets($f);
	ob_start();
	fpassthru($f);
	fclose($f);
	file_put_contents($fn, ob_get_clean());
	echo '<form method="post" action="fetch.php"><input type="text" name="id" value="'.($pid+1).'" />';
	echo '<input type="text" name="url"  value="'.$line2.'" /><input type="submit" name="ok" /></form>';



?>

</body>
</html>