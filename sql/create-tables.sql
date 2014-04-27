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
PokeID serial primary key not null,
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
HPIV int default 0,
AtkIV int default 0,
DefIV int default 0,
SpAtkIV int default 0,
SpDefIV int default 0,
SpdIV int default 0,
HPEV int default 0,
AtkEV int default 0,
DefEV int default 0,
SpAtkEV int default 0,
SpDefEV int default 0,
SpdEV int default 0,
Nature varchar(15),
Omistaja int references Kayttaja(Id) ON DELETE cascade
                                     ON UPDATE cascade,
Kommentti varchar(50)
);

CREATE TABLE Tiimi
(
ID serial primary key not null,
Nimi varchar(15),
Omistaja int references Kayttaja(Id) ON DELETE cascade
                                     ON UPDATE cascade
);

CREATE TABLE Tiiminjasen
(
Poke_id int references Pokemon(PokeID) ON DELETE cascade
                                   ON UPDATE cascade,
Tiimi_id int references Tiimi(ID) ON DELETE cascade
                                  ON UPDATE cascade
);
