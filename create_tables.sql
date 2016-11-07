CREATE TABLE Conference
(
  conferenceID INT NOT NULL,
  name INT NOT NULL,
  abbr INT NOT NULL,
  PRIMARY KEY (conferenceID)
);

CREATE TABLE Division
(
  divisionID INT NOT NULL,
  name INT NOT NULL,
  conferenceID INT NOT NULL,
  PRIMARY KEY (divisionID),
  FOREIGN KEY (conferenceID) REFERENCES Conference(conferenceID)
);

CREATE TABLE Team
(
  teamID INT NOT NULL,
  city INT NOT NULL,
  mascot INT NOT NULL,
  divisionID INT NOT NULL,
  PRIMARY KEY (teamID),
  FOREIGN KEY (divisionID) REFERENCES Division(divisionID)
);

CREATE TABLE User
(
  userID INT NOT NULL,
  fName INT NOT NULL,
  lName INT NOT NULL,
  teamName INT NOT NULL,
  PRIMARY KEY (userID)
);

CREATE TABLE Season
(
  seasonID INT NOT NULL,
  sDate INT NOT NULL,
  eDate INT NOT NULL,
  PRIMARY KEY (seasonID)
);

CREATE TABLE Position
(
  positionID INT NOT NULL,
  name INT NOT NULL,
  PRIMARY KEY (positionID)
);

CREATE TABLE PlayerStat
(
  playerStatID INT NOT NULL,
  intThrown INT NOT NULL,
  passTD INT NOT NULL,
  rushTD INT NOT NULL,
  recTD INT NOT NULL,
  passAtt INT NOT NULL,
  passComp INT NOT NULL,
  passYds INT NOT NULL,
  rushAtt INT NOT NULL,
  rushYds INT NOT NULL,
  recYds INT NOT NULL,
  numRec INT NOT NULL,
  fgAtt INT NOT NULL,
  fgMade INT NOT NULL,
  fumLoss INT NOT NULL,
  sacks INT NOT NULL,
  int INT NOT NULL,
  fumbles INT NOT NULL,
  ptsAllowed INT NOT NULL,
  PRIMARY KEY (playerStatID)
);

CREATE TABLE Player
(
  playerID INT NOT NULL,
  fName INT NOT NULL,
  lName INT NOT NULL,
  fa INT NOT NULL,
  Active INT NOT NULL,
  teamID INT NOT NULL,
  userID INT NOT NULL,
  positionID INT NOT NULL,
  PRIMARY KEY (playerID),
  FOREIGN KEY (teamID) REFERENCES Team(teamID),
  FOREIGN KEY (userID) REFERENCES User(userID),
  FOREIGN KEY (positionID) REFERENCES Position(positionID)
);

CREATE TABLE Game
(
  gameID INT NOT NULL,
  date INT NOT NULL,
  homeTeam INT NOT NULL,
  awayTeam INT NOT NULL,
  score INT NOT NULL,
  week INT NOT NULL,
  seasonID INT NOT NULL,
  PRIMARY KEY (gameID),
  FOREIGN KEY (seasonID) REFERENCES Season(seasonID)
);

CREATE TABLE has
(
  gameID INT NOT NULL,
  playerID INT NOT NULL,
  PRIMARY KEY (gameID, playerID),
  FOREIGN KEY (gameID) REFERENCES Game(gameID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID)
);

CREATE TABLE has
(
  gameID INT NOT NULL,
  teamID INT NOT NULL,
  PRIMARY KEY (gameID, teamID),
  FOREIGN KEY (gameID) REFERENCES Game(gameID),
  FOREIGN KEY (teamID) REFERENCES Team(teamID)
);

CREATE TABLE has
(
  gameID INT NOT NULL,
  playerStatID INT NOT NULL,
  PRIMARY KEY (gameID, playerStatID),
  FOREIGN KEY (gameID) REFERENCES Game(gameID),
  FOREIGN KEY (playerStatID) REFERENCES PlayerStat(playerStatID)
);

CREATE TABLE has
(
  playerID INT NOT NULL,
  playerStatID INT NOT NULL,
  PRIMARY KEY (playerID, playerStatID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID),
  FOREIGN KEY (playerStatID) REFERENCES PlayerStat(playerStatID)
);
