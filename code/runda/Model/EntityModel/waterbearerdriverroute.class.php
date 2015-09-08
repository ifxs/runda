<?php



class WaterBearerDriverRoute{
    private $id; // int not null auto_increment primary key,
    private $waterBearerId; // int not null,
    private $waterBearerPositionLongitude; // varchar(200) not null,
    private $waterBearerPositionLatitude; // varchar(200) not null, -- 纬度
    private $date; // char(6) not null, -- 20150412
    private $time; // int not null,
    private $remainCapacity; // tinyint not null,
}
// create table  waterBearerDriverRoute(
// id int not null auto_increment primary key,
// waterBearerId int not null,
// waterBearerPositionLongitude varchar(200) not null,
// waterBearerPositionLatitude varchar(200) not null, -- 纬度
// date char(6) not null, -- 20150412
// time int not null,
// remainCapacity tinyint not null,
// foreign key(waterBearerId) references user(id) ON DELETE CASCADE
// );