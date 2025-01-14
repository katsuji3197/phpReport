
-- データベースの作成
CREATE DATABASE db1204812;
USE db1204812;

-- 会員テーブル作成
CREATE TABLE user (
 id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
 full_name VARCHAR(100) NOT NULL,
 postal_code VARCHAR(20),
 address VARCHAR(255),
 phone_number VARCHAR(20),
 email VARCHAR(100) UNIQUE NOT NULL,
 password VARCHAR(255) NOT NULL,
 is_admin BOOLEAN NOT NULL,
 PRIMARY KEY(id)
);


-- 商品テーブルの作成
CREATE TABLE item (
    `item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品ID',
    `item_name` VARCHAR(100)  NOT NULL COMMENT '商品名',
    `perform_date` VARCHAR(100)   COMMENT '公演日',
    `perform_time` VARCHAR(100)   COMMENT '公演時間',
    `seat` VARCHAR(100)   COMMENT '座席情報',
    `item_exp` TEXT  NOT NULL COMMENT '商品説明',
    `item_price` MEDIUMINT UNSIGNED COMMENT '商品価格',
    `item_stock` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品在庫',
    `category_id` TINYINT UNSIGNED COMMENT '商品カテゴリ',
    `stop_flg` TINYINT UNSIGNED NOT NULL, 
    PRIMARY KEY (item_id)
);


-- カテゴリテーブルの作成
CREATE TABLE category (
    `category_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'カテゴリID',
    `category_name` VARCHAR(100)  NOT NULL COMMENT 'カテゴリ名',
    PRIMARY KEY (category_id)
);

-- 会員データ挿入
INSERT INTO `user` (`id`, `full_name`, `postal_code`, `address`, `phone_number`, `email`, `password`, `is_admin`) VALUES
(1, '管理 太郎', '123-4567', '東京都新宿区', '090-1234-5678', 'admin', 'kanri', true),
(2, '山田 二郎', '234-5678', '大阪府大阪市', '080-2345-6789', 'yamada@example.com', '2222', false),
(3, '林 三郎', '345-6789', '福岡県福岡市', '070-3456-7890', 'hayashi@example.com', '3333', false),
(4, '鈴木 四郎', '456-7890', '北海道札幌市', '060-4567-8901', 'suzuki@example.com', '4444', false),
(5, '佐藤 五郎', '567-8901', '愛知県名古屋市', '050-5678-9012', 'sato@example.com', '5555', false);

-- 商品データ
INSERT INTO item (item_id, item_name, perform_date, perform_time, seat, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (1, '半袖シャツ（白）', '2025年2月25日', '10:00 ~ 15:00', 'A列2席', 'ホワイトの半袖のシャツです。', 1100, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (2, '半袖シャツ（赤）', 'レッドの半袖のシャツです。', 1200, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (3, '半袖シャツ（橙）', 'オレンジの半袖のシャツです。', 1300, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (4, '半袖シャツ（黄）', 'イエローの半袖のシャツです。', 1400, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (5, '半袖シャツ（緑）', 'グリーンの半袖のシャツです。', 1500, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (6, '半袖シャツ（青）', 'ブルーの半袖のシャツです。', 1600, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (7, '半袖シャツ（桃）', 'ピンクの半袖のシャツです。', 1700, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (8, '半袖シャツ（灰）', 'グレーの半袖のシャツです。', 1800, 10, 1, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (9, '長袖シャツ（白）', 'ホワイトの長袖のシャツです。', 2100, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (10, '長袖シャツ（赤）', 'レッドの長袖のシャツです。', 2200, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (11, '長袖シャツ（橙）', 'オレンジの長袖のシャツです。', 2300, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (12, '長袖シャツ（黄）', 'イエローの長袖のシャツです。', 2400, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (13, '長袖シャツ（緑）', 'グリーンの長袖のシャツです。', 2500, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (14, '長袖シャツ（青）', 'ブルーの長袖のシャツです。', 2600, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (15, '長袖シャツ（桃）', 'ピンクの長袖のシャツです。', 2700, 10, 2, 0);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (16, '長袖シャツ（灰）', 'グレーの長袖のシャツです。', 2800, 10, 2, 0);

-- カテゴリデータ
INSERT INTO category (category_id, category_name) VALUES (1, '夏用');
INSERT INTO category (category_id, category_name) VALUES (2, '冬用');

-- カートテーブルの作成
CREATE TABLE cart (
`user_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'ユーザID',
`item_id` MEDIUMINT UNSIGNED NOT NULL COMMENT '商品ID',
`item_num` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '個数',
PRIMARY KEY (user_id, item_id)
);

-- 注文テーブルの作成
CREATE TABLE orders (
`order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '注文ID',
`user_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'ユーザID',
`item_id` MEDIUMINT UNSIGNED NOT NULL COMMENT '商品ID',
`item_num` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '個数',
`sales_price` MEDIUMINT UNSIGNED NOT NULL COMMENT '販売価格',
`order_date` DATE  NOT NULL COMMENT '注文日',
PRIMARY KEY (order_id)
);

-- 商品テーブルとカテゴリテーブルを結合し、「半袖シャツ（白）」の商品データを取得
SELECT 
    item.item_id,
    item.item_name,
    item.item_exp,
    item.item_price,
    item.item_stock,
    category.category_name
FROM 
    item
JOIN 
    category ON item.category_id = category.category_id
WHERE 
    item.item_id = 1;