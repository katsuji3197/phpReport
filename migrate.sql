--自分の学籍番号にする
CREATE DATABASE db1204812;
USE db1204812;

--テーブル作成
CREATE TABLE items (
 item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 item_name VARCHAR(50) NOT NULL,
 item_price MEDIUMINT UNSIGNED NOT NULL,
 item_text TEXT,
 category_id SMALLINT UNSIGNED NOT NULL,
 perform_day VARCHAR(50),
 stop_flg TINYINT UNSIGNED NOT NULL,
 PRIMARY KEY(item_id)
);

-- データ挿入
INSERT INTO `items` ( `item_name`, `item_price`, `item_text`, `category_id`, `perform_day` , `stop_flg`) VALUES
('商品名', 1000, 'これは説明です。', 1 , '2024年12月12日', 0);

