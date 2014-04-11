CREATE TABLE Pokemonlaji
(
ID int primary key not null,
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
Id serial primary key not null,
Tunnus varchar(15),
Salasana varchar(15)
);

CREATE TABLE Pokemon
(
ID serial primary key not null,
Laji int references Pokemonlaji(ID) ON DELETE cascade
                                    ON UPDATE cascade,
Nimi varchar(15),
Taso int,
HP int,
Atk int,
Def int,
SpAtk int,
Spdef int,
Spd int,
Omistaja int references Kayttaja(Id) ON DELETE cascade
                                     ON UPDATE cascade
);
