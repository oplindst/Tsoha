CREATE TABLE Pokemon
(
ID int,
Nimi varchar(15),
Taso int,
HP int,
Atk int,
Def int,
SpAtk int,
Spdef int,
Spd int,
omistaja varchar(15)
);

CREATE TABLE Pokemonlaji
(
ID int primary key,
Nimi varchar(15) NOT NULL,
Type1 varchar(10) NOT NULL,
Type2 varchar(10),
BHP int NOT NULL,
BAtk int NOT NULL,
BDef int NOT NULL,
BSpAtk int NOT NULL,
BSpDef int NOT NULL,
BSpd int NOT NULL
);

CREATE TABLE Kayttaja
(
Id int,
Tunnus varchar(15),
Salasana varchar(15)
);
