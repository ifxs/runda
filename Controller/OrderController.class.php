 <?php

require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
//引入订单模型文件
require(DOC_PATH_ROOT."/Model/EntityModel/orderdetail.class.php");
//引入订单包含桶装水模型文件
require(DOC_PATH_ROOT."/Model/EntityModel/ordercontaingoods.class.php");
//引入Json支持文件
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class OrderController{
//----------------------------------------------------------------
//------------下订单----------------------------------------------
//----------------------------------------------------------------
	/*
	 *下订单处理
	 */
	function placeOrder(){
		if(isset($_POST['waterGoodsID']) && isset($_POST['waterStoreID']) && isset($_POST['waterGoodsCount'])){
			//订单里必须有桶装水
			if($_POST['waterGoodsID'] == "" || $_POST['waterStoreID'] == "" || $_POST['waterGoodsCount'] == ""){
				echo Json::makeJson("440","请先选择要购买桶装水");
				exit(0);
			}

			//获取水站的id数组
			$waterStoreIDArr = $_POST['waterStoreID'];
			$waterGoodsArr = $_POST['waterGoodsID'];
			$waterGoodsCountArr = $_POST['waterGoodsCount'];
			//去重复，得到所有的水站id
			$waterStoreIDUniqueArr = array_unique($waterStoreIDArr);

			$order = new OrderDetail();
			$orderContainGoods = new OrderContainGoods();

			//不重复的水站id的数量
			$total = count($waterStoreIDUniqueArr);
			//被拆分后的订单数组
			$orderArr = array();
			//被拆分后的订单的每个订单的总价
			$orderTotalPrice = array();
			//订单生成
			for($n = 0; $n < $total; $n++){
				$result = $order ->placeOrder($_SESSION['id'],$waterStoreIDUniqueArr[$n]);
				//未订单添加桶装水
				if($result['code'] == "200"){
					$orderArr[] = $result['data'];
				}else{
					//一旦错误，立即结束并返回
					echo Json::makeJson("500",$result['message']);
					exit(0);
				}
			}//订单生成完毕
			//通过比对将每一个桶装水加入相应的订单中并计算每个订单的总价
			$count = count($waterGoodsArr);
			//引入桶装水商品模型文件，用以查询桶装水实时价格
			require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
			for($m = 0; $m < $total; $m++){
				$orderTotalPrice[$m] = 0;
				for($i = 0 ;$i < $count ;$i++) {
					if($waterStoreIDArr[$i] == $waterStoreIDUniqueArr[$m]){
						//先获取桶装水的单价!
						$price = BarrelWaterGoods::getBarrelWaterGoodsPrice($waterGoodsArr[$i]);
						//将该只桶装水的总价加入订单总价中
						$orderTotalPrice[$m] =$orderTotalPrice[$m] + $waterGoodsCountArr[$i] * $price;
						//将桶装水加入该订单
						$orderContainGoods ->addGoodsForOrder($orderArr[$m],$waterGoodsArr[$i],$waterGoodsCountArr[$i]);
					}
				}
			}//通过比对将每一个桶装水加入相应的订单中并计算每个订单的总价完毕
			//将每个订单的总价写入数据库addTotalPriceForOrder($orderID,$TotalPrice)
			for($p = 0; $p < $total; $p++){
				$order ->addTotalPriceForOrder($orderArr[$p],$orderTotalPrice[$p]);
			}//写入完毕
			//将购物车中的商品删除
			require(DOC_PATH_ROOT."/Model/EntityModel/shoppingcart.class.php");
			for($q = 0; $q < $count; $q++) {
				$shopCart =ShoppingCart::deleteGoodsOnMyShoppingCart($waterGoodsArr[$q]);
			}
			//-----------------------------------------------
			//返回所有拆分后的订单
			if($total > 1){
				// echo Json::makeJson("200","下单成功,订单已被拆分",$orderArr);
				echo Json::makeJson("200","",$orderArr);
			}else{
				// echo Json::makeJson("100","下单成功,",$orderArr);
				echo Json::makeJson("100","",$orderArr);
			}
		}else{
			echo Json::makeJson("400","请求错误");
		}
	}

//----------------------------------------------------------------
//------------结算订单----------------------------------------------
//----------------------------------------------------------------
	/*
	 *订单结算页面
	 */
	function orderSettle(){
		if(isset($_GET['orderid'])){
			$orderID = $_GET['orderid'];
			$order = new OrderDetail();
			//1 查询订单详情
			$orderDetail = $order ->getOrderDetailByOrderID($orderID);
			//2 获取订单所含的桶装水
	        $orderContainGoods = new OrderContainGoods();
	        $orderContainGoodsResult = $orderContainGoods ->getGoodsByOrderID($orderID);
			//3 获取用户真实姓名和手机
			require(DOC_PATH_ROOT."/Model/EntityModel/user.class.php");
	        $user = new User();
	        $userRealNameAndPhone = $user ->getUserRealNameAndPhone($_SESSION['id']);
			//4 获取用户收货地址
			require(DOC_PATH_ROOT."/Model/EntityModel/userrecieveraddress.class.php");
	        $userRAddr = new UserRecieverAddress();
		    $userRAddrResult = $userRAddr ->getUserRecieverAddress($_SESSION['id']);

			include DOC_PATH_ROOT.'/View/Order/orderSettle.php';
		}
		// else{

		// }
	}
	/*
	 *订单结算-货到付款-处理
	 */
	function orderSettleLocalProc(){
		// orderID:3
		// recieverPersonName:付小松
		// recieverPersonPhone:18585436821
		// date:
		// hour:1
		// minute:00
		// remark:

		// orderID:3
		// recieverPersonName:付小松
		// recieverPersonPhone:18585436821
		// recieverAddress:上海市上海市虹口区无法无法删掉
		// date:2015-05-14
		// hour:9
		// minute:00
		// remark:要快！
		if(!isset($_POST['recieverAddress']) || $_POST['recieverPersonName'] == "" || $_POST['recieverPersonPhone'] == "" || $_POST['date'] == ""){
			echo Json::makeJson("300","收货信息填写不完整");
		}else{
			$order = new OrderDetail();
			//先判断订单是否已经付款了，防止重复付款
			$isAlready = $order ->checkOrderForIsalreadyPay($_POST['orderID']);
			if(!$isAlready){
				echo Json::makeJson("100","该订单已付款");
			}else{
				$recieverTime = $_POST['date'].' '.$_POST['hour'].':'.$_POST['minute'];
				$res = $order ->settleOrder($_POST['orderID'],$_POST['recieverPersonName'],$_POST['recieverPersonPhone'],$_POST['recieverAddress'],$recieverTime,$_POST['remark'],"货到付款");
				if($res){
					echo Json::makeJson("200","订单结算成功");
				}else{
					echo Json::makeJson("400","服务器错误");
					// echo Json::makeJson("400",$res);
				}
			}
		}
	}
	/*
	 *订单结算-在线支付-处理
	 */
	function orderSettleOnlineProc(){
		echo Json::makeJson("200","成功");
	}
	/*
	 *订单结算成功页面
	 */
	function orderSettleResult(){
		// onlinePay
		// localPay
		$way = $_GET['way'];
		include DOC_PATH_ROOT.'/View/Order/orderSettleResult.php';
	}

//----------------------------------------------------------------
//------------查看订单----------------------------------------------
//----------------------------------------------------------------
	/*
	 *获取所有订单 web版
	 */
	function getAllOrder(){
		//------------翻页-----------------
		require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail where orderOwnerID=".$_SESSION['id'];
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getAllOrder($_SESSION['id'],$currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		//获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
		//分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=getAllOrder");
        
        include DOC_PATH_ROOT.'/View/Order/getAllOrder.php';
	}
	/*
	 *获取已完成订单 web版
	 */
	function getDoneOrder(){
		//------------翻页-----------------
		require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail where orderCategory=3 and orderOwnerID=".$_SESSION['id'];
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getDoneOrder($_SESSION['id'],$currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		//获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
		//分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=getDoneOrder");
        
        include DOC_PATH_ROOT.'/View/Order/getDoneOrder.php';
	}
	/*
	 *获取未完成订单 web版
	 */
	function getUnfinishedOrder(){
		//------------翻页-----------------
		require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail where orderCategory=0 and orderOwnerID=".$_SESSION['id'];
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getUnfinishedOrder($_SESSION['id'],$currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		//获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
		//分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=getUnfinishedOrder");
        
        include DOC_PATH_ROOT.'/View/Order/getUnfinishedOrder.php';
	}
	/*
	 *查看待付款订单 web版
	 */
	function getNonPaymentOrder(){
		//------------翻页-----------------
		require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail where orderOwnerID=".$_SESSION['id']." and orderStatue=0";
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getNonPaymentOrder($_SESSION['id'],$currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		//获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
			// Array
			// 	(
			// 	    [0] => Array
			// 	        (
			// 	            [id] => 33
			// 	            [remark] => 
			// 	            [totalPrice] => 43.34
			// 	            [orderStatue] => 0
			// 	            [orderSubmitTime] => 1431169147
			// 	        )
			// 	    [1] => Array
			// 	        (
			// 	            [id] => 34
			// 	            [remark] => 
			// 	            [totalPrice] => 565.00
			// 	            [orderStatue] => 0
			// 	            [orderSubmitTime] => 1431169147
			// 	        )
			// 	)
			// Array
			// (
			//     [0] => Array
			//         (
			//             [0] => Array
			//                 (
			//                     [waterGoodsID] => 4
			//                     [waterGoodsCount] => 1
			//                 )
			//         )
			//     [1] => Array
			//         (
			//             [0] => Array
			//                 (
			//                     [waterGoodsID] => 5
			//                     [waterGoodsCount] => 1
			//                 )
			//         )
			// )

        //分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=getNonPaymentOrder");
        
        include DOC_PATH_ROOT.'/View/Order/getNonPaymentOrder.php';
	}
	/*
	 *获取已取消订单 web版
	 */
	function getCanceleddOrder(){
		//------------翻页-----------------
		require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail where orderOwnerID=".$_SESSION['id']." and orderCategory=1";
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getCanceleddOrder($_SESSION['id'],$currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		// require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		// //获取订单状态
		// $orderStatueArrRaw = OrderStatue::getOrderStatue();
		// $orderStatueArr = array();
		// foreach ($orderStatueArrRaw as $key => $value) {
		// 	$orderStatueArr[] = $value['orderStatueName'];
		// }

        //分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=getCanceleddOrder");
        
        include DOC_PATH_ROOT.'/View/Order/getCanceleddOrder.php';
	}
	/*
	 *获取失败订单 web版
	 */
	function getFaileddOrder(){
		//------------翻页-----------------
		require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail where orderOwnerID=".$_SESSION['id']." and orderCategory=2";
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getFaileddOrder($_SESSION['id'],$currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		// require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		// //获取订单状态
		// $orderStatueArrRaw = OrderStatue::getOrderStatue();
		// $orderStatueArr = array();
		// foreach ($orderStatueArrRaw as $key => $value) {
		// 	$orderStatueArr[] = $value['orderStatueName'];
		// }

        //分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=getFaileddOrder");
        
        include DOC_PATH_ROOT.'/View/Order/getFaileddOrder.php';
	}


//----------------------------------------------------------------
//------------查看订单详细情况----------------------------------------------
//----------------------------------------------------------------
	/*
	 *查看订单详细情况
	 */
	function viewOrder(){
		$orderID = isset($_GET['orderid']) ? $_GET['orderid'] : -1;
		$order = new OrderDetail();
		//1 查询订单详情
		$orderDetail = $order ->getOrderDetailByOrderID($orderID);
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		//2 获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
		//3 获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = $orderContainGoods ->getGoodsByOrderID($orderID);
		include DOC_PATH_ROOT.'/View/Order/viewOrder.php';
	}

//----------------------------------------------------------------
//------------操作订单 取消 删除----------------------------------------------
//----------------------------------------------------------------
	/*
	 *取消订单
	 */
	function cancelOrderProc(){

	}
	/*
	 *删除订单
	 */
	function deleteOrderProc(){
		if(isset($_GET['orderid'])){
			$orderID = $_GET['orderid'];
			$orderDetail = new OrderDetail();
			$res = $orderDetail ->deleteOrder($orderID,$_SESSION['id']);
			if($res == 1){
				echo Json::makeJson("200","删除成功");
			}elseif($res == 0){
				echo Json::makeJson("300","删除失败");
			}else{
				echo Json::makeJson("500","系统错误");
			}
		}else{
			echo Json::makeJson("400","请求错误");
		}
	}

}