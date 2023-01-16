Create database gcs_rticket_otobo



use gcs_rticket_otobo

create table VALIDITY(
IDvalidity int auto_increment primary key,
state nvarchar(50) not null
)

insert into VALIDITY
values  (0 ,"válido"),
		(0 ,"inválido"),
        (0 ,"temporalmente inválido")

create table CUSTOMER(
IDcustomer int auto_increment primary key,
customer_name nvarchar(100) not null,
responsible_name nvarchar(100) not null,
institution_name nvarchar (100) not null,
otobo_name nvarchar(100) unique not null,
IDvalidity int not null,
foreign key (IDvalidity) references VALIDITY(IDvalidity) on delete cascade on update cascade
)



create table CONTRACT(
IDcontract int auto_increment primary key not null,
contract_name nvarchar(50) unique not null,
IDcustomer int not null,
contract_type nvarchar(100) not null,
contract_hours int not null,
init_contract_date datetime not null,
final_contract_date datetime not null,
available_hours int not null,
IDvalidity int not null,
description_ nvarchar(255) not null,
order_ nvarchar(255),
foreign key (IDcustomer) references CUSTOMER(IDcustomer) on delete cascade on update cascade,
foreign key (IDvalidity) references VALIDITY(IDvalidity) on delete cascade on update cascade
)



create table CASES(
IDcases int auto_increment primary key not null,
contract_name nvarchar(20) not null,
IDtickets nvarchar(50) not null,
incidents nvarchar(1000) not null,
hours int not null,
Date_Case datetime not null,
init datetime not null,
final datetime not null,
otobo_customer nvarchar(100) not null,
Previous_hours int not null,
Current_hours int not null
)



create table USER(
IDuser int auto_increment primary key not null,
username nvarchar(100) not null,
contrasena nvarchar(200) not null,
name nvarchar (50) not null,
lastname nvarchar(100) not null,
ID nvarchar(20),
IDvalidity int not null,
foreign key (IDvalidity) references VALIDITY(IDvalidity) on delete cascade on update cascade
)
