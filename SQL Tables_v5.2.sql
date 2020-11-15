drop database if exists wadproject;
create schema wadproject;
use wadproject;

create table login(
userid  varchar(50) not null,
email  varchar(50) not null,
firstname varchar(50) not null,
lastname varchar(50) not null,
password varchar(50) not null, 
isverified boolean not null, 
country varchar(50) not null,
address varchar(95) not null, /*weicheng added*/
profilepic varchar(1000) null,
constraint login_pk primary key(userid)
);

-- whole itinerary
create table itinerary(
itineraryid int NOT NULL AUTO_INCREMENT,
itineraryowner varchar(50) not null,
tourtitle varchar(100) not null,
tourcategory varchar(50) not null,
country varchar(50) not null,
price decimal(7,2) not null,
thumbnail varchar(1000) not null, 
season varchar(50) not null,
generaldetails varchar(10000) not null,  
constraint itinerary_pk primary key (itineraryid),
constraint itinerary_fk1 foreign key(itineraryowner) references login(userid));


-- individual  activity
create table itinerary_details(
detailsid int NOT NULL AUTO_INCREMENT,
itineraryid int not null, 
itineraryowner varchar(50) not null, 
daynumber int not null, 
location varchar(50) not null,  
activity varchar(50) not null, 
activitynumber int not null, 
description varchar(1000) not null,
starttime time not null,
endtime time not null, 
constraint itinerary_details_pk primary key (detailsid),
constraint itinerary_details_fk1 foreign key(itineraryowner) references login(userid),
constraint itinerary_details_fk2 foreign key(itineraryid) references itinerary(itineraryid)
);


create table add_cart(
userid varchar(50) not null, 
itineraryid int not null,
constraint add_cart_pk primary key (userid, itineraryid),
constraint add_cart_fk1 foreign key (itineraryid) references itinerary(itineraryid), 
constraint add_cart_fk2 foreign key(userid) references login(userid)
);


create table review_table(
reviewid int NOT NULL AUTO_INCREMENT,
userid varchar(50) not null,
itineraryid int not null,
rate decimal(4,2) not null,
status varchar(50) not null, 
message varchar(45) not null,
date varchar(100) not null,
constraint review_table_pk primary key(reviewid),
constraint review_table_fk1 foreign key (itineraryid) references itinerary(itineraryid),
constraint review_table_fk2 foreign key (userid) references login(userid)
);

create table reviewdetails(
ReviewdetailsID int NOT NULL auto_increment,
reviewid int not null,
itinerary_details varchar(45),
ActivityRate int,
comments varchar(45),
constraint ReviewdetailsID_pk primary key(ReviewdetailsID),
constraint reviewdetails_fk1 foreign key(reviewid) references review_table(reviewid)
);

create table make_payment(
paymentid int NOT NULL AUTO_INCREMENT,
billingemail varchar(100) not null,
datebought TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
constraint payment_pk primary key(paymentid)

);



create table payment(
paymentid int NOT NULL,
userid varchar(50) not null,
itineraryowner varchar(50) not null,
itineraryid int not null,
ispaid boolean not null,
billingemail varchar(100) not null,
constraint payment_pk primary key(paymentid, itineraryowner, itineraryid),
constraint payment_fk1 foreign key (itineraryowner, itineraryid) references itinerary(itineraryowner, itineraryid),
constraint payment_fk2 foreign key (userid) references login(userid)
);


create table itinerary_purchased(
userid  varchar(50) not null,
itineraryid int NOT NULL AUTO_INCREMENT,
itineraryowner varchar(50) not null,
tourtitle varchar(100) not null,
tourcategory varchar(50) not null,
country varchar(50) not null,
price decimal(7,2) not null,
thumbnail varchar(1000) not null, 
season varchar(50) not null, 
generaldetails varchar(10000) not null,  
constraint itinerary_purchased_pk primary key (userid, itineraryid),
constraint itinerary_purchased_fk1 foreign key(itineraryid) references itinerary(itineraryid),
constraint itinerary_purchased_fk2 foreign key(userid) references login(userid));



create table itinerary_details_purchased(
userid  varchar(50) not null,
detailsid int NOT NULL AUTO_INCREMENT,
itineraryid int not null, 
itineraryowner varchar(50) not null, 
daynumber int not null, 
location varchar(50) not null,  
activity varchar(50) not null, 
activitynumber int not null, 
description varchar(1000) not null,
starttime time not null,
endtime time not null,	 
constraint itinerary_details_purchased_pk primary key (userid, detailsid),
constraint itinerary_details_purchased_fk1 foreign key(detailsid) references itinerary_details(detailsid),
constraint itinerary_details_purchased_fk2 foreign key(userid) references login(userid));



create table statistics_table(
statisticsID int NOT NULL AUTO_INCREMENT,
Country varchar(50) not null,
count int not null, 
month varchar(50) not null, 
constraint staistics_table_pk primary key (statisticsID));



insert into login values ("tim", "tim@gmail.com", "Tim", "Chia", "timchia", true, "Singapore", "9 King Albert Park, 01-01/02, Singapore 598332", "image.html");
insert into login values ("elvis", "elvis@gmail.com", "Elvis", "Ng", "timchia", true, "Malaysia", "4 Hillview Rise, #02-01, Singapore 667979", "image.html");
insert into login values ("xiuling", "xiuling@gmail.com", "Xiuling", "Chua", "timchia", true, "Korea", "18 N Canal Rd, Singapore 048830", "image.html");
insert into login values ("jiaqi", "jiaqi@gmail.com", "Jia Qi", "Chia", "timchia", true, "Japan", "4 Hillview Rise, #02-01, Singapore 667979", "image.html");
insert into login values ("biguang", "biguang@gmail.com", "Chua", "Bi Guang", "timchia", true, "Singapore", "2 Choa Chu Kang Loop, #01-03, Singapore 689687", "image.html");
insert into login values ("David", "david@gmail.com", "David", "Chang", "timchia", true, "Indonesia", "22 Orange Grove Rd, Level One, Garden Wing, Singapore 258350", "image.html");
insert into login values ("John", "john@gmail.com", "John", "Ng", "timchia", true, "Malaysia", "1 Scotts Rd, #01 - 16 Shaw Centre, Singapore 228208", "image.html");
insert into login values ("Mary", "mary@gmail.com", "Mary", "Tan", "timchia", true, "Singapore", "3 Chu Lin Rd, Singapore 669890", "image.html");
insert into login values ("KZ", "kz@gmail.com", "KZ", "Jones", "timchia", true, "Vietnam", "1 St Andrew's Rd, #01-04 National Gallery, Singapore 178957", "image.html");
insert into login values ("Marcus", "marcus@gmail.com", "Marcus", "Chan", "timchia", true, "Japan", "4 Hillview Rise, #02-01, Singapore 667979", "image.html");
insert into login values ("weicheng", "weicheng@gmail.com", "Wei Cheng", "Ng", "timchia", true, "Japan", "4 Hillview Rise, #02-01, Singapore 667979", "image.html");



-- itinerary 1 (Tim)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("tim", "7D6N Taiwan Alishan & Sun Moon Lake", "Nature exploration", "Taiwan", 150, "https://c8.alamy.com/comp/T4H2RK/alishan-taiwan-december-6-2018-train-ride-from-alishan-forest-railway-station-to-go-around-the-forest-in-alishan-taiwan-T4H2RK.jpg", "winter", "The places that 
are included are Taipei, Shihfen, Sky Lantern, Haoke Sanshing Farm Experience, Aboriginal Culture, Sun Moon Lake and Alishan" );

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 1, "Airport", "Travelling", 1, "Travel to Taipei Taoyuan", "12:30", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 1, "National CKS Memorial Hall", "Culture", 2, "Explore National CKS Memorial Hall where you can 
understand the history of Taiwan", "18:00", "19:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 1, "Shilin Night Market", "Dinner", 3, "There is a variety of food available at ShiLin night market
where the traveller can choose from. At the night market, there is no fear that they are 
unable to find the food they want", "19:00", "23:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 2, "Yilan", "Sight seeing", 4, "Early in the morning, they can travel to yilan by the train avaiable
On the way to the destination, they can enjoy the bento on the train", "9:00", "11:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 2, "Friendly Garden- Farm Experience", "Experience", 5, "Experience what it is like to be a farmer! Join us at the
friendly garden to have a taste of it ", "13:00", "15:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 2, "Hakka Museum", "Culture", 6, "Understand about the culture of Hakka. The museum includes lots of items
from the past that you will not be able to see elsewhere", "16:00", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 2, "Gaomei Wetland", "Sight seeing", 7, "At Gaomei Wetland, travellers will get to see the nice scenery. 
The place is very relaxing, allowing us to slow down our pace of life", "18:00", "19:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 3, " 921 Earthquake Museum", "Culture", 8, "Start off the day by visiting the Museum understand about the 921 Earthquake  ", "9:00", "10:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 3, " Nantou", "Sight seeing", 9, "A relaxing place where traveller can just go and have a walk around the area", "11:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 3, "Wenwu Temple", "Sight seeing", 10, "Temples are very common in Taiwan! You don't have to be a taoist to visit
one. Come in and take a look. You will be amaze by it!", "15:00", "16:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 4, "Alishan National Forest Recreation Area-Sisters Lakes", "Sight seeing", 11, "Alishan is so big that you 
will be able to have fun through out the day. This is guaranteed that its gonna be fun!!!!!!", "8:00", "19:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 5, "Hinoki Village", "Sight seeing", 12, "Hinoki Village? Come in and take a look! Not only 
do you get to enjoy the location, you also get to interact with the rest of the villages!", "10:00", "13:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 5, "Night Market", "Eating and shopping", 13, "Have no where to spend your money? Night market is definitely 
the way to go! Not only is there food, there is also lots of things to buy too!", "10:00", "13:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 6, "Shihfen-Release Sky Lantern", "Sight seeing", 14, "Make a wish! Sky lantern is the olden day of making a wish! 
Definitely a signature event that you can't afford to miss out", "8:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 6, "Shihfen Waterfall", "Sight seeing", 15, "Waterfall is definitely another signseeing location that nature 
lovers will definitely enjoy! What are you waiting for? Be sure to visit the place!", "16:00", "18:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(1, "tim", 7, "Airport", "Travel", 16, "Sadly, there is an end to everything! 
It's time to go home and get back to reality:(", "13:00", "18:00");



-- itinerary 2 (Tim)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("tim", "4D3N Short Getaway to Taiwan", "City exploration", "Taiwan", 40, "https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Taipei_Skyline_2020.jpg/1200px-Taipei_Skyline_2020.jpg", "Summer",
 "A short getaway with a very chill schedule! Explore the cities that are within reach. Places include Taipei 101, shilin night market and more!" );

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 1, "Airport", "Travelling", 1, "Travel to Taipei Taoyuan", "9:00", "13:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 1, "Hinoki Village", "Sight seeing", 12, "Hinoki Village? Come in and take a look! Not only 
do you get to enjoy the location, you also get to interact with the rest of the villages!", "15:00", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 1, "Night Market", "Eating and shopping", 13, "Have no where to spend your money? Night market is definitely 
the way to go! Not only is there food, there is also lots of things to buy too!", "17:00", "20:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 2, "National CKS Memorial Hall", "Culture", 2, "Explore National CKS Memorial Hall where you can 
understand the history of Taiwan", "18:00", "19:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 2, "Shilin Night Market", "Dinner", 3, "There is a variety of food available at ShiLin night market
where the traveller can choose from. At the night market, there is no fear that they are 
unable to find the food they want", "19:00", "23:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 3, "Taipei 101", "Sight seeing", 14, "View the skyline from the highest building in Taiwan. Enjoy
 your breakfast from there", "8:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 3, "Shihfen Waterfall", "Sight seeing", 15, "Waterfall is definitely another signseeing location that nature 
lovers will definitely enjoy! What are you waiting for? Be sure to visit the place!", "16:00", "18:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 4, "Airport", "Travel", 16, "Sadly, there is an end to everything! 
It's time to go home and get back to reality:(", "13:00", "18:00");



-- itinerary 3 (Tim)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("tim", "4D3N Fall Trip to Taiwan", "City exploration", "Taiwan", 40, "https://cdn.britannica.com/s:800x450,c:crop/19/189419-138-D01DC688/video-Taipei.jpg", "fall",
 "A short getaway with a very chill schedule! Explore the cities that are within reach. Places include Taipei 101, shilin night market and more!" );

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 1, "Airport", "Travelling", 1, "Travel to Taipei Taoyuan", "9:00", "13:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 1, "Hinoki Village", "Sight seeing", 12, "Hinoki Village? Come in and take a look! Not only 
do you get to enjoy the location, you also get to interact with the rest of the villages!", "15:00", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 1, "Night Market", "Eating and shopping", 13, "Have no where to spend your money? Night market is definitely 
the way to go! Not only is there food, there is also lots of things to buy too!", "17:00", "20:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 2, "National CKS Memorial Hall", "Culture", 2, "Explore National CKS Memorial Hall where you can 
understand the history of Taiwan", "18:00", "19:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 2, "Shilin Night Market", "Dinner", 3, "There is a variety of food available at ShiLin night market
where the traveller can choose from. At the night market, there is no fear that they are 
unable to find the food they want", "19:00", "23:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 3, "Taipei 101", "Sight seeing", 14, "View the skyline from the highest building in Taiwan. Enjoy
 your breakfast from there", "8:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 3, "Shihfen Waterfall", "Sight seeing", 15, "Waterfall is definitely another signseeing location that nature 
lovers will definitely enjoy! What are you waiting for? Be sure to visit the place!", "16:00", "18:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(2, "tim", 4, "Airport", "Travel", 16, "Sadly, there is an end to everything! 
It's time to go home and get back to reality:(", "13:00", "18:00");




-- itinerary 4 (Xiuling)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("xiuling", "7D6N Taiwan Alishan & Sun Moon Lake", "Nature exploration", "Taiwan", 150, "https://theculturetrip.com/wp-content/uploads/2017/05/taipei_taiwan_chiang_kai_shek_memorial_hall.jpg", "winter", "The places that 
are included are Taipei, Shihfen, Sky Lantern, Haoke Sanshing Farm Experience, Aboriginal Culture, Sun Moon Lake and Alishan" );

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 1, "Airport", "Travelling", 1, "Travel to Taipei Taoyuan", "12:30", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 1, "National CKS Memorial Hall", "Culture", 2, "Explore National CKS Memorial Hall where you can 
understand the history of Taiwan", "18:00", "19:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 1, "Shilin Night Market", "Dinner", 3, "There is a variety of food available at ShiLin night market
where the traveller can choose from. At the night market, there is no fear that they are 
unable to find the food they want", "19:00", "23:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 2, "Yilan", "Sight seeing", 4, "Early in the morning, they can travel to yilan by the train avaiable
On the way to the destination, they can enjoy the bento on the train", "9:00", "11:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 2, "Friendly Garden- Farm Experience", "Experience", 5, "Experience what it is like to be a farmer! Join us at the
friendly garden to have a taste of it ", "13:00", "15:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 2, "Hakka Museum", "Culture", 6, "Understand about the culture of Hakka. The museum includes lots of items
from the past that you will not be able to see elsewhere", "16:00", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 2, "Gaomei Wetland", "Sight seeing", 7, "At Gaomei Wetland, travellers will get to see the nice scenery. 
The place is very relaxing, allowing us to slow down our pace of life", "18:00", "19:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 3, " 921 Earthquake Museum", "Culture", 8, "Start off the day by visiting the Museum understand about the 921 Earthquake  ", "9:00", "10:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 3, " Nantou", "Sight seeing", 9, "A relaxing place where traveller can just go and have a walk around the area", "11:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 3, "Wenwu Temple", "Sight seeing", 10, "Temples are very common in Taiwan! You don't have to be a taoist to visit
one. Come in and take a look. You will be amaze by it!", "15:00", "16:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 4, "Alishan National Forest Recreation Area-Sisters Lakes", "Sight seeing", 11, "Alishan is so big that you 
will be able to have fun through out the day. This is guaranteed that its gonna be fun!!!!!!", "8:00", "19:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 5, "Hinoki Village", "Sight seeing", 12, "Hinoki Village? Come in and take a look! Not only 
do you get to enjoy the location, you also get to interact with the rest of the villages!", "10:00", "13:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 5, "Night Market", "Eating and shopping", 13, "Have no where to spend your money? Night market is definitely 
the way to go! Not only is there food, there is also lots of things to buy too!", "10:00", "13:00");


insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 6, "Shihfen-Release Sky Lantern", "Sight seeing", 14, "Make a wish! Sky lantern is the olden day of making a wish! 
Definitely a signature event that you can't afford to miss out", "8:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 6, "Shihfen Waterfall", "Sight seeing", 15, "Waterfall is definitely another signseeing location that nature 
lovers will definitely enjoy! What are you waiting for? Be sure to visit the place!", "16:00", "18:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(4, "xiuling", 7, "Airport", "Travel", 16, "Sadly, there is an end to everything! 
It's time to go home and get back to reality:(", "13:00", "18:00");



-- itinerary 5 (Xiuling)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("xiuling", "4D3N Short Getaway to Taiwan", "City exploration", "Taiwan", 60, "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQmtTiF9XwTVpXeEAzbROT2iNA2Wt1llkVmKw&usqp=CAU", "fall",
 "A short getaway with a very chill schedule! Explore the cities that are within reach. Places include Taipei 101, shilin night market and more!" );

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 1, "Airport", "Travelling", 1, "Travel to Taipei Taoyuan", "9:00", "13:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 1, "Hinoki Village", "Sight seeing", 12, "Hinoki Village? Come in and take a look! Not only 
do you get to enjoy the location, you also get to interact with the rest of the villages!", "15:00", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 1, "Night Market", "Eating and shopping", 13, "Have no where to spend your money? Night market is definitely 
the way to go! Not only is there food, there is also lots of things to buy too!", "17:00", "20:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 2, "National CKS Memorial Hall", "Culture", 2, "Explore National CKS Memorial Hall where you can 
understand the history of Taiwan", "18:00", "19:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 2, "Shilin Night Market", "Dinner", 3, "There is a variety of food available at ShiLin night market
where the traveller can choose from. At the night market, there is no fear that they are 
unable to find the food they want", "19:00", "23:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 3, "Taipei 101", "Sight seeing", 14, "View the skyline from the highest building in Taiwan. Enjoy
 your breakfast from there", "8:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 3, "Shihfen Waterfall", "Sight seeing", 15, "Waterfall is definitely another signseeing location that nature 
lovers will definitely enjoy! What are you waiting for? Be sure to visit the place!", "16:00", "18:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(5, "xiuling", 4, "Airport", "Travel", 16, "Sadly, there is an end to everything! 
It's time to go home and get back to reality:(", "13:00", "18:00");



-- itinerary 6 (Xiuling)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("xiuling", "4D3N Fall Trip to Taiwan", "City exploration", "Taiwan", 45, "https://assets.bwbx.io/images/users/iqjWHBFdfxIU/i.q.2eJCoLnA/v1/1000x-1.jpg", "spring",
 "A short getaway with a very chill schedule! Explore the cities that are within reach. Places include Taipei 101, shilin night market and more!" );

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 1, "Airport", "Travelling", 1, "Travel to Taipei Taoyuan", "9:00", "13:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 1, "Hinoki Village", "Sight seeing", 12, "Hinoki Village? Come in and take a look! Not only 
do you get to enjoy the location, you also get to interact with the rest of the villages!", "15:00", "17:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 1, "Night Market", "Eating and shopping", 13, "Have no where to spend your money? Night market is definitely 
the way to go! Not only is there food, there is also lots of things to buy too!", "17:00", "20:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 2, "National CKS Memorial Hall", "Culture", 2, "Explore National CKS Memorial Hall where you can 
understand the history of Taiwan", "18:00", "19:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 2, "Shilin Night Market", "Dinner", 3, "There is a variety of food available at ShiLin night market
where the traveller can choose from. At the night market, there is no fear that they are 
unable to find the food they want", "19:00", "23:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 3, "Taipei 101", "Sight seeing", 14, "View the skyline from the highest building in Taiwan. Enjoy
 your breakfast from there", "8:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 3, "Shihfen Waterfall", "Sight seeing", 15, "Waterfall is definitely another signseeing location that nature 
lovers will definitely enjoy! What are you waiting for? Be sure to visit the place!", "16:00", "18:00");

insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(6, "xiuling", 4, "Airport", "Travel", 16, "Sadly, there is an end to everything! 
It's time to go home and get back to reality:(", "13:00", "18:00");




-- itinerary 7 (KZ)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("KZ", "3D2N Short trip to Penang", "Budget Trip", "Malaysia", 15, "https://i.ytimg.com/vi/iIDNehPbELw/maxresdefault.jpg", "summer",
 "Penang is not penang without the good food. In this tour, you get to enjoy all the famous food in penang. You won't be able
 to get this anywhere" );
 
 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(7, "KZ", 1, "Market", "Eat", 16, "Go to the market near penang island to get your first meal!", "13:00", "18:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(7, "KZ", 1, "George Town", "Eat", 16, "Do i really still need to explain George Town? 
I'm sure you have hear about it", "19:00", "20:00");

 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(7, "KZ", 2, "Cheah Kongsi", "Sight seeing", 16, "Go to the temple to get your fortune told! It's super accurate!!", "10:00", "12:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(7, "KZ", 2, "Dr. Sun Yat Sen’s Penang Base", "Eat", 16, "It's not the typcial cultural trip you
 are expecting. There is good food here too", "13:00", "18:00");
 
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(7, "KZ", 3, "Kapitan Keling Mosque in Penang", "Sight seeing", 16, "Mosque that is built on the water is 
definitely one of the attraction here", "11:00", "14:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(7, "KZ", 3, "Hill & Temple Sightseeing", "Eat", 16, "It's not the typcial cultural trip you
 are expecting. There is good food here too", "15:00", "18:00");
 
 
 
 -- itinerary 8 (KZ)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("KZ", "2D1N Short trip to Penang", "Budget Trip", "Malaysia", 15, "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTolSstTEYKesz7DbRnkW_1qaZ-sVpTkxim6Jd-47hAqWVKyCd0nYx6SiLFqtw6xMheGWMEQVlYxJx3VLLbW_PfAUHtud43XkXLCNHbIRM&usqp=CAU&ec=45725304", "summer",
 "Penang is not penang without the good food. In this tour, you get to enjoy all the famous food in penang. You won't be able
 to get this anywhere" );
 
 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(8, "KZ", 1, "Market", "Eat", 16, "Go to the market near penang island to get your first meal!", "13:00", "18:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(8, "KZ", 1, "George Town", "Eat", 16, "Do i really still need to explain George Town? 
I'm sure you have hear about it", "19:00", "20:00");

 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(8, "KZ", 2, "Cheah Kongsi", "Sight seeing", 16, "Go to the temple to get your fortune told! It's super accurate!!", "10:00", "12:00");
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(8, "KZ", 2, "Dr. Sun Yat Sen’s Penang Base", "Eat", 16, "It's not the typcial cultural trip you
 are expecting. There is good food here too", "13:00", "18:00");
 


 -- itinerary 9 (Marcus)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("Marcus", "2D1N Short trip to Bintan", "Luxury Trip", "Indonesia", 15, "https://www.nevistas.com/ul/4/2019/07/22/02.jpg", "summer",
 "2 day trip in the villa! Enjoy the swim at the beach and enjoy food cooked by 5 star restaurant chef" );
 
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(9, "Marcus", 1, "Nirwana Resort Hotel- Golf", "Play", 16, "Play golf together with your friends", "10:00", "12:00");
 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(9, "Marcus", 1, "Nirwana Resort Hotel- Swim", "Play", 16, "Take a swim at the resort! Is more relaxing than you think it is
gonna be!", "13:00", "18:00");

 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(9, "Marcus", 2, "ABSSSS Restraunt", "Eat", 16, "Doesn't sound good? I'll make sure it taste good. Enjoy your brunch at this place!", "10:00", "12:00");
 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(9, "Marcus", 2, "Funky Desert", "Eat", 16, "Insufficient food? Desert is the way to go. They serve very nice blended ice here!", "13:00", "18:00");



 -- itinerary 10 (Marcus)
insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
("Marcus", "2D1N Short trip to Bintan", "Luxury Trip", "Indonesia", 15, "https://www.asiaone.com/sites/default/files/original_images/Nov2019/20191121_bintan-glamping_instagram.jpg", "summer",
 "2 day trip in the villa! Enjoy the swim at the beach and enjoy food cooked by 5 star restaurant chef" );
 
insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(10, "Marcus", 1, "Nirwana Resort Hotel- Golf", "Play", 16, "Play golf together with your friends", "10:00", "12:00");
 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(10, "Marcus", 1, "Nirwana Resort Hotel- Swim", "Play", 16, "Take a swim at the resort! Is more relaxing than you think it is
gonna be!", "13:00", "18:00");

 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(10, "Marcus", 2, "ABSSSS Restraunt", "Eat", 16, "Doesn't sound good? I'll make sure it taste good. Enjoy your brunch at this place!", "10:00", "12:00");
 insert into itinerary_details(itineraryid, itineraryowner, daynumber, location, activity, activitynumber, description, starttime, endtime) values
(10, "Marcus", 2, "Funky Desert", "Eat", 16, "Insufficient food? Desert is the way to go. They serve very nice blended ice here!", "13:00", "18:00");



insert into add_cart values("tim", 2);
insert into add_cart values("tim", 1);
insert into add_cart values("tim", 3);
insert into add_cart values("tim", 4);
insert into add_cart values("tim", 5);


insert into add_cart values("jiaqi", 2);
insert into add_cart values("jiaqi", 10);
insert into add_cart values("jiaqi", 8);
insert into add_cart values("jiaqi", 6);
insert into add_cart values("jiaqi", 5);

insert into add_cart values("weicheng", 2);
insert into add_cart values("weicheng", 4);
insert into add_cart values("weicheng", 8);
insert into add_cart values("weicheng", 9);
insert into add_cart values("weicheng", 7);


insert into review_table(userid, itineraryid, rate, status, message, date) values
("weicheng", 2, 4, true, "I really enjoy the trip!", "18 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("weicheng", 4, 4, true, "Love the planning", "8 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("weicheng", 8,4, true, "It was beyond what I expected! Would definitely purchase again", "1 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("weicheng", 9,3.5, true, "Love Love Love!", "27 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("weicheng", 7, 5,true, "I would definitely come back again", "27 Novemeber 2020");

insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 2, 3,true, "I really enjoy the trip!", "18 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 10, 5,true, "Love the planning", "8 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 8, 5,true, "It was beyond what I expected! Would definitely purchase again", "1 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 6, 3.5,true, "Love Love Love!", "27 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 5, 4.5,true, "Love Love Love!", "27 Novemeber 2020");


insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 2,3, true, "I really enjoy myself there", "18 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 1, 5,true, "Love the planning", "8 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 3,5, true, "It was beyond what I expected! Would definitely purchase again", "1 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 4, 4,true, "Love Love Love!", "27 Novemeber 2020");
insert into review_table(userid, itineraryid, rate, status, message, date) values
("jiaqi", 5, 5,true, "Love Love Love!", "27 Novemeber 2020");


insert into statistics_table values('1', 'singapore', '30', 'January');
insert into statistics_table values('2', 'singapore', '30', 'Feb');
insert into statistics_table values('3', 'singapore', '40', 'January');
insert into statistics_table values('4', 'singapore', '70', 'March');
insert into statistics_table values('5', 'singapore', '80', 'June');
insert into statistics_table values('6', 'singapore', '40', 'June');
insert into statistics_table values('7', 'singapore', '20', 'July');
insert into statistics_table values('8', 'singapore', '70', 'August');
insert into statistics_table values('9', 'singapore', '80', 'January');








-- insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
-- ("tim", "5d4n europe", "shopping", "spain", 300, "korea.jpg", "winter");

-- insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
-- ("xiuling", "europe 5d4n", "shopping", "spain", 400, "korea.jpg", "summer");

-- insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
-- ("tim", "australia 6d5n", "adventure", "australia", 300, "korea.jpg", "fall");

-- insert into itinerary(itineraryowner, tourtitle,tourcategory,country,  price, thumbnail, season, generaldetails) values 
-- ("tim", "china tour", "shopping", "chiana", 300, "korea.jpg", "winter");












