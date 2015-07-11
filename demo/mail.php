<?php
require_once '/Lib/ORG/swiftmailer-master/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance("smtp.sina.com",25);
$transport ->setUsername('xiaopxp@sina.com');
$transport ->setPassword('xiaosong79');
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance();
$message ->setFrom(array("xiaopxp@sina.com"=>'ifxs'));
$message ->setTo(array('1220938329@qq.com'=>'xiaopxp'));
$message ->setSubject("哈哈，我成功了！");
$message ->setBody("我成功了，很好很好很好，哈哈哈哈哈","text/html","utf-8");
try{
	$mailer ->send($message);
}catch(Swift_ConnectionException $e){
	echo $e ->getMessage();
}
echo 'ok';