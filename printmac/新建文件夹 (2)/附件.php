<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>xx</title>
<body>
<?php
	$pid = 0;
	// $line = "激光打印机|惠普|HP 1020plus|http://detail.zol.com.cn/105/104284/param.shtml";
	$line = "激光打印机|惠普|HP 1020plus|http://detail.zol.com.cn/292/291706/param.shtml";
	//拆分
	$arr = explode("|",$line);
	//由url取网页
	$wbCon = file_get_contents($arr[3]);
	//按table拆分
	$tabArr = explode("<table>",$wbCon);
//-------6激光打印机附件--------------------------------------------------------
	//6 激光打印机附件
	$arr06 = explode("<td>",$tabArr[6]);

	// echo "<pre>";
	// print_r($arr06);
	// exit(0);

	$arr061 = explode("<li>",$arr06[1]);
	$count6 = count($arr061);

	// echo "<pre>";
	// print_r($arr061);
	// exit(0);

	$sql6 = "insert into accessory (pID,packingList) values({$pid},";

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


			// echo "<pre>";
			// print_r($arr06111);
		}
		// echo "<hr /><hr />";
	// exit(0);


		// $reg = "/>.*</";
		// if(preg_match($reg,$arr0611[1],$arrC)){
		// 	echo "<pre>";
		// 	print_r($arrC);
		// 	exit(0);



		// 	// $sql6 .= $arrC[0].",";
		// 	foreach ($arrC as $key => $value) {
		// 		if($f == $count6-1){
		// 			$sql6 .= $arrC[0];
		// 		}else{
		// 			$sql6 .= $arrC[0].",";
		// 		}
		// 	}
		// }
			
	}
	// fwrite($p6, $sql6.")\r\n");
echo $sql6.")<br />";
?>

</body>
</html>