
-- 各種テーブルの削除
DROP TABLE IF EXISTS webapp09;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS orders;

-- 会員テーブル作成
CREATE TABLE webapp09 (
 id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
 last_name VARCHAR(50),
 first_name VARCHAR(50),
 login_id VARCHAR(50),
 login_pass VARCHAR(50),
 age TINYINT UNSIGNED,
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
    PRIMARY KEY (item_id)
);


-- カテゴリテーブルの作成
CREATE TABLE category (
    `category_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'カテゴリID',
    `category_name` VARCHAR(100)  NOT NULL COMMENT 'カテゴリ名',
    PRIMARY KEY (category_id)
);

-- 会員データ挿入
INSERT INTO `webapp09` (`id`, `last_name`, `first_name`, `login_id`, `login_pass`, `age`) VALUES
(1, '田中', '一郎', 'tanaka',  '1111', 20),
(2, '山田', '二郎', 'yamada',  '2222', 18),
(3, '林',   '三郎', 'hayashi', '3333', 35),
(4, '鈴木', '四郎', 'suzuki',  '4444', 15),
(5, '佐藤', '五郎', 'sato',    '5555', 28);

-- 商品データ
INSERT INTO item (item_id, item_name, perform_date, perform_timeitem_exp, seat, item_price, item_stock, category_id) VALUES (1, '半袖シャツ（白）','2025年2月25日','10:00 ~ 15:00','A列2席' 'ホワイトの半袖のシャツです。', 1100, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (2, '半袖シャツ（赤）', 'レッドの半袖のシャツです。', 1200, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (3, '半袖シャツ（橙）', 'オレンジの半袖のシャツです。', 1300, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (4, '半袖シャツ（黄）', 'イエローの半袖のシャツです。', 1400, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (5, '半袖シャツ（緑）', 'グリーンの半袖のシャツです。', 1500, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (6, '半袖シャツ（青）', 'ブルーの半袖のシャツです。', 1600, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (7, '半袖シャツ（桃）', 'ピンクの半袖のシャツです。', 1700, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (8, '半袖シャツ（灰）', 'グレーの半袖のシャツです。', 1800, 10, 1);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (9, '長袖シャツ（白）', 'ホワイトの長袖のシャツです。', 2100, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (10, '長袖シャツ（赤）', 'レッドの長袖のシャツです。', 2200, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (11, '長袖シャツ（橙）', 'オレンジの長袖のシャツです。', 2300, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (12, '長袖シャツ（黄）', 'イエローの長袖のシャツです。', 2400, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (13, '長袖シャツ（緑）', 'グリーンの長袖のシャツです。', 2500, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (14, '長袖シャツ（青）', 'ブルーの長袖のシャツです。', 2600, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (15, '長袖シャツ（桃）', 'ピンクの長袖のシャツです。', 2700, 10, 2);
INSERT INTO item (item_id, item_name, item_exp, item_price, item_stock, category_id) VALUES (16, '長袖シャツ（灰）', 'グレーの長袖のシャツです。', 2800, 10, 2);

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