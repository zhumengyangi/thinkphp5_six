-- 商品表 --
create table goods(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  cate_id int(10) default 0 comment '分类id',
  goods_name varchar(50) default '' comment '商品的名称',
  goods_img varchar(120) default '' comment '商品图片',
  goods_num int(10) default 0 comment '商品数量',
  price  DECIMAL(10,2) not null comment '商品价格',
  status tinyint(4) default 1 comment '商品状态 1下架  2 上架',
  created_at timestamp default current_timestamp comment '创建时间',
  updated_at timestamp default current_timestamp on update current_timestamp comment '更新时间'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;

-- 订单表 --
create table `order`(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  goods_id int(10) default 0 comment '商品id',
  book_user varchar(50) default '' comment '预订人姓名',
  book_phone varchar(20) default '' comment '预订人手机号',
  goods_num int(10) default 0 comment '订单商品数量',
  status tinyint(4) default 1 comment '订单状态1 待确认 2 已付款 3 已发货 4 确认收货  5 退货',
  created_at timestamp default current_timestamp comment '创建时间',
  updated_at timestamp default current_timestamp on update current_timestamp comment '更新时间'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;

-- 商品分类表 --
create table `goods_category`(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  cate_name varchar(50) comment '商品分类名称',
  status tinyint(4) default 1 comment '分类状态 1可用  2 禁用',
)engine=INNODB default charset=utf8 collate=utf8_general_ci;

-- 文章分类 --
create table `article_type`(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  art_cate varchar(50) comment '文章分类名称'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;


-- 文章表 --
create table article(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  c_id int(10) default 0 comment '分类id',
  title varchar(50) default '' comment '文章标题',
  image_url varchar(120) default '' comment '文章图片',
  clicks int(10) default 0 comment '点击次数',
  status tinyint(4) default 1 comment '状态 1待审核 2正常',
  created_at timestamp default current_timestamp comment '创建时间',
  updated_at timestamp default current_timestamp on update current_timestamp comment '更新时间'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;

-- 文章内容表--
create table `article_extends`(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  a_id int(10) default 0 comment '文章id',
  content text comment '文章内容'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;


-- 广告位 --
create table `ad_position`(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  position_title varchar(50) comment '广告位标题',
 status tinyint(4) default 1 comment '状态 1不可用 2正常'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;


-- 广告表 --
create table ad(
	id int(10) unsigned auto_increment  primary key comment '主键id',
  p_id int(10) default 0 comment '广告位id',
  title varchar(50) default '' comment '广告名称',
  image_url varchar(120) default '' comment '广告图片',
  status tinyint(4) default 1 comment '状态 1待审核 2正常',
  created_at timestamp default current_timestamp comment '创建时间',
  updated_at timestamp default current_timestamp on update current_timestamp comment '更新时间'
)engine=INNODB default charset=utf8 collate=utf8_general_ci;


-- 后台的用户管理表 -- 

create table admin_users(
  id int(10) unsigned auto_increment primary key comment '主键id',
  username varchar(30) not null comment '用户名',
  password varchar(32) not null comment '密码',
  token varchar(32) not null  comment 'token令牌',
  expired_at int(10) not null comment '过期时间',
  created_at timestamp default current_timestamp comment '创建时间',
  updated_at timestamp default current_timestamp on update current_timestamp comment '修改时间',
  unique(token)
) ENGINE=INNODB default charset=utf8 collate=utf8_general_ci;
  

