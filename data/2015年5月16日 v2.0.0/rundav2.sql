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
   name varchar(30) not null,-- 最长的11个字
   cityID int not null,
   foreign key(cityID) references Cities(id) ON DELETE CASCADE ON UPDATE NO ACTION
);

-- 角色表
create table role(
   id tinyint not null primary key,
   roleName varchar(50) not null
);

-- 用户表
create table user(
id int not null auto_increment primary key,
userName varchar(40) not null unique,  -- 唯一
password varchar(128) not null,
nickName varchar(40),
sex char(4) not null,   -- sex char(6) not null,
realName varchar(20),
photo varchar(600) default '/Content/image/userphotograph/photo.png',
phoneNumber char(11) not null,
email varchar(60) not null,
idCardGraph varchar(600),
idCardNumber char(18),
role tinyint not null default 1,
isLock tinyint not null default 0,
-- privince int not null,
-- city int not null,
-- country int not null,
privince varchar(20) not null,
city varchar(20) not null,
country varchar(20) not null,
detailAddress varchar(200) not null,
foreign key(role) references role(id) ON DELETE NO ACTION
-- foreign key(privince) references provinces(id) ON DELETE NO ACTION,
-- foreign key(city) references cities(id) ON DELETE NO ACTION,
-- foreign key(country) references countries(id) ON DELETE NO ACTION
)auto_increment=10000;

-- 用户收货地址表
create table userRecieverAddress(
	ID int not null auto_increment primary key,
	userID int not null,
	privince varchar(20) not null,
	city varchar(20) not null,
	country varchar(20) not null,
	detailAddress varchar(200) not null,
	foreign key(userID) references user(id) ON DELETE CASCADE
);
-- 水店状态表
create table waterStoreStatue(
   id tinyint not null primary key,
   waterStoreStat varchar(50) not null
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
-- privince int not null,
-- city int not null,
-- country intt not null,
privince varchar(20) not null,
city varchar(20) not null,
country varchar(20) not null,
detailAddress varchar(200) not null,
businessLicense varchar(255) not null,
foreign key(owner) references user(id) ON DELETE CASCADE,
foreign key(status) references waterStoreStatue(id) ON DELETE NO ACTION
-- foreign key(privince) references provinces(id) ON DELETE NO ACTION,
-- foreign key(city) references cities(id) ON DELETE NO ACTION,
-- foreign key(country) references countries(id) ON DELETE NO ACTION
)auto_increment=10000;
-- 水店评价表
create table waterStoreComments(
	id int not null auto_increment primary key,
	userID int not null,
	waterStoreID int not null,
	CommentContent text,
	CommentTime int not null,
	agreeCount int default 0,
	againstCount int default 0,
	foreign key(userID) references user(id) ON DELETE CASCADE,
	foreign key(waterStoreID) references waterStore(id) ON DELETE CASCADE
);

-- 送水工状态表
create table waterBearerStatue(
id tinyint not null primary key,
waterBearerStat varchar(50) not null
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
)auto_increment=10000;

-- 送水工送水路线表
create table  waterBearerDiriveRouter(
id int not null auto_increment primary key,
waterBearerId int not null,
waterBearerPosition varchar(200) not null,
time int not null,
remainCapacity tinyint not null,
foreign key(waterBearerId) references user(id) ON DELETE CASCADE
);
-- 送水工评价表
create table waterBearerComments(
	id int not null auto_increment primary key,
	userID int not null,
	waterBearerID int not null,
	CommentContent text,
	CommentTime int not null,
	agreeCount int default 0,
	againstCount int default 0,
	foreign key(userID) references user(id) ON DELETE CASCADE,
	foreign key(waterBearerID) references user(id) ON DELETE CASCADE
);

-- -----------------------------------------------------------------------
-- 1、商品分类表
create table barrelWaterCategory(
	id int not null primary key,
	barrelWaterCateName varchar(24)
);
-- 2、商品品牌表
create table barrelWaterBrand(
	id int not null primary key,
	barrelWaterBrandName varchar(24)
);
-- 3、商品表
create table barrelWaterGoods(
	id int not null auto_increment primary key,
	waterCate int not null,
	waterBrand int not null,
	waterGoodsName varchar(140) not null,
	waterGoodsDescript text not null,
	waterGoodsPrice decimal(6,2) not null,
	waterGoodsInventory int not null default 0,
	foreign key(waterCate) references barrelWaterCategory(id) ON DELETE CASCADE,
	foreign key(waterBrand) references barrelWaterBrand(id) ON DELETE CASCADE
);
-- 4、商品图片表
create table barrelWaterGoodsPhotos(
	id int not null auto_increment primary key,
	waterGoodsID int not null,
	waterGoodsPhotoPath varchar(400),
	foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);
-- 5、商品评价表
create table barrelWaterGoodsComments(
	id int not null auto_increment primary key,
	userID int not null,
	waterGoodsID int not null,
	CommentContent text,
	CommentTime int not null,
	agreeCount int default 0,
	againstCount int default 0,
	foreign key(userID) references user(id) ON DELETE CASCADE,
	foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);
-- -----------------------------------------------------------------------
-- 订单状态表
create table orderStatues(
	id int not null primary key,
	orderStatueName varchar(20)
);
-- 订单类别表
create table orderCategorys(
	id int not null primary key,
	orderCategoryName varchar(20)
);
-- 订单取消原因
-- create table orderCancelReasons(
-- 	id int not null primary key,
-- 	orderCancelReason varchar(20) not null
-- );
-- -- 订单失败原因
-- create table orderFailReasons(
-- 	id int not null primary key,
-- 	orderFailReason varchar(20) not null
-- );
--   ----------->订单取消原因  订单失败原因 都换成枚举来做
-- 订单详细表
create table orderDetail(
	id int not null auto_increment primary key,
	orderOwnerID int not null,
	waterBearerID int not null,
	recieverPersonName varchar(20) not null,
	recieverPersonPhone char(11) not null,
	recieverTime int,
	remark varchar(100),
	totalPrice decimal(10,2) not null default 0.00,
	orderStatue int not null,
	logisticeInformation text,
	orderCategory int not null default 0,
	orderCancelReason int,
	orderFailReason int,
	orderSubmitTime int,
	orderDoneTime int,
	foreign key(orderOwnerID) references user(id) ON DELETE CASCADE,
	foreign key(waterBearerID) references user(id) ON DELETE CASCADE,
	foreign key(orderStatue) references orderStatues(id) ON DELETE CASCADE,
	foreign key(orderCategory) references orderCategorys(id) ON DELETE CASCADE
	-- foreign key(orderCancelReason) references orderCancelReasons(id) ON DELETE CASCADE,
	-- foreign key(orderFailReason) references orderFailReasons(id) ON DELETE
);
-- 订单所包含的商品表
create table orderContainGoods(
	id int not null auto_increment primary key,
	orderID int not null,
	waterGoodsID int not null,
	waterGoodsCount tinyint not null default 1,
	waterGoodsPrice decimal(6,2),
	foreign key(orderID) references orderDetail(id) ON DELETE CASCADE,
	foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);
-- 订单评价表
create table orderComments(
	id int not null auto_increment primary key,
	orderID int not null,
	userID int not null,
	CommentContent text,
	CommentTime int not null,
	agreeCount int default 0,
	againstCount int default 0,
	foreign key(orderID) references orderDetail(id) ON DELETE CASCADE,
	foreign key(userID) references user(id) ON DELETE CASCADE
);
-- 订单评价图片
create table orderCommentsPhotos(
	id int not null auto_increment primary key,
	orderID int not null,
	photoPath varchar(400),
	foreign key(orderID) references orderDetail(id) ON DELETE CASCADE
);
-- -----------------------------------------------------------------------
-- 图片轮播表
create table imageCarousel(
	id int not null auto_increment primary key,
	imagePath varchar(400) not null,
	imageURL varchar(400),
	imageDescript varchar(100),
	imageUploadTime int not null,
	isShow tinyint not null default 0,--------------- isShow tinyint not null
	imageWeight tinyint not null default 100
)auto_increment=10000;

-- 要修改的地方：
-- 1->sex char(6) not null,
-- 2->isShow tinyint not null