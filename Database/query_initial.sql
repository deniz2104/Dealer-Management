CREATE TABLE CLIENTI(
	ID_CLIENT INT PRIMARY KEY AUTO_INCREMENT,
    NUME VARCHAR(30) NOT NULL,
    PRENUME VARCHAR(40) NOT NULL,
    TELEFON CHAR(12) NOT NULL,
    CNP CHAR(13) UNIQUE NOT NULL
);

CREATE TABLE MASINI(
	ID_MASINA INT PRIMARY KEY AUTO_INCREMENT,
    MARCA VARCHAR(40) NOT NULL,
    MODEL VARCHAR(40) NOT NULL,
    CAPACITATE_MOTOR INT NOT NULL,
    AN_FABRICATIE INT NOT NULL,
    PRET DECIMAL(10,2) NOT NULL
);

CREATE TABLE VANZATORI(
	ID_VANZATOR INT PRIMARY KEY AUTO_INCREMENT,
    ID_MASINA INT,
    FOREIGN KEY(ID_MASINA) REFERENCES MASINI(ID_MASINA),
    NUME VARCHAR(30) NOT NULL,
    PRENUME VARCHAR(40) NOT NULL,
    EMAIL VARCHAR(40) NOT NULL,
    VECHIME INT NOT NULL
);

CREATE TABLE SERVICII(
	ID_SERVICIU INT PRIMARY KEY AUTO_INCREMENT,
    ID_MASINA INT,
    FOREIGN KEY(ID_MASINA) REFERENCES MASINI(ID_MASINA),
    DESCRIERE VARCHAR(1000) NOT NULL,
    COST DECIMAL(8,2) NOT NULL,
    DATA_SERVICIULUI DATE NOT NULL
);

CREATE TABLE TRANZACTII(
	ID_TRANZACTIE INT PRIMARY KEY AUTO_INCREMENT,
    ID_CLIENT INT,
    FOREIGN KEY(ID_CLIENT) REFERENCES clienti(ID_CLIENT),
    ID_MASINA INT,
    FOREIGN KEY(ID_MASINA) REFERENCES MASINI(ID_MASINA),
    ID_VANZATOR INT,
    FOREIGN KEY(ID_VANZATOR) REFERENCES VANZATORI(ID_VANZATOR),
    DATA_TRANZACTIE DATE NOT NULL
);

CREATE TABLE ASIGURARE(
	NUMAR_POLITA VARCHAR(50) PRIMARY KEY,
    NUME_PROVIDER_ASIGURARE VARCHAR(50) NOT NULL,
    TIP_ACOPERIRE VARCHAR(50) NOT NULL,
    DATA_INCEPUT DATE NOT NULL,
    DATA_SFARSIT DATE NOT NULL,
    COST DECIMAL(10,2) NOT NULL,
    ID_MASINA INT,
    FOREIGN KEY(ID_MASINA) REFERENCES MASINI(ID_MASINA),
    ID_CLIENT INT,
    FOREIGN KEY(ID_CLIENT) REFERENCES CLIENTI(ID_CLIENT)
);

CREATE TABLE CLIENTI_MASINI(
	CONTRACT VARCHAR(4000) NOT NULL,
    ID_CLIENT INT,
    ID_MASINA INT,
	PRIMARY KEY (ID_CLIENT,ID_MASINA)
);
INSERT INTO clienti
VALUES (1,"Popescu","Marcel","0720752872","5021220250034");

INSERT INTO clienti
values (2,"Mihai","Cosmina","0770862123","6011020203249"),
	   (3,"Marinescu","Bogdan","0749723202","50401250024"),
       (4,"Petrescu","Maria","0755236722","6020214224201"),
       (5,"Dan","Simona","0756242456","6011015204201");

INSERT INTO masini
VALUES (20,"Volvo","XC70",3000,2020,80000),
	   (21,"Mazda","CX6",2000,2007,2700),
       (22,"Audi","A4",2700,2009,3000);
INSERT INTO masini
VALUES (23,"BMW","e92",2000,2010,6000),
	   (24,"Volkswagen","MK5",1400,2010,2200),
       (25,"Volkswagen","MK7.5",2000,2018,14000),
       (26,"Opel","Astra G",1700,2009,3000);
       

INSERT INTO vanzatori
VALUES (302,20,"Florescu","Bogdan","florescu.bogan@yahoo.com",16),
       (303,21,"Florescu","Bogdan","florescu.bogdan@yahoo,com",16),
       (304,22,"Cojocaru","Catalina","catalina_cojocaru@gmail.com",15),
       (305,23,"Georgescu","Florentin","florin_geo@gmail.com",5),
       (306,24,"Georgescu","Florentin","florin_geo@gmail.com",5),
       (307,25,"Ionescu","Isabela","isa_ionescu@gmail.com",15),
       (308,26,"Marinescu","Teodora","marinescu__teo2121@gmail.com",20);

INSERT INTO tranzactii
VALUES (100,1,20,302,'10.10.2022'),
	   (101,2,24,306,'12.07.2021'),
       (102,4,25,307,'17.04.2022'),
       (103,3,26,308,'23.09.2021');
	
INSERT INTO tranzactii
VALUES (104,5,23,305,'17.02.2021');
       
INSERT INTO asigurare
VALUES (1432,"EuroIns","CASCO",'17.01.2021','16.01.2022',3000,20,1),
       (1433,"GROUPAMA","ASIGURARE",'15.06.2021','14.06.2022',800,24,2),
       (1434,"GENERALI","CASCO",'19.08.2021','18.08.2022',1300,25,4),
       (1435,"ALLIANZ-TIRIAC","ASIGURARE",'30.04.2021','29.04.2022',600,26,3);
       
INSERT INTO asigurare
VALUES (1436,"OMNIASIG","Asigurare",'20.02.2021','19.02.2022',900,23,5);
       
INSERT INTO clienti_masini
VALUES ("...",1,20),
       ("...",2,24),
	   ("...",4,25),
       ("...",3,26);

INSERT INTO clienti_masini
VALUES ("....",5,23);

ALTER TABLE vanzatori ADD COLUMN role ENUM('admin','seller') NOT NULL DEFAULT 'seller';
UPDATE vanzatori SET Role='admin' WHERE NUME='Florescu' AND PRENUME='BOGDAN';
SELECT * FROM vanzatori;

ALTER TABLE vanzatori DROP VECHIME;
UPDATE vanzatori SET Email='florescu.bogdan@yahoo.com' WHERE NUME='Florescu' AND PRENUME='Bogdan';

SELECT * FROM vanzatori;

ALTER TABLE tranzactii
DROP FOREIGN KEY tranzactii_ibfk_1;
ALTER TABLE tranzactii
ADD CONSTRAINT tranzactii_ibfk_1 foreign key(ID_CLIENT) REFERENCES clienti(ID_CLIENT) ON DELETE RESTRICT;

ALTER TABLE tranzactii
DROP FOREIGN KEY tranzactii_ibfk_2;
ALTER TABLE tranzactii
ADD CONSTRAINT tranzactii_ibfk_2 foreign key(ID_MASINA) REFERENCES masini(ID_MASINA) ON DELETE RESTRICT;

ALTER TABLE tranzactii
DROP FOREIGN KEY tranzactii_ibfk_3;
ALTER TABLE tranzactii
ADD CONSTRAINT tranzactii_ibfk_3 foreign key(ID_VANZATOR) REFERENCES vanzatori(ID_VANZATOR) ON DELETE RESTRICT;

INSERT INTO servicii
VALUES (150,20,"detailing",1500,'2023-10-12'),
		(151,24,"schimb filtre",500,'2024-05-20'),
        (152,26,"schimbare cauciucuri",800,'2024-12-29'),
        (153,25,"schimb ulei",300,'2023-02-23'),
        (154,23,"detailing interior",500,'2024-08-24');
        
	