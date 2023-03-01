-- # create databases
CREATE DATABASE IF NOT EXISTS `db`;
CREATE DATABASE IF NOT EXISTS `proton_mail_global`;
CREATE DATABASE IF NOT EXISTS `proton_mail_shard`;

-- # create root user and grant rights
CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';

-- # create root user and grant rights
CREATE USER IF NOT EXISTS 'db'@'localhost' IDENTIFIED BY 'db';
GRANT ALL PRIVILEGES ON db.* TO 'db'@'%';
GRANT ALL PRIVILEGES ON proton_mail_global.* TO 'db'@'%';
GRANT ALL PRIVILEGES ON proton_mail_shard.* TO 'db'@'%';