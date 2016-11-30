<?php
function r2a($r) {
  $a = array();
  while($row = mysqli_fetch_assoc($r)) {
    $a[] = $row;
  }
  return $a;
}

function checkLogin() {
  if(isset($_SESSION['user'])) {
    return true;
  }
  return false;
}

function printSeasons($s = "") {
  global $mysqli;
  $query = "SELECT * FROM Season
            ORDER BY year ASC";
  $seasons = r2a($mysqli->query($query));
  echo "<option value=''>Select Season...</option>";
  foreach($seasons as $season) {
    if($s == $season['seasonID']) {
      echo "<option value='".$season['seasonID']."' selected='selected'>".$season['year']."</option>";
    } else {
      echo "<option value='".$season['seasonID']."'>".$season['year']."</option>";
    }
  }
}

function printWeeks($s = "", $w = "") {
  echo "<option value=''>Select Week...</option>";
  if($s == "") {
    return;
  } else {
    global $mysqli;
    $query = "SELECT * FROM Week
              WHERE season = '$s'
              ORDER BY weekNum ASC";
    $weeks = r2a($mysqli->query($query));
    foreach($weeks as $week) {
      if($w == $week['weekID']) {
        echo "<option value='".$week['weekID']."' selected='selected'>".$week['weekNum']."</option>";
      } else {
        echo "<option value='".$week['weekID']."'>".$week['weekNum']."</option>";
      }
    }
  }
}

function printPlayers($pos,$player,$week) {
  echo "<option value=''>Select ".$pos."...</option>";
  $query = "SELECT b.playerID, b.name, c.abbr
            FROM PlayerStat a
            JOIN Player b
            ON a.playerID = b.PlayerID
            JOIN Team c
            ON b.teamID = c.teamID
            WHERE a.weekID = $week";
  switch($pos) {
    case "QB":
      $query .= " AND b.positionID = 1";
      break;
    case "RB":
      $query .= " AND b.positionID = 2";
      break;
    case "WR":
      $query .= " AND b.positionID = 3";
      break;
    case "TE":
      $query .= " AND b.positionID = 4";
      break;
    case "FLEX":
      $query .= " AND (b.positionID = 2 OR b.positionID = 3 OR b.positionID = 4)";
      break;
    case "DF":
      $query .= " AND b.positionID = 5";
      break;
    case "PK":
      $query .= " AND b.positionID = 6";
      break;
    default:
      $query = "";
      break;
  }
  if($query != "") {
    $query .= " ORDER BY c.abbr ASC";
    global $mysqli;
    $players = r2a($mysqli->query($query));
    //echo $query; die;
    //pprint($players); die;
    foreach($players as $p) {
      if($player == $p['playerID']) {
        echo "<option value='".$p['playerID']."' selected='selected'>".$p['abbr']." - ".$p['name']."</option>";
      } else {
        echo "<option value='".$p['playerID']."'>".$p['abbr']." - ".$p['name']."</option>";
      }
    }
  }
}

function printCreatingTeamHeader($season,$week) {
  $season = getSeasonYear($season);
  $week = getWeekNum($week);
  echo "<div class='page-header text-center'>";
  echo "<h1>Creating Team for Week $week of the $season Season</h1>";
  echo "</div>";
}

function getSeasonYear($season) {
  global $mysqli;
  $query = "SELECT * FROM Season
            WHERE seasonID = $season";
  $seasons = r2a($mysqli->query($query));
  return $seasons[0]['year'];
}

function getWeekNum($week) {
  global $mysqli;
  $query = "SELECT * FROM Week
            WHERE weekID = $week";
  $weeks = r2a($mysqli->query($query));
  return $weeks[0]['weekNum'];
}

function pprint($arr) {
  echo "<pre>"; print_r($arr); echo "</pre>";
}
?>
