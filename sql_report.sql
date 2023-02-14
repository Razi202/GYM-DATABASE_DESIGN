drop table dailyreport;
drop table exercise;
drop table plan;
drop table signup;


create table signup(CNIC number(38), first_name varchar2(200) not null, last_name varchar2(200) not null, email varchar2(100) not null, password varchar2(100) not null, gender varchar2(20) not null, height number(20, 2), age number(20) not null, PRIMARY KEY (CNIC));

insert into signup values (1762,'Razi','Bhatti', 'razihaiderbhatti@gmail.com', 1234, 'Male',1.7, 20);


create table plan(pid number(38), cnic number(38), days varchar2(100), start_time varchar2(100), end_time varchar2(100), protein number(38), fat number(38), carbo number(38), FOREIGN KEY (cnic) references signup(cnic), PRIMARY KEY(pid));

insert into plan values (1, 1762,'Monday','2:10', '6:20', 10, 20, 30);


create table exercise(eid number(38), cnic number(38), plan_id number(38), days varchar2(100), type varchar2(100), equipment varchar2(100), body_part varchar2(100), FOREIGN KEY(cnic) references signup(cnic), FOREIGN KEY(plan_id) references plan(pid), PRIMARY KEY(eid));

insert into exercise values (1, 1762, 1,'Monday','Cardio', 'Treadmill', 'Thighs');


create table dailyreport(date_ varchar2(100), cnic number(38), hours_worked number(38), calories_burned number(38), weight number(38), bmi number(38), PRIMARY KEY(date_));

insert into dailyreport values('6/16/2021', 1762, 3, 230, 60, 2);


select date_ from dailyreport where cnic=1762;

select days from plan where cnic=1762;

select protein from plan where cnic=1762;

select fat from plan where cnic=1762;

select carbo from plan where cnic=1762;

select equipment from exercise where cnic=1762;

select body_part from exercise where cnic=1762;

select bmi from dailyreport where cnic=1762;

select weight from dailyreport where cnic=1762;
