CREATE TABLE Pokemon
(
id SERIAL PRIMARY KEY,
ID int references Pokemonlaji(ID) ON DELETE cascade
                                  ON UPDATE cascade
Nimi varchar(15),
Taso int,
HP int,
Atk int,
Def int,
SpAtk int,
Spdef int,
Spd int,
omistaja int references Kayttaja(Id) ON DELETE cascade
                                     ON UPDATE cascade
);

CREATE TABLE Pokemonlaji
(
ID int primary key,
Nimi varchar(15) NOT NULL,
Type1 varchar(10) NOT NULL,
Type2 varchar(10),
BHP int,
BAtk int,
BDef int,
BSpAtk int,
BSpDef int,
BSpd int
);

CREATE TABLE Kayttaja
(
Id int,
Tunnus varchar(15),
Salasana varchar(15)
);
