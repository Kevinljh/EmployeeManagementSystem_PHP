DROP DATABASE IF EXISTS EMS;
CREATE DATABASE EMS;

USE EMS;

CREATE TABLE User
(
id					int NOT NULL AUTO_INCREMENT,
username			varchar(255),
password			varchar(255),
securityLevel		int,
PRIMARY KEY (id)
);

CREATE TABLE Audit
(
id					int NOT NULL AUTO_INCREMENT,
user_id				int,
changeTime			DateTime,
changedTable		varchar(255),
recordId			int,
changedField		varchar(31),
oldValue			varchar(255),
newValue			varchar(255),
extra				varchar(255),
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES User(id)
);

CREATE TABLE Company
(
id					int NOT NULL AUTO_INCREMENT,
corporationName		varchar(255),
dateOfIncorporation	Date,
PRIMARY KEY (id)
);

CREATE TABLE Contractor
(
id					int NOT NULL AUTO_INCREMENT,
company_id			int NOT NULL,
buisnessNumber		varchar(11),
contractStartDate	Date,
contractStopDate	Date,
fixedContractAmount	float,
PRIMARY KEY (id),
FOREIGN KEY (company_id) REFERENCES Company(id)
);

CREATE TABLE Person
(
id					int NOT NULL AUTO_INCREMENT,
firstName			varchar(31),
lastName			varchar(31),
SIN					varchar(11),
dateOfBirth			Date,
PRIMARY KEY (id)
);

CREATE TABLE Employee
(
id					int NOT NULL AUTO_INCREMENT,
company_id			int NOT NULL,
person_id			int NOT NULL,
workStatus			varchar(31),
reasonForLeaving	varchar(31),
PRIMARY KEY (id),
FOREIGN KEY (company_id) REFERENCES Company(id),
FOREIGN KEy (person_id) REFERENCES Person(id)
);

CREATE TABLE FullTimeEmployee
(
id					int NOT NULL AUTO_INCREMENT,
employee_id			int NOT NULL,
dateOfHire			Date,
dateOfTermination	Date,
salary				float,
PRIMARY KEY (id),
FOREIGN KEY (employee_id) REFERENCES Employee(id)
);

CREATE TABLE PartTimeEmployee
(
id					int NOT NULL AUTO_INCREMENT,
employee_id			int NOT NULL,
dateOfHire			Date,
dateOfTermination	Date,
hourlyRate			float,
PRIMARY KEY (id),
FOREIGN KEY (employee_id) REFERENCES Employee(id)
);

CREATE TABLE SeasonalEmployee
(
id					int	NOT NULL AUTO_INCREMENT,
employee_id			int NOT NULL,
season				varchar(10),
piecePay			float,
seasonYear			Year,
PRIMARY KEY (id),
FOREIGN KEY (employee_id) REFERENCES Employee(id)
);

CREATE TABLE Timecard
(
id					int	NOT NULL AUTO_INCREMENT,
employee_id			int NOT NULL,
info_title			varchar(31),
monday				int,
tuesday				int,
wednesday			int,
thursday			int,
friday				int,
saturday			int,
sunday				int,
PRIMARY KEY (id),
FOREIGN KEY (employee_id) REFERENCES Employee(id)
);
