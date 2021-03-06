<?php

//引入模型文件
require(DOC_PATH_ROOT."/Model/EntityModel/orderdetail.class.php");
require(DOC_PATH_ROOT."/Model/EntityModel/waterbearer.class.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class WaterBearerController{

//-----------------------------------------------------------------
//------------订单相关---------------------------------------------
//-----------------------------------------------------------------
	/*
	 *--1--送水工出发
	 *			orderStatue = 4	订单配送中
	 *			waterBearer.statue = 1	更改送水工的工作状态为忙碌中
	 */
	public function waterBearerStart(){
		if(isset($_GET['orderid']) && $_GET['orderid'] != '' && isset($_GET['waterbearerid']) && $_GET['waterbearerid'] != ''){
			OrderDetail::waterBearerStart($_GET['orderid']);
			$res = WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],1);
			if($res){
				echo Json::makeJson("200","操作成功");
			}else{
				echo Json::makeJson("500","操作失败");
			}
		}else{
			//请求错误
			echo Json::makeJson("400","请求错误");
		}
	}
	/*
	 *--2--更新物流信息
	 *			orderStatue = 4	订单配送中
	 *          logisticeInformation
	 */
	public function refreshTheLogisticeInformation(){
		if(isset($_GET['logisticeinfo']) && $_GET['logisticeinfo'] != '' && isset($_GET['orderid']) && $_GET['orderid'] != ''){
			// $logisticeInformation = $_GET['logisticeinfo'];
			$res = OrderDetail::refreshTheLogisticeInformation($_GET['orderid'],$_GET['logisticeinfo']);
			if($res){
				echo Json::makeJson("200","更新成功");
			}else{
				echo Json::makeJson("500","更新失败");
			}
		}else{
			echo Json::makeJson("400","请求错误");
			//请求错误
		}
	}
	/*
	 *--3--订单配送完成 
	 *	由送水工触发
	 */
	public function orderDoneDispatching(){
		if(isset($_GET['orderid']) && $_GET['orderid'] != ''){
			$res = OrderDetail::orderDoneDispatching($_GET['orderid']);
			if($res){
				echo Json::makeJson("200","操作成功");
			}else{
				echo Json::makeJson("500","操作失败");
			}
		}else{
			//请求错误
			echo Json::makeJson("400","请求错误");
		}
		// 待定：WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],1);
	}
	/*
	 *--4--订单配送失败
	 *   要求送水工说明原因
	 *    orderFailReason orderCategory,orderStatue
	 */
	public function orderDispatchingFailed(){
		if(isset($_GET['orderid']) && $_GET['orderid'] != '' && isset($_GET['failreason'])){
			$res = OrderDetail::orderDispatchingFailed($_GET['orderid'],$_GET['failreason']);
			if($res){
				echo Json::makeJson("200","操作成功");
			}else{
				echo Json::makeJson("500","操作失败");
			}
		}else{
			//请求错误
			echo Json::makeJson("400","请求错误");
		}
		// 待定：WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],1);
	}

//-----------------------------------------------------------------
//------------送水工位置-------------------------------------------
//-----------------------------------------------------------------
	/*
	 *送水工实时上传地理位置
	 */
	public function uploadWaterBearerRealTimeLocation(){
		//时间
		//经度
		//纬度
	}
//-----------------------------------------------------------------
//------------送水工工作状态-------------------------------------------
//-----------------------------------------------------------------
	// 0	正常工作---待分配订单，待出发
	// 1	忙碌中-----已分配订单，并且正在送水过程中
	// 2	休息中-----下班了
	public function refreshWaterBearerStatue(){
		if(isset($_GET['waterbearerid']) && $_GET['waterbearerid'] != '' && isset($_GET['statue'])){
			$res = WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],$_GET['statue']);
			if($res){
				echo Json::makeJson("200","更新失败");
			}else{
				echo Json::makeJson("500","更新失败");
			}
		}else{
			echo Json::makeJson("400","操作失败");
		}
	}
}