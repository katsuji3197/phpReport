
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
INSERT INTO `user` (`full_name`, `postal_code`, `address`, `phone_number`, `email`, `password`, `is_admin`) VALUES
('管理 太郎', '1234567', '東京都新宿区', '09012345678', 'admin', 'kanri', true),
('山田 二郎', '2345678', '大阪府大阪市', '08023456789', 'yamada@example.com', '2222', false),
('林 三郎', '3456789', '福岡県福岡市', '07034567890', 'hayashi@example.com', '3333', false),
('鈴木 四郎', '4567890', '北海道札幌市', '06045678901', 'suzuki@example.com', '4444', false),
('佐藤 五郎', '5678901', '愛知県名古屋市', '05056789012', 'sato@example.com', '5555', false),
('田中 六郎', '6789012', '京都府京都市', '09067890123', 'tanaka@example.com', '6666', false),
('高橋 七郎', '7890123', '兵庫県神戸市', '08078901234', 'takahashi@example.com', '7777', false),
('伊藤 八郎', '8901234', '広島県広島市', '07089012345', 'ito@example.com', '8888', false),
('渡辺 九郎', '9012345', '宮城県仙台市', '06090123456', 'watanabe@example.com', '9999', false),
('中村 十郎', '0123456', '静岡県静岡市', '05001234567', 'nakamura@example.com', '1010', false),
('小林 十一郎', '1234568', '茨城県水戸市', '09012345679', 'kobayashi@example.com', '1111', false),
('加藤 十二郎', '2345679', '群馬県前橋市', '08023456780', 'kato@example.com', '1212', false),
('吉田 十三郎', '3456780', '栃木県宇都宮市', '07034567891', 'yoshida@example.com', '1313', false),
('山本 十四郎', '4567891', '岐阜県岐阜市', '06045678902', 'yamamoto@example.com', '1414', false),
('松本 十五郎', '5678902', '三重県津市', '05056789013', 'matsumoto@example.com', '1515', false),
('井上 十六郎', '6789013', '奈良県奈良市', '09067890124', 'inoue@example.com', '1616', false),
('木村 十七郎', '7890124', '和歌山県和歌山市', '08078901235', 'kimura@example.com', '1717', false),
('林田 十八郎', '8901235', '岡山県岡山市', '07089012346', 'hayashida@example.com', '1818', false),
('清水 十九郎', '9012346', '山口県山口市', '06090123457', 'shimizu@example.com', '1919', false),
('森田 二十郎', '0123457', '愛媛県松山市', '05001234568', 'morita@example.com', '2020', false);

-- 商品データ
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルコットンフィルター101', '業界初！コットンの繊維を使ったペーパーコーヒーフィルターでネルドリップの旨さが実現！その名も、コットンパワーフィルター！エグ味や雑味を抑えながらコクを引き出し、まろやかになります。上質パルプを使用し、衛生的な工場で製造いたしております。', 300, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルコットンフィルター102', '業界初！コットンの繊維を使ったペーパーコーヒーフィルターでネルドリップの旨さが実現！その名も、コットンパワーフィルター！エグ味や雑味を抑えながらコクを引き出し、まろやかになります。上質パルプを使用し、衛生的な工場で製造いたしております。', 340, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブフィルタ155（1～2杯用）100枚入', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。', 600, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブフィルタ185（2～4杯用）100枚入', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。', 650, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルペーパーフィルター102', 'バージンパルプを100％使用し、コーヒーの風味に影響の少ない酸素漂白で仕上げました。お得な100枚入り。毎日コーヒーを淹れる方におすすめです。', 280, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルペーパーフィルター103', 'バージンパルプを100％使用し、コーヒーの風味に影響の少ない酸素漂白で仕上げました。お得な100枚入り。毎日コーヒーを淹れる方におすすめです。', 400, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('円錐コットンパワーフィルター（1～2杯用）', 'ネルドリップコーヒーにもっとも近い味わいが実現出来るコットンペーパーフィルター。円錐フィルターは１点抽出なので味・香りともに一段と豊かに美味しいコーヒーが出来上がります。ドリッパーは円錐型ドリッパーをご使用ください。', 340, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('円錐コットンパワーフィルター（1～4杯用）', 'ネルドリップコーヒーにもっとも近い味わいが実現出来るコットンペーパーフィルター。円錐フィルターは１点抽出なので味・香りともに一段と豊かに美味しいコーヒーが出来上がります。ドリッパーは円錐型ドリッパーをご使用ください。', 380, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルドリッパー陶器製（1-2人用）', 'キャラバンサライ40周年記念・オリジナルロゴ入り陶器製一つ穴式ドリッパーです。◆1～2人用◆', 1160, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルドリッパー陶器製（2-4人用）', 'キャラバンサライ40周年記念・オリジナルロゴ入り陶器製一つ穴式ドリッパーです。◆1～2人用◆', 1220, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブガラスドリッパー155（1-2人用)', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。カラフルな専用のガラス製ドリッパー。', 2200, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオV60コーヒーサーバー450（VCS-01B）', '耐熱ガラスを使用し、フタをしたままでも電子レンジでお使い頂けるコーヒーサーバーです。', 900, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('タカヒロ細口ステンレスドリップポット(0.9リットル)', 'ボンマックのタカヒロ細口ドリップポットは、ご家庭でのドリップにぜひおすすめ！ステンレス製の0.9リットルタイプです。', 16500, 100, 5, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ細口ステンレスポット（0.7リットル）', 'ドリップの際にお湯の量をコントロールしやすい細口タイプ。軽くて丈夫なステンレス製です。', 9000, 100, 5, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ウォータードリップコーヒーサーバー（iwaki）', '水とコーヒー（粉）を用意するだけで、本格的な美味しい水出しコーヒー（ダッチコーヒー）ができます。点滴でじっくりと２～３時間かけて抽出するので、コクのある水出しコーヒーがご家庭で楽しめる優れものです。', 3000, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ300サーバＮ（101ドリッパー用）', '耐熱ガラスを使用し、電子レンジでもお使い頂けるコーヒーサーバーです。101ドリッパー用。', 1200, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ500サーバＮ（102ドリッパー用）', '耐熱ガラスを使用し、電子レンジでもお使い頂けるコーヒーサーバーです。102ドリッパー用。', 1400, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ800サーバＮ（103ドリッパー用）', '耐熱ガラスを使用し、電子レンジでもお使い頂けるコーヒーサーバーです。103ドリッパー用。', 1600, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタプラスチック製ドリッパー103-D（4-7人用）', '初めてドリップを挑戦する方も使いやすいカリタの三つ穴式ドリッパーです。４～７人用。', 700, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタプラスチック製ドリッパー104-D（7-12人用）', '初めてドリップを挑戦する方も使いやすいカリタの三つ穴式ドリッパーです。7～12人用。', 900, 100, 3, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ダイヤミル（手挽きミル）', '職人がひとつひとつ手作りで仕上げた名品！縦に動かすハンドルの方が、横に回すハンドルよりも楽に豆を挽くことが出来ます。本体に十分な重さもあり、ハンドルを回す時の安定性が非常に高いです。インテリアにもマッチするレトロなデザインが好評です。', 15800, 100, 4, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ナイスカットG【電動コーヒーミル】', 'キャラバンサライでぜひおすすめしたいコーヒーミルが「カリタ コーヒーミル ナイスカットG」です。家庭でも気軽にお使い頂ける様、デザインも一新し静音性もアップ。さらに、新機能によりこれまでのコーヒーミルにありがちな「粉の飛び散り」を防止し、従来のコーヒーミルよりも豆の風味の劣化が少なく粒度が安定しています。日本が誇るコーヒー器具専門メーカー、カリタだからこそ実現した次世代コーヒーミルです。', 46900, 100, 4, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブガラスドリッパー185（2-4人用）他カラー有り', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。カラフルな専用のガラス製ドリッパー。', 2400, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブステンレスドリッパー（1-2人用）', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。ウェーブフィルタ専用のステンレス製ドリッパー。', 4500, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブステンレスドリッパー（2-4人用）', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。ウェーブフィルタ専用のステンレス製ドリッパー。', 5000, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・ウェーブポット（1リットル）', 'ニューコンセプトのカリタ・ウェーブシリーズは、味ムラが少なくお湯を注いだ時の景色や香りも楽しめて、プロが淹れるようなドリップコーヒーをご家庭で手軽で簡単に淹れることが出来ます。ウェーブフィルタ専用のステンレス製ドリッパー。', 10000, 100, 5, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナル・ワンカップフィルター（20枚入）', 'いつものカップにセットしてコーヒー（粉）を入れ、お湯を注ぐだけの当店オリジナル・ワンカップフィルターです。オフィスやアウトドアでも、大活躍！使い捨てタイプで忙しい時にもとても便利。燃えるゴミとして処分できます。（20枚入り', 375, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタFP104濾紙', 'カリタ製のペーパーフィルター。主に業務用に使われる大きいサイズのペーパーフィルターです。', 700, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('業務用立て濾紙', '25センチ：250枚入り　（この商品はセール対象外です。）', 1350, 100, 1, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオ水出しコーヒーポット（600ml）', '手軽で美味しい水出しコーヒーが作れ、そのまま保存できるポットです。コーヒー豆本来の味と香りが楽しめます。', 1800, 100, 5, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオ水出しコーヒーポット（1000ml）', '手軽で美味しい水出しコーヒーが作れ、そのまま保存できるポットです。コーヒー豆本来の味と香りが楽しめます。', 2000, 100, 5, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ冷却器（ST-1）', 'おいしいアイスコーヒーをつくるには、冷却器があるとたいへん便利です。どなたでも簡単手軽に、アイスコーヒーづくりが楽しめます。サーバーやドリッパーは手持ちのもので・・という方には、冷却器をお求めいただけます。', 800, 100, 7, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオV60透過ドリッパー01（陶器製・1-2杯用）', 'お湯の速度で「味」が変えられる、陶器製のハリオV60透過ドリッパーです。◆1～2杯用・V60計量スプーン付き◆', 2000, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオV60透過ドリッパー02（陶器製・1-4杯用）', 'お湯の速度で「味」が変えられる、陶器製のハリオV60透過ドリッパーです。◆1～4杯用・V60計量スプーン付き◆', 2000, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオV60透過ドリッパー02クリア（AS樹脂製・1-4杯用）', 'お湯の速度で「味」が変えられる、陶器製のハリオV60透過ドリッパーです。◆1～4杯用・V60計量スプーン付き◆', 500, 100, 2, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('オリジナルロゴ入りカッピングスプーン', 'キャラバンサライ40周年記念・オリジナルロゴ入り', 1000, 100, 7, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ザッセンハウス・ブラジリア（手挽きミル）', 'ザッセンハウス・ミル“ブラジリア”は、初めて手挽きミルをお使いの方にも使いやすい家庭用ミルです。その挽き味はドイツの職人の伝統と技術を受け継いだ素晴らしいもの。これがあれば毎日のコーヒーライフがさらに楽しいものになります。', 16000, 100, 4, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('メリタコーヒーマシーン・ノア（SKT-55）', 'メリタのコーヒーメーカー。いれたてのおいしさが持続する、ステンレスポットの保温力。高温抽出で、豆の個性を最大限に引き出す優れもの。丈夫なステンレスポットはホットにもアイスにも対応。氷を直接ポットに入れそのままコーヒーを抽出することも可能です。', 10800, 100, 6, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('カリタ・コーヒーミルKH-5（手挽きミル）', '持ちやすいコンパクトな筒型タイプ。硬質鋳鉄カッターを使用しているのでお好みの挽き具合に調整ができます。挽いた粉はワンタッチで本体から取り外せ、ドリッパーに簡単に入れられます。豆容器にフタがあり、挽く時に豆が飛び散りません。', 6000, 100, 4, 0);
INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES ('ハリオ・セラミックスリムミル（1～2杯用・手挽きミル）', 'セラミック製の臼を使用しているため、摩擦熱が発生しにくく、熱によるコーヒー粉へのダメージを防ぎます。臼が洗えるので清潔に保てます。', 3000, 100, 4, 0);


-- カテゴリデータ
INSERT INTO category (category_id, category_name) VALUES (1, 'フィルター');
INSERT INTO category (category_id, category_name) VALUES (2, 'ドリッパー');
INSERT INTO category (category_id, category_name) VALUES (3, 'サーバー');
INSERT INTO category (category_id, category_name) VALUES (4, 'ミル');
INSERT INTO category (category_id, category_name) VALUES (5, 'ポット');
INSERT INTO category (category_id, category_name) VALUES (6, 'マシン');
INSERT INTO category (category_id, category_name) VALUES (7, 'その他');

-- カートテーブルの作成
CREATE TABLE cart (
`user_id` MEDIUMINT UNSIGNED NOT NULL COMMENT 'ユーザID',
`item_id` MEDIUMINT UNSIGNED NOT NULL COMMENT '商品ID',
`item_num` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '個数',
PRIMARY KEY (user_id, item_id)
);