-- create database RunDa;

-- 省
create table provinces (
   id int not null primary key,
   name varchar(20) not null
);
-- 市
create table cities (
   id int not null primary key,
   name varchar(20) not null,
   provinceID int not null,
   foreign key(provinceID) references provinces(id) ON DELETE CASCADE ON UPDATE NO ACTION
);
-- 县
create table countries (
   id int not null primary key,
   name varchar(20) not null,
   cityID int not null,
   foreign key(cityID) references Cities(id) ON DELETE CASCADE ON UPDATE NO ACTION
);

-- 角色表
create table role(
   id tinyint not null auto_increment primary key,
   name varchar(50) not null
);

-- 用户表
create table user(
id int not null auto_increment primary key,
username varchar(40) not null ,
password varchar(128) not null,
nickName varchar(40),
sex char(4) not null,
realName varchar(20),
photo varchar(600) default '/Content/image/userphotograph/photo.png',
phoneNumber char(11) not null,
email varchar(60),
idCardGraph varchar(600),
idCardNumber char(18),
role tinyint not null default 1,
isLock tinyint not null default 0,
privince int not null,
city int not null,
country int not null,
detailAddress varchar(200) not null,
foreign key(role) references role(id) ON DELETE NO ACTION,
foreign key(privince) references provinces(id) ON DELETE NO ACTION,
foreign key(city) references cities(id) ON DELETE NO ACTION,
foreign key(country) references countries(id) ON DELETE NO ACTION
);

-- 水店状态表
create table waterStoreStatue(
   id tinyint not null auto_increment primary key,
   name varchar(50) not null
);

-- 水店表
create table waterStore(
id int not null auto_increment primary key,
owner int not null,
waterStoreName varchar(100) not null,
waterStoreTellPhone char(11) not null,
waterStoreFixedLinePhone char(11),
waterStoreEmail varchar(60),
isLock tinyint not null default 0,
status tinyint not null default 0,
privince int not null,
city int not null,
country int not null,
detailAddress varchar(200) not null,
businessLicense varchar(255) not null,
foreign key(owner) references user(id) ON DELETE CASCADE,
foreign key(status) references waterStoreStatue(id) ON DELETE NO ACTION,
foreign key(privince) references provinces(id) ON DELETE NO ACTION,
foreign key(city) references cities(id) ON DELETE NO ACTION,
foreign key(country) references countries(id) ON DELETE NO ACTION
);

-- 送水工状态表
create table waterBearerStatue(
id tinyint not null auto_increment primary key,
name varchar(50) not null
);

-- 送水工表
create table waterBearer(
id int not null auto_increment primary key,
userId int not null,
waterStoreId int not null,
maxLoadCapacity tinyint not null,
statue  tinyint not null,
foreign key(userId) references user(id) ON DELETE CASCADE,
foreign key(waterStoreId) references waterStore(id) ON DELETE CASCADE,
foreign key(statue) references waterBearerStatue(id) ON DELETE CASCADE
);

-- 送水工送水路线表
create table  waterBearerDiriveRouter(
id int not null auto_increment primary key,
waterBearerId int not null,
waterBearerPosition varchar(200) not null,
time int not null,
remainCapacity tinyint not null,
foreign key(waterBearerId) references user(id) ON DELETE CASCADE
);