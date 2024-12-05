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
 perform_day DATE,
 stop_flg TINYINT UNSIGNED NOT NULL,
 is_ticket TINYINT UNSIGNED NOT NULL DEFAULT 0,
 ticket_seat VARCHAR(50),
 PRIMARY KEY(item_id)
);

-- データ挿入
INSERT INTO items (item_name, item_price, item_text, category_id, perform_day, stop_flg, is_ticket, ticket_seat) VALUES
('Concert A', 5000, 'Live concert of Artist A', 1, '2023-11-01', 0, 1, 'A1'),
('Concert B', 6000, 'Live concert of Artist B', 1, '2023-11-05', 0, 1, 'B2'),
('Concert C', 7000, 'Live concert of Artist C', 1, '2023-11-10', 0, 1, 'C3'),
('Concert D', 8000, 'Live concert of Artist D', 1, '2023-11-15', 0, 1, 'D4'),
('Concert E', 9000, 'Live concert of Artist E', 1, '2023-11-20', 0, 1, 'E5');

---

-- ユーザーテーブル作成
CREATE TABLE users (
 user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 username VARCHAR(50) NOT NULL,
 password VARCHAR(255) NOT NULL,
 email VARCHAR(100) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(user_id)
);

-- カートテーブル作成
CREATE TABLE carts (
 cart_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 user_id INT UNSIGNED NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(cart_id),
 FOREIGN KEY(user_id) REFERENCES users(user_id)
);

-- カートアイテムテーブル作成
CREATE TABLE cart_items (
 cart_item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 cart_id INT UNSIGNED NOT NULL,
 item_id INT UNSIGNED NOT NULL,
 quantity SMALLINT UNSIGNED NOT NULL,
 PRIMARY KEY(cart_item_id),
 FOREIGN KEY(cart_id) REFERENCES carts(cart_id),
 FOREIGN KEY(item_id) REFERENCES items(item_id)
);

-- ユーザーデータ挿入
INSERT INTO users (username, password, email) VALUES
('user1', 'password1', 'user1@example.com'),
('user2', 'password2', 'user2@example.com'),
('user3', 'password3', 'user3@example.com');

-- カートデータ挿入
INSERT INTO carts (user_id) VALUES
(1),
(2),
(3);

-- カートアイテムデータ挿入
INSERT INTO cart_items (cart_id, item_id, quantity) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 3, 1),
(2, 4, 2),
(3, 5, 1);

-- 配送情報テーブル作成
CREATE TABLE shipping_info (
 shipping_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 user_id INT UNSIGNED NOT NULL,
 address VARCHAR(255) NOT NULL,
 city VARCHAR(100) NOT NULL,
 postal_code VARCHAR(20) NOT NULL,
 country VARCHAR(100) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(shipping_id),
 FOREIGN KEY(user_id) REFERENCES users(user_id)
);

-- 配送情報データ挿入
INSERT INTO shipping_info (user_id, address, city, postal_code, country) VALUES
(1, '123 Main St', 'Tokyo', '100-0001', 'Japan'),
(2, '456 Elm St', 'Osaka', '540-0002', 'Japan'),
(3, '789 Oak St', 'Nagoya', '460-0003', 'Japan');