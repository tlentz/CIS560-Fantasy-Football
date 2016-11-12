CREATE TABLE Player
(
  playerID INT NOT NULL,
  fName VARCHAR(45) NOT NULL,
  lName VARCHAR(45) NOT NULL,
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
  homeTeam VARCHAR(45) NOT NULL,
  awayTeam VARCHAR(45) NOT NULL,
  score VARCHAR(45) NOT NULL,
  week INT NOT NULL,
  seasonID INT NOT NULL,
  PRIMARY KEY (gameID),
  FOREIGN KEY (seasonID) REFERENCES Season(seasonID)
);
