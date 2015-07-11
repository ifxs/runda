<?php
//1-----------本地数据库-----------
 define("DSN","mysql:host=localhost;dbname=runda");
 define("USER","root");
 define("PASSWORD","556975");

//2-----------E动网数据库-----------
// define("DSN","mysql:host=61.147.105.15;dbname=runda");
// define("USER","RunDa_f");
// define("PASSWORD","ifxscc");

//3-----------浦东信息港数据库-----------
// define("DSN","mysql:host=208.81.166.164;dbname=fizydb");
// define("USER","fizyDB");
// define("PASSWORD","ifxsxyz");

//4------------阿里云数据库----------
//数据库名称： qdm114391305_db
//数据库类型： MySQL
// 数据库连接地址： qdm114391305.my3w.com
// 数据库用户名： qdm114391305
// 数据库管理密码：
// define("DSN","mysql:host=qdm114391305.my3w.com;dbname=qdm114391305_db");
// define("USER","qdm114391305");
// define("PASSWORD","runda2015");

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

//5----------阿里2---专用于省市县
// 地址：horosakura.mysql.rds.aliyuncs.com
// 数据库名称:runda
// 用户：fizy
// 密码：runda2015
// define("Region_DSN","mysql:host=horosakura.mysql.rds.aliyuncs.com;dbname=runda");
// define("Region_USER","fizy");
// define("Region_PASSWORD","runda2015");

//6----------本地---专用于省市县
define("Region_DSN","mysql:host=localhost;dbname=region");
define("Region_USER","root");
define("Region_PASSWORD","556975");

//7----------us--数据库服务器
// define("DSN","mysql:host=104.224.138.8;dbname=runda");
// define("USER","root");
// define("PASSWORD","14yh_L9T");