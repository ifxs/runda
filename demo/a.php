<?php


define("DOC_PATH_ROOT",$_SERVER['DOCUMENT_ROOT']);
// require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
// require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入发邮件文件
// require_once(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");


require_once(DOC_PATH_ROOT."/Lib/SendSMS/sendsms.juhe.func.php");





// $sql ="select * from waterStore where owner=10000";
// $res = DBActive::executeQuery($sql);
// var_dump($res);

// $sql = "insert into barrelWaterGoods(waterStoreID,waterCate,waterBrand,waterGoodsName,waterGoodsDescript,waterGoodsPrice,waterGoodsInventory,isGrounding) values(?,?,?,?,?,?,?,?);";
// 		try{
// 			$rowCount = DBActive::executeNoQuery($sql,array(10009,0,0,"aaaaaaaa","bbbb",22.0,33,0));
// 			$sql2 = "select LAST_INSERT_ID() lastID;";
// 			$res = DBActive::executeQuery($sql2);
// 			print_r($res);
// 			echo $res[0]['lastID'];
// 			// return array("code"=>"200","id"=>$res);
// 		}catch(PDOException $e){
// 			// return array("code"=>"400");
// 			// return array("code"=>
// 			echo $e ->getMessage();
// 		}

// $sql = "insert into barrelWaterGoodsPhotos(waterGoodsID,waterGoodsPhotoPath) values(?,?);";
// 			try{
// 				$rowCount = DBActive::executeNoQuery($sql,array($res[0]['lastID'],"waterGoodsPhotoPath"));
// 				return "1";
// 			}catch(PDOException $e){
// 				return "0";
// 			}

// try{
// 	    				$swiftMailer = new SwiftMailer();
// 	    				// sendMail($to,$name,$subject,$body);
// 	    				$email = "1220938329@qq.com";
// 	    				$subject = "恭喜您,注册成功";
// 	    				$body = "您好,恭喜您注册成功,您的用户名是:,您可以点击网站上的'联系我们'向我们提出您的宝贵意见。感谢您的注册，您的支持将是我们进步的最大的动力!";
// 	    				$result = $swiftMailer ->sendMail($email,"",$subject,$body);
// 	    				//--------------------------------------
//     }catch(PDOException $e){}
	// $swiftMailer = new SwiftMailer();
	// // sendMail($to,$name,$subject,$body);
	// $email = "1220938329@qq.com";
	// $subject = "恭喜您,注册成功";
	// $body = "您好,恭喜您注册成功,您的用户名是:,您可以点击网站上的'联系我们'向我们提出您的宝贵意见。感谢您的注册，您的支持将是我们进步的最大的动力!";
	// $result = $swiftMailer ->sendMail($email,"",$subject,$body);









//----用户注册成功后，给他发短信
$sender = new SendSMSByJuHe();
$value = urlencode("#app#=润达智能送水&#username#=name");
// $params ='mobile=18585436821&tpl_id=2428&dtype=json&tpl_value='.$value.'&key=971865ab33edf77d679056fef50bfce1';
// echo $sender ->sendSMS("18585436821","2428",$value);
$res = $sender ->sendSMS("18585436821","2428",$value);
			    if($res == "404"){
			    	return Json::makeJson("400","phone number error");
			    }
			    if($res == "600"){
			    	return Json::makeJson("400","remote service error");
			    }
			    if($res == "500"){
			    	return Json::makeJson("400","local service error");
			    }
// echo $params;
