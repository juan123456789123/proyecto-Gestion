use gcs_rticket_otobo

SELECT now()

SET SQL_SAFE_UPDATES = 0;
-- correr primero la linea de arriba para evitar problemas por updates


DELIMITER $$
create procedure getCustomer()
begin	
    select CUSTOMER.IDcustomer, CUSTOMER.customer_name, CUSTOMER.responsible_name, CUSTOMER.institution_name, CUSTOMER.otobo_name, VALIDITY.state from CUSTOMER
    join VALIDITY ON CUSTOMER.IDvalidity = VALIDITY.IDvalidity;
END$$



DELIMITER $$
create procedure getContracts()
begin
	select CONTRACT.IDcontract, CONTRACT.contract_name, CUSTOMER.customer_name, CONTRACT.contract_type, 
    CONTRACT.contract_hours, CONTRACT.available_hours, CONTRACT.init_contract_date,
    CONTRACT.final_contract_date,  VALIDITY.state,CONTRACT.description_,CONTRACT.order_ from CONTRACT
    join VALIDITY ON CONTRACT.IDvalidity = VALIDITY.IDvalidity
    join CUSTOMER on CUSTOMER.IDcustomer = CONTRACT.IDcustomer;
END$$



DELIMITER $$
create procedure getContractById(idContract_ int)
begin
	select CONTRACT.IDcontract, CONTRACT.contract_name, CUSTOMER.customer_name, CONTRACT.contract_type, 
    CONTRACT.contract_hours, CONTRACT.available_hours, CONTRACT.init_contract_date,
    CONTRACT.final_contract_date,  VALIDITY.state, CONTRACT.description_,CONTRACT.order_,
    CONTRACT.IDvalidity from CONTRACT
    join VALIDITY ON CONTRACT.IDvalidity = VALIDITY.IDvalidity
    join CUSTOMER on CUSTOMER.IDcustomer = CONTRACT.IDcustomer
    where CONTRACT.IDcontract = idContract_;
END$$ 



DELIMITER $$
create procedure getDeleteContract(idContract_ int)
begin
	delete from CONTRACT
    where CONTRACT.IDcontract = idContract_;
END$$



DELIMITER $$
create procedure getValidity()
begin	
    select * from VALIDITY;
END$$




delimiter $$ 
CREATE PROCEDURE insertContract(contract_name_ nvarchar(50),IDcustomer_ int,contract_type_ nvarchar(100),
					contract_hours_ int,init_contract_date_ datetime,final_contract_date_ datetime,IDvalidity_ int,description_ nvarchar(255),order_ nvarchar(255))
begin	
if order_="" then
insert into CONTRACT
    VALUES(0, contract_name_,IDcustomer_,contract_type_,contract_hours_,init_contract_date_,
			final_contract_date_,contract_hours_,IDvalidity_,description_,"N/A");
else
	insert into CONTRACT
    VALUES(0, contract_name_,IDcustomer_,contract_type_,contract_hours_,init_contract_date_,
			final_contract_date_,contract_hours_,IDvalidity_,description_,order_);
	end if;
		
END $$



DELIMITER $$
create procedure updateContract(IDcontract_ int, contract_name_ nvarchar(50),contract_type_ nvarchar(100),
					contract_hours_ int,init_contract_date_ datetime,final_contract_date_ datetime, available_hours_ int, IDvalidity_ int,description_new nvarchar(255),order_new nvarchar(255))
begin
if order_new="" then
update CONTRACT
    set contract_name = contract_name_,
		contract_type = contract_type_,
		contract_hours = contract_hours_,
		init_contract_date = init_contract_date_,
		final_contract_date = final_contract_date_,
		available_hours = available_hours_,
		IDvalidity = IDvalidity_,
        description_ =description_new,
        order_ ="N/A"
	where IDcontract = IDcontract_;
else
	update CONTRACT
    set contract_name = contract_name_,
		contract_type = contract_type_,
		contract_hours = contract_hours_,
		init_contract_date = init_contract_date_,
		final_contract_date = final_contract_date_,
		available_hours = available_hours_,
		IDvalidity = IDvalidity_,
        description_ =description_new,
        order_ =order_new
	where IDcontract = IDcontract_;
    end if;
end$$


DELIMITER $$
create procedure getUsers()
begin	
    select USER.IDuser, USER.username, USER.name, USER.lastname, USER.ID, VALIDITY.state from USER
    join VALIDITY ON USER.IDvalidity = VALIDITY.IDvalidity;
END$$



DELIMITER $$
create procedure getDeleteUser(idUser_ int)
begin
	delete from USER
    where USER.IDuser = idUser_;
END$$



DELIMITER $$
create procedure getUserById(idUser_ int)
begin
	select USER.IDuser, USER.username, USER.contrasena, USER.name, USER.lastname, USER.ID, 
    USER.IDvalidity, VALIDITY.state from USER 
    join VALIDITY ON USER.IDvalidity = VALIDITY.IDvalidity
    where USER.IDuser = idUser_;
END$$




DELIMITER $$
create procedure updateUser(IDuser_ int, username_ nvarchar(100),contrasena_ nvarchar(200),
					name_ nvarchar(50),lastname_ nvarchar(100),ID_ nvarchar(20),IDvalidity_ int)
begin
	update USER
    set username = username_,
		contrasena = contrasena_,
		name = name_,
		lastname = lastname_,
		ID = ID_,
		IDvalidity = IDvalidity_
	where IDuser = IDuser_;
end$$


delimiter $$ 
CREATE PROCEDURE insertCustomer(customer_name nvarchar(100), responsible_name nvarchar(200), institution_name nvarchar (100),
					otobo_name nvarchar(100),IDvalidity_ int)
begin	
	insert into CUSTOMER
    VALUES(0, customer_name, responsible_name, institution_name, otobo_name, IDvalidity_);		
END $$

DELIMITER $$
create procedure getDeleteCUSTOMER(idCustomer_ int)
begin
	delete from CUSTOMER
    where CUSTOMER.IDcustomer = idCustomer_;
END$$

DELIMITER $$
create procedure getCustomerById(idCustomer_ int)
begin
	select CUSTOMER.IDcustomer, CUSTOMER.customer_name, CUSTOMER.responsible_name,
    CUSTOMER.institution_name, CUSTOMER.otobo_name, CUSTOMER.IDvalidity, VALIDITY.state from CUSTOMER 
    join VALIDITY ON CUSTOMER.IDvalidity = VALIDITY.IDvalidity
    where CUSTOMER.IDcustomer = idCustomer_;
END$$



DELIMITER $$
create procedure getCaseById(idCases_ int)
begin
	select CASES.otobo_customer, CASES.contract_name, CASES.init, CASES.final, CASES.IDtickets,
    CASES.Previous_hours, CASES.Current_hours, CASES.Date_Case
    from CASES where CASES.IDcases = idCases_;
END$$


DELIMITER $$
create procedure updateCustomer(IDcustomer_ int, customer_name_ nvarchar(100),responsible_name_ nvarchar(100),
					institution_name_ nvarchar(100),otobo_name_ nvarchar(100),IDvalidity_ int)
begin
	update CUSTOMER
    set customer_name = customer_name_,
		responsible_name = responsible_name_,
		institution_name = institution_name_,
		otobo_name = otobo_name_,
		IDvalidity = IDvalidity_
	where IDcustomer = IDcustomer_;
end$$


delimiter $$ 
CREATE PROCEDURE insertUser(username_ nvarchar(100), contrasena_ nvarchar(200), name_ nvarchar (50),
					lastname nvarchar(100), ID_ nvarchar(20), IDvalidity_ int)
begin	
	insert into USER
    VALUES(0, username_, contrasena_, name_, lastname, ID_, IDvalidity_);		
END $$

DELIMITER $$
create procedure autenticacion(username_ nvarchar(100),contrasena_ nvarchar(200))
begin
	select USER.IDuser,USER.username,USER.name,USER.lastname,USER.ID,USER.IDvalidity 
    from USER 
    where USER.username = username_ 
    and USER.contrasena = contrasena_ 
    and IDvalidity=1;
END$$



DELIMITER $$
create procedure getContractsByName(otobo_name_ nvarchar(100))
begin
	select CONTRACT.IDcontract, CONTRACT.contract_name, CUSTOMER.otobo_name, CONTRACT.IDvalidity
    from CONTRACT
    join CUSTOMER on CUSTOMER.IDcustomer = CONTRACT.IDcustomer
    where CUSTOMER.otobo_name = otobo_name_ and CONTRACT.available_hours > 0;
END$$


DELIMITER $$
create procedure getContractInfo(contract_name_ nvarchar(50))
begin
	select CONTRACT.IDcontract, CONTRACT.contract_name, CUSTOMER.customer_name, 
    CUSTOMER.institution_name, CUSTOMER.otobo_name, CONTRACT.contract_type, 
    CONTRACT.contract_hours, CONTRACT.available_hours, CONTRACT.init_contract_date,
    CONTRACT.final_contract_date, CONTRACT.description_,CONTRACT.order_, VALIDITY.state from CONTRACT
    join VALIDITY ON CONTRACT.IDvalidity = VALIDITY.IDvalidity
    join CUSTOMER on CUSTOMER.IDcustomer = CONTRACT.IDcustomer
    where CONTRACT.contract_name = contract_name_ and VALIDITY.IDvalidity=1;
END$$



DELIMITER $$
create procedure getCases()
begin
    select CASES.IDcases, CASES.contract_name, CASES.IDtickets, CASES.incidents, CASES.hours, Date_Case, CASES.init, CASES.final, CASES.otobo_customer, CASES.Previous_hours, CASES.Current_hours, CONTRACT.contract_hours
    from CASES join CONTRACT on CONTRACT.contract_name = CASES.contract_name;
END$$



delimiter $$ 
CREATE PROCEDURE insertCase(contract_name_ nvarchar(20), IDtickets_ nvarchar(50), incidents_ nvarchar (1000),
					hours_ int, used_hours_ int, init_ datetime, final_ datetime, otobo_customer_ nvarchar(100),
                    Previous_hours_ int, Current_hours_ int)
begin	
	insert into CASES
    VALUES(0, contract_name_, IDtickets_, incidents_, hours_, now(), init_, final_, otobo_customer_, Previous_hours_, Current_hours_);
    
    update CONTRACT
    set CONTRACT.available_hours = used_hours_
    where CONTRACT.contract_name = contract_name_;
    
END $$



DELIMITER $$
create procedure getCasesBycontractname(contract_name_ nvarchar(20))
begin
    select contract_name,hours, Date_Case from CASES
    where contract_name=contract_name_;
END$$



DELIMITER $$
create procedure getCasesForHistoric(contract_name_ nvarchar(20), Date_case_ date)
begin
    select CASES.contract_name, CASES.hours, CASES.Date_Case from CASES
    where contract_name = contract_name_ and Date_Case < Date_case_;
END$$

