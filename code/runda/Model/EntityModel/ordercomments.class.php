<?php
class OrderComments{
	/*
	 *添加订单评论
	 */
	public static function commentOrder($orderID,$userID,$CommentContent){
		$CommentTime = time();
		$sql = "insert into orderComments (orderID,userID,CommentContent,CommentTime) values(?,?,?,?)";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderID,$userID,$CommentContent,$CommentTime));
			if($rowCount > 0){
					return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
// 			return $e->getMessage();;
		}
	}
}