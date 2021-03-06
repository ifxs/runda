<?php

require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");

class OrderDetail{
//===================1用户=======================================
//---------------------------------------------------------------
//--------------下订单相关---------------------------------------
//---------------------------------------------------------------
	/* 第一步
	 * 生成订单 
	 *  ------------->要更新物流
	 *     生成订单id,添加所有者，所属水站，订单总价，订单分类，订单状态，订单提交时间，
	 */
	public function placeOrder($orderOwnerID,$waterStoreID){
		$orderSubmitTime = time();
		$logInfo = date("Y-m-d H:i:s").' ---> 订单创建成功,等待用户付款<br />';
		$sql = "insert into orderDetail (orderOwnerID,waterStoreID,logisticeInformation,orderSubmitTime) values(
			?,?,?,?)";
		$sql2 = "select LAST_INSERT_ID() last_id;";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderOwnerID,$waterStoreID,$logInfo,$orderSubmitTime));
			if($rowCount > 0){
				$lastID = DBActive::executeQuery($sql2);
				return array("code"=>"200","message"=>"下订单成功","data"=>$lastID[0]['last_id']);
			}else{
				return array("code"=>"400","message"=>"操作失败");
			}
		}catch(PDOException $e){
			return array("code"=>"500","message"=>"系统错误");
			// return array("code"=>"500","message"=>$e ->getMessage());
		}
	}
	/* 第二步
	 *添加订单总价格
	 */
	public function addTotalPriceForOrder($orderID,$TotalPrice){
		$sql = "update orderDetail set totalPrice=? where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($TotalPrice,$orderID));
			if($rowCount > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
	}
	/* 第三步
	 *  ------------->要更新物流
	 * 完成订单 ---》在线支付，货到付款
	 *添加收货人，收货人电话，收货时间，收货地址，结束发送，备注，修改订单状态
	 */
	public function settleOrder($orderID,$recieverPersonName,$recieverPersonPhone,$recieverAddress,$recieverTime,$remark,$settleMethod){
		$logInfo = date("Y-m-d H:i:s")." ---> 您已完成订单结算,等待系统为您分配送水工<br />";
		$sql = "update orderDetail set orderStatue=1,recieverPersonName=?,recieverPersonPhone=?,recieverAddress=?,recieverTime=?,remark=?,settleMethod=?,logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}') where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($recieverPersonName,$recieverPersonPhone,$recieverAddress,$recieverTime,$remark,$settleMethod,$orderID));
			if($rowCount > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
			// return $e->getMessage();
			// return $sql;
		}
	}
	/* 
	 *查询订单是否已经付款
	 */
	public function checkOrderForIsalreadyPay($orderID){
		$sql = "select orderStatue from orderDetail where id=?";
		try{
			$res = DBActive::executeQuery($sql,array($orderID));
			if($res != null){
				if($res[0]['orderStatue'] == 0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
	}

//---------------------------------------------------------------
//--------------操作订单相关 取消 删除---------------------------
//---------------------------------------------------------------
	/*
	 *取消订单
	 *    orderCancelReason orderCategory,orderStatue
	 */
	public function xxxx(){
		// $logInfo = date("Y-m-d H:i:s")." ---> 系统已为您分配送水工:xxxxx<br />";
		// logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}')
	}
	/*
	 *
	 *删除订单
	 */
	public function deleteOrder($orderid,$userid){
		$sql = "delete from orderDetail where orderOwnerID=? and (orderCategory=1 or orderStatue=0) and id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($userid,$orderid));
			if($rowCount > 0){
				return 1;
			}else{
				return 0;
			}
		}catch(PDOException $e){
			return 2;
		}
	}

//---------------------------------------------------------------
//--------------查看订单相关-------------------------------------
//---------------------------------------------------------------
	/*
	 *获取所有订单
	 */
	public function getAllOrder($userID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount;
	    try{
	        $result = DBActive::executeQuery($sql,array($userID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *获取已完成订单
	 */
	public function getDoneOrder($userID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderCategory=3 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($userID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *获取未完成订单
	 */
	public function getUnfinishedOrder($userID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderCategory=0 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($userID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *获取待付款订单
	 */
	public function getNonPaymentOrder($userID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime from orderDetail where orderOwnerID=? and orderStatue=0 order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($userID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *获取已取消订单
	 */
	public function getCanceleddOrder($userID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    // $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderCategory=1 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderCancelReason,orderSubmitTime from orderDetail where orderCategory=2 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($userID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *获取已失败订单
	 */
	public function getFaileddOrder($userID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderFailReason,orderSubmitTime from orderDetail where orderCategory=2 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($userID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//---------------------------------------------------------------
//--------------查询订单相关-------------------------------------
//---------------------------------------------------------------
	/*
	 *根据订单id查询订单详细
	 */
	public function getOrderDetailByOrderID($orderID){
		$sql = "select * from orderDetail where id=?";
	    try{
	        $result = DBActive::executeQuery($sql,array($orderID));
	        if($result != null){
	        	return $result[0];
	        }else{
	        	return null;
	        }
	    }catch(PDOException $e){
	        return null;
	    }
	}

//===================2订单分配送水工=============================
//---------------------------------------------------------------
//--------------订单相关 从分配送水工到配送完成------------------
//---------------------------------------------------------------
	/*
		*--1--分配送水工
		*--2--送水工出发
		*--3--更新物流信息
		*--4--订单配送完成
		*--5--订单整个完成
		*--6--订单配送失败
	*/

	/*
	 *查询未分配送水工的订单
	 */
	public static function getNoAllocateOrder(){
		$sql = "select id,waterStoreID,recieverAddress,recieverTime from orderDetail where orderStatue=1";
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$res = DBActive::executeQuery($sql);
			return $res;
		}catch(PDOException $e){
			return null;
		}
	}

	/*
	 *--1--分配送水工，设置送水工字段值,同时要更新订单状态,还要推送
	 *  ------------->要更新物流
	 *    waterBearerID
	 */
	public static function allocatedWaterBeare($orderID,$waterBearerID){
		// 1 更新 纪录，设置送水工字段值，并且更新订单状态
		$logInfo = date("Y-m-d H:i:s")." ---> 系统已为您分配送水工:xxxxx<br />";
		$sql = "update orderDetail set waterBearerID=?,orderStatue=3,logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}') where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($waterBearerID,$orderID));
			if($rowCount > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
		// 2 向用户推送通知其桶装水已被送水工承接
		// 3 向送水工发推送
		//。。。。。。。。。。。。。。
	}
	/*
	 *--2--送水工出发
	 *     更新订单状态 发推送
	 *			orderStatue = 4	订单配送中
	 */
	public static function waterBearerStart($orderID){
		$logInfo = date("Y-m-d H:i:s")." ---> 送水工已经出发,请您耐心等待<br />";
		$sql = "update orderDetail set orderStatue=4,logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}') where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderID));
			if($rowCount > 0){
				//向用户推送通知其桶装水已被送水工承接
				//。。。。。。。。。。。。。。
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
	}
	/*
	 *--3--更新物流信息
	 *			orderStatue = 4	订单配送中
	 *          logisticeInformation
	 */
	public static function refreshTheLogisticeInformation($orderID,$logisticeInformation){
		// 1 更新 纪录，设置送水工字段值，并且更新订单状态
		$sql = "update orderDetail set logisticeInformation=concat(orderDetail.logisticeInformation,'{$logisticeInformation}') where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderID));
			if($rowCount > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
	}
	/*
	 *--4--订单配送完成 
	 *	由送水工触发
	 */
	public static function orderDoneDispatching($orderID){
		$logInfo = date("Y-m-d H:i:s")." ---> 订单配送成功<br />";
		$sql = "update orderDetail set logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}'),orderStatue=6 where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderID));
			if($rowCount > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
	}
	/*
	 *
	 *--5--订单整个完成
	 *	由用户完成评价触发，或系统自动评价触发
	 *    orderDoneTime orderCategory,orderStatue
	 */
	public function orderDoneComment(){
		// $logInfo = date("Y-m-d H:i:s")." ---> 系统已为您分配送水工:xxxxx<br />";
		// logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}')
	}
	/*
	 *--6--订单配送失败
	 *    由送水工触发 原因多是送水失败了，故由送水工触发
	 *    orderFailReason orderCategory,orderStatue
	 */
	public static function orderDispatchingFailed($orderID,$orderFailReason){
		$logInfo = date("Y-m-d H:i:s")." ---> 订单配送失败,失败原因：{$orderFailReason}<br />";
		$sql = "update orderDetail set orderStatue=5,orderFailReason=?,logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}') where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderFailReason,$orderID));
			if($rowCount > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
		}
	}

//---------该删除的------------------------------
	// //---------------------------------------------------------------
	// //--------------操作订单相关 取消 删除---------------------------
	// //---------------------------------------------------------------
	// 	/*
	// 	 *取消订单
	// 	 *    orderCancelReason orderCategory,orderStatue
	// 	 */
	// 	public function xxxx(){
	// 		// $logInfo = date("Y-m-d H:i:s")." ---> 系统已为您分配送水工:xxxxx<br />";
	// 		// logisticeInformation=concat(orderDetail.logisticeInformation,'{$logInfo}')
	// 	}
	// 	/*
	// 	 *
	// 	 *删除订单
	// 	 */
	// 	public function deleteOrder($orderid,$userid){
	// 		$sql = "delete from orderDetail where orderOwnerID=? and (orderCategory=1 or orderStatue=0) and id=?";
	// 		try{
	// 			$rowCount = DBActive::executeNoQuery($sql,array($userid,$orderid));
	// 			if($rowCount > 0){
	// 				return 1;
	// 			}else{
	// 				return 0;
	// 			}
	// 		}catch(PDOException $e){
	// 			return 2;
	// 		}
	// 	}

	// //---------------------------------------------------------------
	// //--------------查看订单相关-------------------------------------
	// //---------------------------------------------------------------
	// 	/*
	// 	 *获取所有订单
	// 	 */
	// 	public function getAllOrder($userID,$currentPage,$singlePageRecordCount){
	// 		$begin = ($currentPage - 1) * $singlePageRecordCount;
	// 	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount;
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($userID));
	// 	        return $result;
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}
	// 	/*
	// 	 *获取已完成订单
	// 	 */
	// 	public function getDoneOrder($userID,$currentPage,$singlePageRecordCount){
	// 		$begin = ($currentPage - 1) * $singlePageRecordCount;
	// 	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderCategory=3 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($userID));
	// 	        return $result;
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}
	// 	/*
	// 	 *获取未完成订单
	// 	 */
	// 	public function getUnfinishedOrder($userID,$currentPage,$singlePageRecordCount){
	// 		$begin = ($currentPage - 1) * $singlePageRecordCount;
	// 	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderCategory=0 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($userID));
	// 	        return $result;
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}
	// 	/*
	// 	 *获取待付款订单
	// 	 */
	// 	public function getNonPaymentOrder($userID,$currentPage,$singlePageRecordCount){
	// 		$begin = ($currentPage - 1) * $singlePageRecordCount;
	// 	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime from orderDetail where orderOwnerID=? and orderStatue=0 order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($userID));
	// 	        return $result;
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}
	// 	/*
	// 	 *获取已取消订单
	// 	 */
	// 	public function getCanceleddOrder($userID,$currentPage,$singlePageRecordCount){
	// 		$begin = ($currentPage - 1) * $singlePageRecordCount;
	// 	    // $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime,orderDoneTime from orderDetail where orderCategory=1 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	// 	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderCancelReason,orderSubmitTime from orderDetail where orderCategory=2 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($userID));
	// 	        return $result;
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}
	// 	/*
	// 	 *获取已失败订单
	// 	 */
	// 	public function getFaileddOrder($userID,$currentPage,$singlePageRecordCount){
	// 		$begin = ($currentPage - 1) * $singlePageRecordCount;
	// 	    $sql = "select id,recieverTime,remark,totalPrice,settleMethod,orderFailReason,orderSubmitTime from orderDetail where orderCategory=2 and orderOwnerID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($userID));
	// 	        return $result;
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}

	// //---------------------------------------------------------------
	// //--------------查询订单相关-------------------------------------
	// //---------------------------------------------------------------
	// 	/*
	// 	 *根据订单id查询订单详细
	// 	 */
	// 	public function getOrderDetailByOrderID($orderID){
	// 		$sql = "select * from orderDetail where id=?";
	// 	    try{
	// 	        $result = DBActive::executeQuery($sql,array($orderID));
	// 	        if($result != null){
	// 	        	return $result[0];
	// 	        }else{
	// 	        	return null;
	// 	        }
	// 	    }catch(PDOException $e){
	// 	        return null;
	// 	    }
	// 	}

//===================3水站=======================================
//---------------------------------------------------------------
//--------------查询订单相关-------------------------------------
//---------------------------------------------------------------
	/*
	 *查询该水站的所有订单
	 */
	public function getAllOrderOfOneWaterStore($waterStoreID,$currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
		$sql ="select id,orderOwnerID,waterBearerID,recieverPersonName,recieverPersonPhone,recieverAddress,recieverTime,remark,totalPrice,settleMethod,orderStatue,orderSubmitTime from orderDetail where waterStoreID=? order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount;
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$res = DBActive::executeQuery($sql,array($waterStoreID));
			return $res;
		}catch(PDOException $e){
			return null;
		}
	}


//===================4管理员=======================================
//---------------------------------------------------------------
//--------------查询订单相关-------------------------------------
//---------------------------------------------------------------
	/*
	 *获取所有订单
	 */
	public function getTheAllOrders($currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select * from orderDetail order by orderSubmitTime desc limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql);
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}

}