
-- テーブル作成
CREATE TABLE webapp09 (
 id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
 last_name VARCHAR(50),
 first_name VARCHAR(50),
 login_id VARCHAR(50),
 login_pass VARCHAR(50),
 age TINYINT UNSIGNED,
 PRIMARY KEY(id)
);

-- データ挿入
INSERT INTO `webapp09` (`id`, `last_name`, `first_name`, `login_id`, `login_pass`, `age`) VALUES
(1, '田中', '一郎', 'tanaka',  '1111', 20),
(2, '山田', '二郎', 'yamada',  '2222', 18),
(3, '林',   '三郎', 'hayashi', '3333', 35),
(4, '鈴木', '四郎', 'suzuki',  '4444', 15),
(5, '佐藤', '五郎', 'sato',    '5555', 28);

