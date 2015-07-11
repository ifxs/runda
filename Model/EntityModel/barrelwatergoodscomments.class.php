<?php
/**
 * 商品评价类 
 */
class BarrelWaterGoodsComments{
    private $id;//  int not null auto_increment primary key,
	private $userID;//   int not null unique,
	private $waterGoodsID;//   int not null,
	private $CommentContent;//   text,
	private $CommentTime;//   int not null,
	private $agreeCount;//  int default 0,
	private $againstCount;//   int default 0,

	public static function getBarrelWaterGoodsComments($id){
		$sql = "select * from barrelWaterGoodsComments where waterGoodsID=?";
		try{
			$result = DBActive::executeQuery($sql,array($id));
			return $result;
		}catch(PDOException $e){
			return null;
		}
	}
}