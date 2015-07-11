<?php
define("DOC_PATH_ROOT",$_SERVER['DOCUMENT_ROOT']);
include DOC_PATH_ROOT."/Lib/Push/push.jpush.func.php";
echo PushWithJpush::sendNotification("0","推送测试");




























// require_once $_SERVER['DOCUMENT_ROOT'].'/Lib/JPush/vendor/autoload.php';

// use JPush\Model as M;
// use JPush\JPushClient;
// use JPush\Exception\APIConnectionException;
// use JPush\Exception\APIRequestException;


// $app_key = "9b89bd0e39491ffb67ab59c3";
// $master_secret = "dd558bb5727b9d76e1f80c08";
// $br = '<br/>';
// date_default_timezone_set("PRC");
// $client = new JPushClient($app_key, $master_secret);

// $result = $client->push()
//     ->setPlatform(M\all)
//     ->setAudience(M\all)
//     ->setNotification(M\notification('Hi, JPush2'))
//     ->setMessage(M\message('Message Content', 'Message Title', 'Message Type', array("key1"=>"value1", "key2"=>"value2")))
//     ->printJSON()
//     ->send();
// echo 'Push Success.' . $br;
// echo 'sendno : ' . $result->sendno . $br;
// echo 'msg_id : ' .$result->msg_id . $br;
// echo 'Response JSON : ' . $result->json . $br;