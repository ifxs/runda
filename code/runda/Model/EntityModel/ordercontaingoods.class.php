<?php

// require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");

class OrderContainGoods{
	/*
	 *为刚生成的订单添加桶装水
	 */
	public function addGoodsForOrder($orderID,$waterGoodsID,$waterGoodsCount,$price){
		$sql = "insert into orderContainGoods (orderID,waterGoodsID,waterGoodsCount,waterGoodsPrice) values(?,?,?,?)";
		try{
			DBActive::executeNoQuery($sql,array($orderID,$waterGoodsID,$waterGoodsCount,$price));
			return true;
		}catch(PDOException $e){
			// return $e ->getMessage().$sql.$orderID.$waterGoodsID.$waterGoodsCount;
			return false;
		}
	}
	/*
	 *根据订单id获取订单的所有桶装水
	 */
	public function getGoodsByOrderID($orderID){
		$sql = "select waterGoodsID,waterGoodsCount from orderContainGoods where orderID=?";
		try{
			$result = DBActive::executeQuery($sql,array($orderID));
			return $result;
		}catch(PDOException $e){
			return null;
		}
	}
}
// create table orderContainGoods(
// 	id int not null auto_increment primary key,
// 	orderID int not null, -- 订单ID
// 	waterGoodsID int not null, -- 该条记录的商品ID 
// 	waterGoodsCount tinyint not null default 1, -- 该条记录的商品的数量
// 	不需要了 ------------》waterGoodsPrice decimal(6,2), -- 该条记录的商品单价
