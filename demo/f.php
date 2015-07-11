<?php
 define("DSN","mysql:host=localhost;dbname=runda");
 define("USER","root");
 define("PASSWORD","556975");
class DBActive{
	//执行 查询操作
	public static function executeQuery($sql,$paramArray = array()){
		try{
			$pdo = new PDO(DSN,USER,PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw $e;
		}
		try{
			$stm = $pdo ->prepare($sql);
			for($i=0;$i<count($paramArray);$i++){
				$stm -> bindParam($i+1, $paramArray[$i]);
			}
			$stm ->execute();
			$stm ->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stm ->fetchAll();
			return $result;
		}catch(PDOException $e){
			throw $e;
		}
	}
}
$sql = "select * from barrelWaterGoods where id=1;";
try{
    $result = DBActive::executeQuery($sql);
    // return $result[0];
    print_r($result);
}catch(PDOException $e){
    return null;
} 