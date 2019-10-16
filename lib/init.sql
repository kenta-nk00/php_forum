create database php_forum;

grant all on php_forum.* to dbuser@localhost identified by 'vagrantVagrant@123';

use php_forum

create table users (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255)
);

desc users;
