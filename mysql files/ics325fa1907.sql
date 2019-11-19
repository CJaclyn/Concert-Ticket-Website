drop database if exists ics325fa1907;
create database ics325fa1907;
use ics325fa1907;

create table artists
(artistID int(11) unsigned not null auto_increment,
Artist_name varchar(25) not null unique,
Genre char(5) not null,
Image varchar(45) not null,
primary key (artistID)
);

create table concerts
(concertID int(11) unsigned not null auto_increment,
Artist varchar(25) not null,
Street varchar(25) not null,
City varchar(25) not null,
State char(2) not null default 'MN',
Date date not null,
Time time not null default '18:00:00',
primary key (concertID),
constraint FK_artist foreign key (Artist)
references artists(Artist_name)
);

create table users (
userID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
Username varchar(25) NOT NULL,
Password varchar(255) NOT NULL,
Email varchar(50) NOT NULL,
Firstname varchar(25) NOT NULL,
Lastname varchar(25) NOT NULL,
Street varchar(25),
City varchar(25),
State varchar(25),
prof_picture varchar(50),
created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
admin tinyint(1) not null default '0'
);

create table orders (
orderID int(11) unsigned not null auto_increment,
userID int(11) not null,
amount decimal(10,2),
primary key (orderID),
constraint FK_userID foreign key (userID)
references users(userID)
);

create table tickets (
ticketID int(11) unsigned not null auto_increment,
concertID int(11) unsigned not null,
orderID int(11) unsigned not null,
Price decimal(10,2) not null,
primary key (ticketID),
constraint FK_concertID foreign key (concertID)
references concerts(concertID),
constraint FK_orderID foreign key (orderID)
references orders(orderID)
);

create table images (
id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id int(11) NOT NULL,
username varchar(255) NOT NULL,
name varchar(255) NOT NULL,
unique (user_id, name)
);