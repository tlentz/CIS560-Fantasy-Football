/*$query = "SELECT * FROM Team";
$teams = r2a($mysqli->query($query));
$new_teams = array();
foreach($teams as $t) {
  $new_teams[$t['abbr']] = $t['teamID'];
}
$query = "SELECT * FROM Position";
$positions = r2a($mysqli->query($query));
$pos = array();
foreach($positions as $p) {
  $pos[$p['name']] = $p['positionID'];
}
$file = fopen("scrape_data/players.txt", "r") or die("Unable to open file!");
while(!feof($file)) {
  $line = fgets($file);
  if($line != "") {
    $parts = explode(" -- ",$line);
    $query = "INSERT INTO Player (name,teamID,positionID) VALUES ('".str_replace("'","",$parts[1])."','".$new_teams[trim($parts[2])]."','".$pos[$parts[0]]."')";
    $mysqli->query($query);
  }
}
fclose($file);*/
/*
$query = "SELECT * FROM Week
          WHERE season = 1";
$temp_weeks = r2a($mysqli->query($query));
$weeks = array();
foreach($temp_weeks as $t) {
  $weeks[$t['weekNum']] = $t['weekID'];
}
$query = "SELECT p.*, pos.name as 'pos', t.abbr
          FROM Player p
          JOIN Position pos
          ON p.positionID = pos.positionID
          JOIN Team t
          ON t.teamID = p.teamID";
$temp_players = r2a($mysqli->query($query));
$players = array();
foreach($temp_players as $t) {
  $index = $t['pos'].$t['name'].$t['abbr'];
  $index = str_replace("'","",$index);
  $players[$index] = $t['playerID'];
}
$file = fopen("scrape_data/2015/RBWRTE.csv", "r") or die("Unable to open file!");
while(!feof($file)) {
  $line = fgets($file);
  if($line != "") {
    $parts = explode(",",$line);
    $week = $parts[0];
    $pos = $parts[1];
    $name = $parts[2];
    $abbr = $parts[3];
    $index = $pos.$name.$abbr;
    $index = str_replace("'","",$index);
    $playerID = $players[$index];

    // DEFENSE //
    /*
    $sacks = $parts[5];
    $fr = $parts[6];
    $int = $parts[7];
    $td = $parts[8];
    $sfty = $parts[9];
    $ryda = $parts[10];
    $pyda = $parts[11];
    $tyda = $parts[12];
    $query = "INSERT INTO PlayerStat (playerID,weekID,defSack,defFR,defInt,defTds,defSafety,defRYA,defPYA,defTYA)
              VALUES (".$playerID.",".$weeks[$week].",".$sacks.",".$fr.",".$int.",".$td.",".$sfty.",".$ryda.",".$pyda.",".$tyda.")";
    $mysqli->query($query);*/

    // PK //
    /*
    $fgAtt = $parts[5];
    $fgMiss = $parts[6];
    $xpAtt = $parts[7];
    $xpMiss = $parts[8];
    $query = "INSERT INTO PlayerStat (playerID,weekID,fgAtt,fgMiss,xpAtt,xpMiss)
              VALUES (".$playerID.",".$weeks[$week].",".$fgAtt.",".$fgMiss.",".$xpAtt.",".$xpMiss.")";
    $mysqli->query($query);*/

    // QB //
    /*
    $rushAtt = $parts[6];
    $rushYds = $parts[7];
    $rushTds = $parts[8];
    $passAtt = $parts[9];
    $passComp = $parts[10];
    $passYds = $parts[11];
    $passTds = $parts[12];
    $fumbles = $parts[13];
    $interceptions = $parts[14];
    $query = "INSERT INTO PlayerStat (playerID,weekID,rushAtt,rushYds,rushTds,passAtt,passComp,passYds,passTds,fumbles,interceptions)
              VALUES (".$playerID.",".$weeks[$week].",".$rushAtt.",".$rushYds.",".$rushTds.",".$passAtt.",".$passComp.",".$passYds.",".$passTds.",".$fumbles.",".$interceptions.")";
    $mysqli->query($query);*/

    // RBWRTE //
    /*
    $rushAtt = $parts[6];
    $rushYds = $parts[7];
    $rushTds = $parts[8];
    $targets = $parts[9];
    $receptions = $parts[10];
    $recYds = $parts[11];
    $recTds = $parts[12];
    $fumbles = $parts[13];
    $interceptions = $parts[14];
    $query = "INSERT INTO PlayerStat (playerID,weekID,rushAtt,rushYds,rushTds,targets,receptions,recYds,recTds,fumbles,interceptions)
              VALUES (".$playerID.",".$weeks[$week].",".$rushAtt.",".$rushYds.",".$rushTds.",".$targets.",".$receptions.",".$recYds.",".$recTds.",".$fumbles.",".$interceptions.")";
    $mysqli->query($query);*/


    //$query = "INSERT INTO Player (name,teamID,positionID) VALUES ('".$parts[1]."','".$new_teams[trim($parts[2])]."','".$pos[$parts[0]]."')";
    //$mysqli->query($query);
  }
}
fclose($file);
