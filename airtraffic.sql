/*
flight(flightnum, origination, destination, miles,maxcost,mincost)
manifest(flightnum, dateofflight, passnum, seatnum)
passenger(passnum, fname, lname)
*/

drop table if exists manifest;
drop table if exists passenger;
drop table if exists flight;

create table flight
	(flightnum int primary key,
	origination char(25),
	destination char(25),
	miles int,
	maxcost int,
	mincost int);
	
create table passenger
	(passnum int auto_increment primary key,
	fname varchar(15),
	lname varchar(15));
	
create table manifest
	(flightnum int,
	dateofflight date,
	passnum int,
	seatnum char(5),
	primary key(flightnum, dateofflight, passnum),
	foreign key(flightnum) references flight(flightnum) ,
	foreign key(passnum) references passenger(passnum)) ;

#now put some records in each of the tables
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (100, 'Chicago', 'Denver', 919, 1000, 200);
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (222, 'Chicago', 'Laredo', 1361, 1500, 500);
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (145, 'Saint Louis', 'Chicago', 298, 300, 150);
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (693, 'Miami', 'Denver', 2060, 2500,1200);	
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (694, 'Denver', 'Miami', 2060,2400, 1250);	
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (247, 'Saint Louis', 'Denver', 852, 1000, 604);
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (107, 'Saint Louis', 'Miami', 1216, 1300,805);
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (101, 'Denver', 'Chicago', 919, 1005, 400);
insert into flight (flightnum, origination,destination,miles,maxcost,mincost) 
	values (567, 'Los Angeles', 'Miami', 2734, 3000, 1550);
	
insert into passenger (fname, lname) 
	values ( 'John', 'Doe');
insert into passenger (fname, lname) 
	values ('Michonne','Grimes');
insert into passenger (fname, lname) 
	values ('Mary', 'Brown');
insert into passenger (fname, lname) 
	values ('Sophia', 'Peletier');	
insert into passenger (fname, lname) 
	values ('Dean', 'Winchester');
insert into passenger (fname, lname) 
	values ('Daryl', 'Dixon');		
insert into passenger (fname, lname) 
	values ( 'Jane', 'Doe');
insert into passenger (fname, lname) 
	values ('Rick','Grimes');
insert into passenger (fname, lname) 
	values ('Charlie', 'Brown');
insert into passenger (fname, lname) 
	values ('Luke', 'Spencer');	
insert into passenger (fname, lname) 
	values ('Sam', 'Winchester');
insert into passenger (fname, lname) 
	values ('John', 'Hurt');		
	
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (100, '2014-10-02', 1, 'A34');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (100, '2014-10-02', 10, 'C37');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (100, '2014-10-02', 6, 'A35');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (100, '2014-10-02', 2, 'A01');	
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (222, '2014-10-06', 7, 'A19');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (222, '2014-10-06', 4, 'C38');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (693, '2014-11-02', 10, 'A35');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (693, '2014-11-02', 2, 'C37');		
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (567, '2015-01-15', 5, 'B54');
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (247, '2015-02-19', 1, 'A02');	
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (247, '2015-02-19', 7, 'A01');	
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (247, '2015-02-19', 5, 'C13');	
insert into manifest (flightnum, dateofflight, passnum, seatnum)  
	values (247, '2015-02-19', 11, 'AC14');	