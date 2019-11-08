CREATE DATABASE login;

CREATE TABLE user (
    user_id int AUTO_INCREMENT NOT NULL,
    nama varchar(30),
    email varchar(30),
    password varchar(100),
    kode_aktifasi varchar(50),
    aktif tinyint(0),
    PRIMARY KEY (user_id)
);

INSERT INTO user VALUES(
	1, "User", "user@mail.com", "$2y$10$9huQH2sBSG2UHNB3nk9.WOWkR6On602LmVz6woMG/KB/A2PCBuheK", NULL, 0
);