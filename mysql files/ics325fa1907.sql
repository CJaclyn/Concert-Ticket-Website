drop database if exists ics325fa1907;
create database ics325fa1907;
use ics325fa1907;

create table artists
(artistID int(11) unsigned not null auto_increment,
Artist_name varchar(25) not null unique,
Genre char(5) not null,
Image varchar(45),
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
  ON DELETE CASCADE
);

create table users (
userID int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
orderID int(11) unsigned not null auto_increment primary key,
date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
userID int(11) unsigned not null,
constraint FK_userID foreign key (userID)
	references users(userID)
);

create table tickets (
ticketID int(11) unsigned not null auto_increment primary key,
concertID int(11) unsigned not null,
Price decimal(10,2) not null,
constraint FK_concertID foreign key (concertID)
	references concerts(concertID)
);

create table order_tickets (
order_ticketsID int(11) unsigned not null auto_increment primary key,
orderID int(11) unsigned not null,
ticketID int(11) unsigned not null,
quantity int(11),
price decimal(10,2),
constraint FK_orderID foreign key (orderID)
	references orders(orderID),
constraint FK_ticketID foreign key (ticketID)
	references tickets(ticketID)
);

create table images (
id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id int(11) NOT NULL,
username varchar(255) NOT NULL,
name varchar(255) NOT NULL,
unique (user_id, name)
);

insert into users(Username, Password, Email, Firstname, Lastname, admin) values
("admin_jc", SHA1("admin123"), "eq6679uu@go.minnstate.edu", "Jaclyn", "C.", 1),
("admin_cs", SHA1("admin123"), "chris@email.com", "Chris", "Schreiber", 1),
("bob123", SHA1("123456"), "bob@email.com", "Bob", "Ert", 0);
