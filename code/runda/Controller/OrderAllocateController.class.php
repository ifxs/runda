<?php

//引入模型文件
require(DOC_PATH_ROOT."/Model/EntityModel/orderdetail.class.php");
require(DOC_PATH_ROOT."/Model/EntityModel/waterbearer.class.php");

class OrderAllocateController{
	/*
	 *为已付款的订单分配送水工
	 */
	public function allocateWaterBearer(){
		//1获取所有未分配的订单  
		//*  返回：waterStoreID,recieverAddress,recieverTime
		$noAllocateOrders = OrderDetail::getNoAllocateOrder();
		//---------------------------------------------------
			// echo "<pre>";
			// print_r($noAllocateOrders); //---->
			// Array
			// 	(
			// 	    [0] => Array
			// 	        (
			// 	            [id] => 10
			// 	            [waterStoreID] => 10004
			// 	            [recieverAddress] => 鍖椾含甯傚寳浜競涓滃煄鍖烘晠浜嬪彂鐢熺殑
			// 	            [recieverTime] => 2015-05-28 1:00
			// 	        )

			// 	    [1] => Array
			// 	        (
			// 	            [id] => 11
			// 	            [waterStoreID] => 10002
			// 	            [recieverAddress] => 涓婃捣甯備笂娴峰競铏瑰彛鍖烘棤娉曟棤娉曞垹鎺�
			// 	            [recieverTime] => 2015-05-18 10:00
			// 	        )
			// 	)
		//2使用循环为每一个未分配的订单分配送水工
		foreach ($noAllocateOrders as $key => $value) {
			//1先查询水站的正常工作的(待分配订单，待出发)送水工
			$waterBearers = WaterBearer::getFreeWaterBearerByWaterStoreID($value['waterStoreID']);
			//-------------------------------------------------
				// echo "<pre>";
				// print_r($waterBearers);  //--->
				// Array
					// (
					//     [0] => Array
					//         (
					//             [id] => 1
					//             [userId] => 10014
					//             [maxLoadCapacity] => 4
					//         )

					// )
			if($waterBearers != null){
				//2采用一系列复杂的算法，最终将送水工和订单绑定
				//--------可能要使用  recieverAddress  recieverTime
				//--------
				//--------
				//--------
				//-------- 
				//-------- 

				/* 临时取第一个 测试用 */
				$allocatedWaterBearerID = $waterBearers[0]['userId'];

				OrderDetail::allocatedWaterBeare($value['id'],$allocatedWaterBearerID);
				//-------- 
				//-------- 
				//-------- 
				//-------- 
			}else{
				//没有空闲的送水工 分配失败
			}
		}
	}
}