<?php
define("DSN","mysql:host=horosakura.mysql.rds.aliyuncs.com;dbname=runda");
define("USER","fizy");
define("PASSWORD","runda2015");

// define("DSN","mysql:host=localhost;dbname=region");
// define("USER","root");
// define("PASSWORD","556975");

function executeNoQuery($sql,$paramArray = array()){
		try{
			$pdo = new PDO(DSN,USER,PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw $e;
		}
		try{
			$rowCount = $pdo->exec($sql);
			return $rowCount;
		}catch(PDOException $e){
			throw $e;
		}
	}

$sql ="
set names 'utf8';
insert into provinces(id,name) values (1,'北京市');
insert into provinces(id,name) values (2,'天津市');
insert into provinces(id,name) values (3,'河北省');
insert into provinces(id,name) values (4,'山西省');
insert into provinces(id,name) values (5,'内蒙古自治区');
insert into provinces(id,name) values (6,'辽宁省');
insert into provinces(id,name) values (7,'吉林省');
insert into provinces(id,name) values (8,'黑龙江省');
insert into provinces(id,name) values (9,'上海市');
insert into provinces(id,name) values (10,'江苏省');
insert into provinces(id,name) values (11,'浙江省');
insert into provinces(id,name) values (12,'安徽省');
insert into provinces(id,name) values (13,'福建省');
insert into provinces(id,name) values (14,'江西省');
insert into provinces(id,name) values (15,'山东省');
insert into provinces(id,name) values (16,'河南省');
insert into provinces(id,name) values (17,'湖北省');
insert into provinces(id,name) values (18,'湖南省');
insert into provinces(id,name) values (19,'广东省');
insert into provinces(id,name) values (20,'广西壮族自治区');
insert into provinces(id,name) values (21,'海南省');
insert into provinces(id,name) values (22,'重庆市');
insert into provinces(id,name) values (23,'四川省');
insert into provinces(id,name) values (24,'贵州省');
insert into provinces(id,name) values (25,'云南省');
insert into provinces(id,name) values (26,'西藏自治区');
insert into provinces(id,name) values (27,'陕西省');
insert into provinces(id,name) values (28,'甘肃省');
insert into provinces(id,name) values (29,'青海省');
insert into provinces(id,name) values (30,'宁夏回族自治区');
insert into provinces(id,name) values (31,'新疆维吾尔自治区');
insert into provinces(id,name) values (32,'香港特别行政区');
insert into provinces(id,name) values (33,'澳门特别行政区');
insert into provinces(id,name) values (34,'台湾省');";

try{
	// executeNoQuery("set names 'utf8';");
	executeNoQuery($sql);
}catch(PDOException $e){
	var_dump($e->getMessage());
}