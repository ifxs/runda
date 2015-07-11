<?php


class ExtensionFunctionsController{
	//发邮件

	//发短信

	//发推送
	/*
	 *广播
	 */
	public function sendBroadcastNotification(){
		include DOC_PATH_ROOT."/Lib/Push/push.jpush.func.php";
	}
	/*
	 *单点发送
	 */
	public function sendBroadcastNotification1(){
		include DOC_PATH_ROOT."/Lib/Push/push.jpush.func.php";
	}
	/*
	 *多点发送
	 */
	public function sendBroadcastNotification2(){
		include DOC_PATH_ROOT."/Lib/Push/push.jpush.func.php";
	}
}