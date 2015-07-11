<?php


define("DOC_PATH_ROOT",$_SERVER['DOCUMENT_ROOT']);
// require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
// require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入发邮件文件
require_once(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");


$swiftMailer = new SwiftMailer();
// sendMail($to,$name,$subject,$body);
// $email = $_POST['email'];
$userName = "122";
$email = "1220938329@qq.com";
$subject = "恭喜您,注册成功";
$body = "您好,恭喜您注册成功,您的用户名是:".$userName.",您可以点击网站上的'联系我们'向我们提出您的宝贵意见。感谢您的注册，您的支持将是我们进步的最大的动力!";
$result = $swiftMailer ->sendMail($email,"",$subject,$body);