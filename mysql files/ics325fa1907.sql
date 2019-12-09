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
  ON DELETE CASCADE
);

create table order_tickets (
order_ticketsID int(11) unsigned not null auto_increment primary key,
orderID int(11) unsigned not null,
ticketID int(11) unsigned not null,
quantity int(11),
total decimal(10,2),
constraint FK_orderID foreign key (orderID)
	references orders(orderID),
constraint FK_ticketID foreign key (ticketID)
	references tickets(ticketID)
  ON DELETE CASCADE
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

insert into artists(Artist_name, Genre, Image) values
  ("Lana Del Rey", "Pop", "artistphotos/Lana_Del_Rey.jfif"),
  ("Angele", "Pop", "artistphotos/Angele.jfif"),
  ("Arctic Monkeys", "Rock", "artistphotos/Arctic_Monkeys.jfif"),
  ("The Hu", "Metal", "artistphotos/The_Hu.jfif"),
  ("Rammstein", "Metal", "artistphotos/Rammstein.jfif"),
  ("Seven Lions", "EDM", "artistphotos/Seven_Lions.jfif"),
  ("Milky Chance", "Rock", "artistphotos/Milky_Chance.jfif"),
  ("Martin Garrix", "EDM", "artistphotos/Martin_Garrix.jfif"),
  ("The Neighbourhood", "Rock", "artistphotos/NBHD.jfif"),
  ("MGMT", "EDM", "artistphotos/MGMT.jfif"),
  ("Cage the Elephant", "Rock", "artistphotos/Cage_the_Elephant.jfif"),
  ("Slander", "EDM", "artistphotos/Slander.jfif"),
  ("Illenium", "EDM", "artistphotos/Illenium.jfif"),
  ("Two Door Cinema", "Pop", "artistphotos/Two_Door_Cinema.jpg");

insert into concerts(Artist, Street, City, Date, Time) values
("Lana Del Rey", "818 Daisy Lane", "Garden", "2019-11-25", "18:00:00"),
("Arctic Monkeys","900 Toto West","Park","2019-11-30","19:00:00"),
("Angele","818 Daisy Lane","Garden","2019-12-05","17:00:00"),
("Seven Lions","123 Bob St.","Bobland","2019-11-28","18:00:00"),
("Two Door Cinema","900 Toto West","Park","2019-12-12","18:00:00"),
("MGMT","818 Daisy Lane","Garden","2019-11-22","18:30:00"),
("Milky Chance","818 Daisy Lane","Garden","2019-11-29","20:00:00"),
("Illenium","999 Cinderblock Rd.","Blocke","2019-12-04","20:00:00"),
("The Hu","567 Fir Way","Woodland","2019-12-01","18:00:00"),
("Slander","123 Bob St.","Bobland","2019-12-05","20:00:00"),
("The Neighbourhood","567 Fir Way","Woodland","2019-12-07","18:30:00"),
("Rammstein","567 Fir Way","Woodland","2019-12-12","20:30:00"),
("Cage the Elephant","900 Toto West","Park","2019-12-20","18:00:00"),
("Martin Garrix","123 Bob St.","Bobland","2019-12-30","20:00:00");

insert into tickets(concertID, Price) values
  (1, "30.00"),
  (2, "40.00"),
  (3, "45.00"),
  (4, "42.00"),
  (5, "51.00"),
  (6, "47.00"),
  (7, "45.00"),
  (8, "50.00"),
  (9, "55.00"),
  (10, "70.00"),
  (11, "65.00"),
  (12, "50.00"),
  (13, "60.00"),
  (14, "50.00");
