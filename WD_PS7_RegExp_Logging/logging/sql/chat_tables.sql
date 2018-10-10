CREATE TABLE users (
    id int(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT NULL,
    password varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE UNIQUE INDEX users_username_uindex ON users (username);

CREATE TABLE messages (
    id int(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    message varchar(255) NOT NULL,
    user_id int(10) unsigned NOT NULL,
    time timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
