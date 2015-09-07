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
sex char(6) not null,
realName varchar(20),
photo varchar(600) default '/Content/image/userphotograph/photo.png',
phoneNumber char(11) not null unique, -- 唯一
email varchar(60), -- 唯一
idCardGraphFront varchar(600),
idCardGraphBack varchar(600),
idCardNumber char(18),
isRealNameAuthen tinyint not null default 0,
role tinyint not null default 0,
isLock tinyint not null default 0,
province varchar(20) not null,
city varchar(20) not null,
country varchar(20) not null,
detailAddress varchar(200) not null,
foreign key(role) references role(id) ON DELETE NO ACTION
)auto_increment=10000;

-- 用户收货地址表
create table userRecieverAddress(
	id int not null auto_increment primary key,
	userID int not null,
	province varchar(20) not null,
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
-- 水店审核状态表
create table waterStoreAuditStatus(
   id tinyint not null primary key,
   auditStat varchar(50) not null
);
-- 水店表
create table waterStore(
id int not null auto_increment primary key,
owner int not null unique,
waterStoreName varchar(100) not null,
waterStoreTellPhone char(11) not null,
waterStoreFixedLinePhone char(11),
waterStoreEmail varchar(60),
waterStoreImage varchar(600) default '/Content/image/waterstoreimage/photo.png',
isLock tinyint not null default 0,
waterStoreStatus tinyint not null default 0,
auditStatus tinyint not null default 0,
auditDetail varchar(100),
province varchar(20) not null,
city varchar(20) not null,
country varchar(20) not null,
detailAddress varchar(200) not null,
waterStoreLongitude varchar(20),-- 经度
waterStoreLatitude varchar(20), -- 纬度
businessLicense varchar(255) not null,
foreign key(owner) references user(id) ON DELETE CASCADE,
foreign key(waterStoreStatus) references waterStoreStatue(id) ON DELETE NO ACTION,
foreign key(auditStatus) references waterStoreAuditStatus(id) ON DELETE NO ACTION
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
userId int not null unique,
waterStoreId int not null,
maxLoadCapacity tinyint not null,
statue  tinyint not null default 0,
foreign key(userId) references user(id) ON DELETE CASCADE,
foreign key(waterStoreId) references waterStore(id) ON DELETE CASCADE,
foreign key(statue) references waterBearerStatue(id) ON DELETE CASCADE
)auto_increment=10000;

-- 送水工送水路线表
create table  waterBearerDriverRoute(
id int not null auto_increment primary key,
waterBearerId int not null,
waterBearerPositionLongitude varchar(20) not null,-- 经度
waterBearerPositionLatitude varchar(20) not null, -- 纬度
date char(6) not null, -- 20150412
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
	waterStoreID int not null,
	waterCate int not null, -- 类别
	waterBrand int not null, -- 品牌
	waterGoodsName varchar(140) not null, -- 桶装水名称
	waterGoodsDescript text not null, -- 桶装水描述
	waterGoodsPrice decimal(6,2) not null, -- 桶装水价格
	waterGoodsDefaultImage varchar(400) default '/Content/image/goodspicture/goods.jpg',
	waterGoodsInventory int not null default 0,-- 库存
	isGrounding tinyint not null default 0, -- 是否上架
	groundingDate int not null,  -- 上架时间
	salesVolume int not null default 0, -- 销量
	foreign key(waterStoreID) references waterStore(id) ON DELETE CASCADE,
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
	userID int not null unique,
	waterGoodsID int not null,
	CommentContent text,
	CommentTime int not null,
	agreeCount int default 0,
	againstCount int default 0,
	foreign key(userID) references user(id) ON DELETE CASCADE,
	foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);
-- -----------------------------------------------------------------------
-- 购物车表
create table shoppingCart(
	id int not null auto_increment primary key,
	cartOwnerID int not null,  -- 所有者ID
	waterGoodsID int not null, -- 该条记录的商品ID 
	-- waterGoodsName varchar(140) not null,
	-- waterGoodsPrice decimal(6,2) not null,
	-- waterGoodsDefaultImage varchar(400),
	waterGoodsCount tinyint not null default 1, -- 该条记录的商品的数量
	addCartTime int, -- 加入购物车时间
	foreign key(cartOwnerID) references user(id) ON DELETE CASCADE,
	foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);

-- 订单状态表
create table orderStatue(
	id int not null primary key,
	orderStatueName varchar(20)
);
-- 订单类别表
create table orderCategory(
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
	orderOwnerID int not null,  -- 所有者ID
	waterBearerID int not null, -- 承接的送水工
	recieverPersonName varchar(20) not null, -- 收货人姓名
	recieverPersonPhone char(11) not null, -- 收货人电话
	recieverTime int not null, -- 收货时间
	remark varchar(100), -- 备注
	totalPrice decimal(10,2) not null default 0.00, -- 订单总额
	orderCategory int not null default 0, -- 订单类别
	orderStatue int not null, -- 订单状态
	logisticeInformation text, -- 物流信息
	orderCancelReason int, -- 订单取消原因
	orderFailReason int, -- 订单失败原因
	orderSubmitTime int not null, --  订单提交时间
	orderDoneTime int, -- 订单完成时间
	foreign key(orderOwnerID) references user(id) ON DELETE CASCADE,
	foreign key(waterBearerID) references user(id) ON DELETE CASCADE,
	foreign key(orderStatue) references orderStatue(id) ON DELETE CASCADE,
	foreign key(orderCategory) references orderCategory(id) ON DELETE CASCADE
);
-- 订单所包含的商品表
create table orderContainGoods(
	id int not null auto_increment primary key,
	orderID int not null, -- 订单ID
	waterGoodsID int not null, -- 该条记录的商品ID 
	waterGoodsCount tinyint not null default 1, -- 该条记录的商品的数量
	waterGoodsPrice decimal(6,2), -- 该条记录的商品单价
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
	isShow tinyint not null,
	imageWeight tinyint not null
)auto_increment=10000;

-- 要修改的地方：
-- 1->sex char(6) not null, (OK)
-- 2->isShow tinyint not null  (OK)
-- 2->imageWeight tinyint not null  (OK)

-- 2015年4月8日21:01:50
-- 要修改：role tinyint not null default 1, ->default 0
-- 2015年4月12日19:20:58 增加了商品所属的水站，水站审核，
--          审核详细（用来存审核未通过的），送水工的经度和纬度，意见该条记录的日期
-- 2015年4月16日12:39:21   user表的 用户名 手机号 邮箱 都必须是唯一的！！
-- 水站表的 owner int not null unique  !!!   2015年4月16日22:52:28


-- 2015年4月18日21:59:59   statue  tinyint not null default 0,userID int not null unique, 送水工表



-- 2015年4月27日09:50:56   水站表添加经纬度字段
-- 2015年4月27日23:58:07   groundingDate int not null,  -- 上架时间
-- 2015年4月28日10:34:18   waterStoreImage varchar(600) default '/Content/image/waterstoreimage/photo.png', 水站默认图片
--	recieverTime int not null, 收货时间
-- orderSubmitTime int not null, --  订单提交时间

-- 2015年5月5日16:49:38 isRealNameAuthen tinyint not null default 0,
