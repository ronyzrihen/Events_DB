

create table team_13_customer(
c_id integer primary key,
f_name varchar(45)not null,
l_name varchar(45) not null,
phone_number varchar(45)not null,
street varchar(45),
city varchar(45)not null,
apt_no integer 
);

INSERT INTO team_13_customer (c_id,f_name, l_name, street, apt_no, city, phone_number)
VALUES (1,'Sarah', 'Cohen', 'Maple Avenue', 15, 'Tel Aviv', '+972-52-1234567'), 
(2,'David', 'Levy', 'Oak Street', 8, 'Haifa', '+972-54-9876543'),
(3,'Rachel', 'Katz', 'Elm Road', 4, 'Jerusalem', '+972-50-2468135'),
 (4,'Benjamin', 'Avrahami', 'Cedar Lane', 12, 'Netanya', '+972-53-5792468'),
 (5,'Maya', 'Cohen', 'Birch Street', 9, 'Eilat', '+972-55-3647129'),
 (6,'Daniel', 'Levy', 'Willow Avenue', 7, 'Beersheba', '+972-52-8765432'),
 (7,'Sarah', 'Mizrahi', 'Pine Road', 33, 'Ashdod', '+972-54-3698521'),
 (8,'David', 'Cohen', 'Cedar Lane', 44, 'Haifa', '+972-50-7539512'),
 (9,'Leah', 'Ben-Haim', 'Elm Street', 14, 'Tel Aviv', '+972-53-8642097'),
 (10,'Yonatan', 'Levi', 'Oak Avenue', 123, 'Jerusalem', '+972-55-9876543');

drop table team_13_customer;
select*from team_13_customer;

create table team_13_worker (
w_id integer primary key,
f_name varchar(45)not null,
l_name varchar(45) not null,
phone_number varchar(45)not null,
street varchar(45),
city varchar(45),
apt_no integer ,
email varchar(45) unique 
);

select * from team_13_worker;

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (1, 'Sarah', 'Cohen', '+972-52-1234567', 'Maple Avenue', 'Tel Aviv', 15);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (2, 'David', 'Levy', '+972-54-9876543', 'Oak Street', 'Haifa', 8);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (3, 'Rachel', 'Katz', '+972-50-2468135', 'Elm Road', 'Jerusalem', 4);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (4, 'Benjamin', 'Avrahami', '+972-53-5792468', 'Cedar Lane', 'Netanya', 12);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (5, 'Maya', 'Cohen', '+972-55-3647129', 'Birch Street', 'Eilat', 9);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (6, 'Daniel', 'Levy', '+972-52-8765432', 'Willow Avenue', 'Beersheba', 7);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (7, 'Sarah', 'Mizrahi', '+972-54-3698521', 'Pine Road', 'Ashdod', 3);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (8, 'David', 'Cohen', '+972-50-7539512', 'Cedar Lane', 'Haifa', 10);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (9, 'Leah', 'Ben-Haim', '+972-53-8642097', 'Elm Street', 'Tel Aviv', 6);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (10, 'Yonatan', 'Levi', '+972-55-9876543', 'Oak Avenue', 'Jerusalem', 2);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (11, 'Avigail', 'Cohen', '+972-53-1234567', 'Maple Lane', 'Tel Aviv', 16);

INSERT INTO team_13_worker (w_id, f_name, l_name, phone_number, street, city, apt_no)
VALUES (12, 'Jonathan', 'Levy', '+972-50-9876543', 'Pine Street', 'Jerusalem', 5);


create table team_13_orders(
o_id integer primary key auto_increment,
c_id int not null,
o_date date unique not null unique,
e_id int not null,  
guest_num int unsigned not null,
min_price int unsigned  not null,
meal_price int unsigned not null,
total_price int unsigned,
foreign key(e_id) references team_13_order_event(e_id) on delete cascade on update cascade,
foreign key(c_id) references team_13_customer(c_id) on delete cascade on update cascade
);

drop table team_13_orders;
select * from team_13_orders;

INSERT INTO team_13_orders (o_id, o_date, c_id ,guest_num, min_price, meal_price,total_price) VALUES 
(1, '2024-01-15',1, 400, 70, 45,18070),(2, '2024-03-10',3, 200, 80, 50, 10080),(3, '2023-08-22',10, 50, 120, 38,11520),(4, '2023-08-05',9, 500, 130, 55,27630),(5, '2022-11-18',2, 200, 90, 32, 6490),
(6, '2023-08-01',5, 600, 100, 75, 45100),(7, '2021-10-12',6, 400, 110, 42,16910),(8, '2023-04-20',10, 300, 140, 50, 15140),
 (9, '2022-06-08',6, 200, 80, 27,5480),(10, '2023-01-02',8, 500, 160, 60, 30160);

create table team_13_event(
e_id integer primary key auto_increment, 
e_type varchar(45) not null
);

drop table team_13_event;
select * from team_13_event;

INSERT INTO team_13_event(e_id, e_type) VALUES
(1,'Wedding'),(2,'Henna'),(3,'Bar Mitzva'),(4,'Conference'),(5,'Seminar'),
(6,'Company party'),(7,'Festival'),(8,'Charity Event'),(9,'Fashion show'),(10,'Exhibition');

create table team_13_order_event(
e_id integer , 
o_id integer,
primary key(o_id),
foreign key(e_id) references team_13_event(e_id)
on delete cascade on update cascade ,
foreign key(o_id) references team_13_orders(o_id)
on delete cascade on update cascade 
);


drop table team_13_order_event;
select * from team_13_order_event;

insert into team_13_order_event(o_id,e_id)values (1,1);
insert into team_13_order_event(o_id,e_id)values (2,5);
insert into team_13_order_event(o_id,e_id)values (3,2);
insert into team_13_order_event(o_id,e_id)values (4,7);
insert into team_13_order_event(o_id,e_id)values (5,8);
insert into team_13_order_event(o_id,e_id)values (6,10);
insert into team_13_order_event(o_id,e_id)values (7,4);
insert into team_13_order_event(o_id,e_id)values (8,10);
insert into team_13_order_event(o_id,e_id)values (9,4);
insert into team_13_order_event(o_id,e_id)values (10,1);








create table team_13_job(
j_id integer primary key auto_increment,
j_name varchar(45) unique not null
);

insert into team_13_job values(1,'salesman');
insert into team_13_job values(2,'cook');
insert into team_13_job values(3,'waiter');

select * from team_13_worker_job;

create table team_13_worker_job(
j_id integer , 
w_id integer,
primary key(j_id , w_id),
foreign key(j_id) references team_13_job(j_id)
on delete cascade on update cascade ,
foreign key(w_id) references team_13_worker(w_id)
on delete cascade on update cascade 
);

insert into team_13_worker_job values (1,1) ;
insert into team_13_worker_job values (1,2) ;
insert into team_13_worker_job values (2,3) ;
insert into team_13_worker_job values (2,4) ;
insert into team_13_worker_job values (3,5) ;
insert into team_13_worker_job values (3,6) ;
insert into team_13_worker_job values (3,7) ;
insert into team_13_worker_job values (3,8) ;
insert into team_13_worker_job values (3,9) ;
insert into team_13_worker_job values (3,10) ;
insert into team_13_worker_job values (2,11) ;
insert into team_13_worker_job values (2,12) ;

create table team_13_order_worker(
w_id integer,
o_id integer, 
unique key(o_id,w_id),
primary key(o_id , w_id),
foreign key(w_id) references team_13_worker(w_id)
on delete cascade on update cascade ,
foreign key(o_id) references team_13_orders(o_id)
on delete cascade on update cascade 
);

select j_name , w_id from team_13_worker inner join team_13_worker_job using(w_id) inner join team_13_job using(j_id); 
drop table team_13_order_worker;

insert into team_13_order_worker(o_id, w_id)values 
(1,3),(1,5),(1,6),(1,7),(1,8),(1,9),(1,2),(2,4),(2,10),(2,9),(2,7),(2,1),(3,1),(3,3),(3,4),(3,5),(3,6),(3,7),(3,8),(3,9),(3,10),(3,11),(3,12),
(4,1),(5,1),(6,2),(7,1),(8,2),(9,2),(10,1);
select * from team_13_order_worker;

-- -----------------------------PROCEDURES----------------------------- --

select * from team_13_orders where o_date between date_sub(now(),INTERVAL 1 WEEK) and now();
select * from team_13_orders inner join team_13_customer using(c_id) where o_date >= now();

-- ------------------------DO LATER---------------------------------------- --
select o_id,o_date, guest_num ,w_count, c_count,n_count from team_13_orders  left join (select o_id, j_id ,count(*) w_count from team_13_order_worker left join team_13_worker_job using(w_id) group by o_id,j_id having j_id = 3 ) as waiters using(o_id)
left join (select o_id, j_id, count(*) c_count from team_13_order_worker left join team_13_worker_job using(w_id) group by o_id,j_id having j_id = 2) cooks using (o_id) 
left join (select o_id, j_id ,count(*) n_count from team_13_orders  left join team_13_order_worker using(o_id) left join team_13_worker_job using(w_id) group by o_id having n_count = 1 ) as nulls using (o_id)
group by o_id having w_count < guest_num / 10 or c_count < guest_num / 20  or n_count =1;

-- ------------------------------------------------------------------------- --

select c_id, f_name, l_name, count(*) from team_13_customer inner join team_13_orders using(c_id) group by c_id having count(*) > 1;
select o_id, (min_price + (meal_price * guest_num)) income  from team_13_orders where o_date between date_sub(now(),INTERVAL 7 MONTH) and now();


select * from team_13_orders  inner join (select o_id, j_id from team_13_order_worker inner join team_13_worker_job using(w_id) where j_id = 3 ) as a using(o_id)  ;
select count(*) from team_13_orders  inner join (select o_id, j_id from team_13_order_worker inner join team_13_worker_job using(w_id) where j_id = 3 and o_id = 2) as a using(o_id) group by o_id;
select * from team_13_orders inner join team_13_order_worker using(o_id) where o_id = 3;


-- -----------------------------PROCEDURES----------------------------- --

call worker_assingment(11,1);
drop procedure worker_assingment; -- delete later

DELIMITER $$ 
create procedure worker_assingment(workerID int , orderID int)
BEGIN
	DECLARE oDate DATE;
	DECLARE w_num INT;
    DECLARE errorMsg varchar(45);
    
	SET errorMsg = "WORKER ASSIGNED!";
	SET oDate = (select o_date from team_13_orders where o_id = orderID );
	IF (oDate >= Now()) 
	THEN
		IF ((select j_id from team_13_worker_job where w_id = workerID) = 3) -- check if worker is a waiter
        THEN
		SET w_num =  (select count(*) from team_13_orders  inner join (select o_id, j_id from team_13_order_worker inner join team_13_worker_job using(w_id) where j_id = 3 and o_id = orderID) as a using(o_id) group by o_id);
       
			IF ( w_num < (select guest_num / 10 from team_13_orders where o_id = orderID)) -- required number of waiters
			THEN
					insert into team_13_order_worker(o_id, w_id) values (orderID,workerID);
                    select errorMsg;
			ELSE
				set errorMsg = "TOO MANY WAITERS! WORKER WAS NOT ASSIGNED";
				select errorMsg;
			END IF; 
            
		ELSE IF ((select j_id from team_13_worker_job where w_id = workerID) = 2) -- check if worker is a cook
        THEN
       
			SET w_num =  (select count(*) from team_13_orders  inner join (select o_id, j_id from team_13_order_worker inner join team_13_worker_job using(w_id) where j_id = 2 and o_id = orderID) as a using(o_id) group by o_id);
			IF ( w_num < (select guest_num / 20 from team_13_orders where o_id = orderID))
			THEN
					insert into team_13_order_worker(o_id, w_id) values (orderID,workerID);
                    select errorMsg;
			ELSE
				set errorMsg = "TOO MANY COOKS! WORKER WAS NOT ASSIGNED";
				select errorMsg;
			END IF; 
		END IF;

	END IF;	
END IF;	
END; $$
DELIMITER ;

DELIMITER $$ 
create procedure give_discount(dorderID int, discount int)
BEGIN
	UPDATE team_13_orders
	SET
		total_price = total_price - (total_price * discount / 100 )
	where o_id = dorderID;
END $$
DELIMITER ;

-- ------------------------------------------------------------------- --
-- -----------------------------FUNCTIONS----------------------------- --
DELIMITER $$
CREATE FUNCTION monthly_income(fName varchar(45), lName varchar(45) , in_month int , in_year int) RETURNS INT
BEGIN 
DECLARE income INT default 0;
select SUM(total_price) INTO income from team_13_orders inner join  team_13_order_worker using(o_id) inner join team_13_worker using(w_id) 
WHERE f_name = fName 
AND l_name = lName 
AND YEAR(o_date) = in_year
AND MONTH(o_date) = in_month ;

RETURN income;    

END; $$
DELIMITER ;
-- ------------------------------------------------------------------- --
drop function monthly_income; 

select monthly_income("Sarah", "Cohen",8 , 2023) ;

-- -----------------------------TRIGGERS----------------------------- --
 DELIMITER $$
 CREATE TRIGGER calc_total_cost BEFORE INSERT ON team_13_orders FOR EACH ROW 
 BEGIN
SET 
    NEW.total_price = NEW.min_price + (NEW.guest_num * NEW.meal_price) ;
 END $$
 DELIMITER ;
-- ------------------------------------------------------------------- --
drop trigger calc_total_cost;
insert into team_13_orders (c_id, o_date, guest_num , min_price, meal_price) values (10, "2023-12-10",40, 3000, 100);
select * from team_13_orders;

