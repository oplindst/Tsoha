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
ID int,
Nimi varchar(15),
Type1 varchar(10),
Type2 varchar(10),
BHP int,
BAtk int,
BDef int,
BSpAtk int,
BSpDef int,
BSpd int,
);

CREATE TABLE Kayttaja
(
Tunnus varchar(15),
Salasana varchar(15)
);
