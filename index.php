<link rel="stylesheet" href="index.css">

<!--<div class="row">
  <div class="tile col-md-3">
      <h3 class="whiteText" id="viewStat">View Stats</h3>
  	  <p>Test</p>
  </div>
  <div class="tile col-md-3">
      <h3 class="whiteText" id="viewFantasy">View Fantasy Team</h3>
      <p>Test</p>
  </div>
  <div class="tile col-md-3">
      <h3 class="whiteText" id="createFantasy">Create Fantasy Team</h3>
      <p>Test</p>
  </div>
</div>-->
<?php

if(isset($_GET['delete'])){
    $season = $_GET['season'];
    $week = $_GET['week'];
    $mysqli = new mysqli("mysql.cis.ksu.edu", "markloev", "pcEkhG5B5kg8XExJ%RD", "markloev");
    $query = "DELETE FROM FantasyTeam WHERE weekID='".$week."'";
    $mysqli->query($query);
    header("index.php");
}
include('includes/header.php');

$totalPoints = 0;
$season = "";
$week = "";
if(isset($_GET['season'])) {
  $season = $_GET['season'];
}
if(isset($_GET['week'])) {
  $week = $_GET['week'];
}
if($season != "" && $week != "") {
  if(hasTeam($_SESSION['user']['id'],$week)) {
    $team = getTeam($_SESSION['user']['id'],$week);
  }
}

if(isset($_GET['delete'])){
    $season = $_GET['season'];
    $week = $_GET['week'];
    $query = "DELETE FROM FantasyTeam WHERE weekID='".$week."'";
    $mysqli->query($query);
    header("index.php");
}

?>
<form method='GET'>
  <?php if($season == "" || $week == "") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Both season and week must be selected.
    </div>
  <?php } ?>
  <div class='row'>
    <div class='col-sm-4'>
      <label>Season</label>
      <select class='form-control seasonWeek' name='season'><?php printSeasons($season); ?></select>
    </div>
    <div class='col-sm-4'>
      <label>Week</label>
      <select class='form-control seasonWeek' name='week'><?php printWeeks($season,$week); ?></select>
    </div>
    <div class='col-sm-4'>
      <label>&nbsp;</label>
      <a class='btn btn-primary form-control' href='createTeam.php?season=<?= $season ?>&week=<?= $week ?>'>Create Team</a>
    </div>
  </div>

  <?php if($season != "" && $week != "") { ?>
    <div class="page-header text-center">
  		<h1>Your Team</h1>
  	</div>
    <?php if(!isset($team)) { ?>
      <div class="alert alert-warning">
        No team this week.
      </div>
    <?php } else { //pprint($team) ?>
      <input type='submit' style="width: 10%; float: right;" class='btn btn-primary form-control' id='delete' name='delete' value='Delete Team'><br><br><br>
      <table class='table table-striped table-bordered table-hover'>
        <thead>
          <th>Position</th>
          <th>Player</th>
          <th>Points</th>
        </thead>
        <tbody>
          <?php $pos = array("QB","RB1","RB2","WR1","WR2","TE","FLEX","DF","PK");
          foreach($pos as $p) {
            printPlayer($p, $team[$p]);
          }
          global $totalPoints;
          ?>
          <tr><td colspan=3 class="pos" align="center">Total Points: <?= " ".$totalPoints ?></td></tr>
        </tbody>
      </table>
    <?php } ?>
  <?php } ?>
</form>

<?php
include('includes/footer.php');

function printPlayer($pos,$player) {
  echo "<tr><td class='pos'>$pos</td>";
  echo "<td>".$player['name']." - ".$player['abbr'];
  echo "<p class='stats'>";

  if($pos == "QB") {
    echo $player['passComp']."/".$player['passAtt']."\t".$player['passYds']."yds"."\t".$player['passTds']."TD"."\t".$player['interceptions']."INT";
  } else if ($pos == "RB1" || $pos == "RB2" || ($pos == "FLEX" && $player['positionID'] == 2)) {
    echo $player['rushYds']."yds"."\t".$player['rushTds']."TD"."\t".$player['fumbles']."FUM";
  } else if ($pos == "WR1" || $pos == "WR2" || $pos == "TE" || ($pos == "FLEX" && ($player['positionID'] == 3 || $player['positionID'] == 4))) {
    echo $player['recYds']."yds"."\t".$player['recTds']."TD"."\t".$player['fumbles']."FUM";
  } else if ($pos == "DF") {
    echo $player['defTYA']."YA"."\t".$player['defInt']."INT"."\t".$player['defFR']."FR"."\t".$player['defTds']."TD";
  } else if($pos == "PK") {
    echo ($player['fgAtt']-$player['fgMiss'])."/".$player['fgAtt']." FG\t".($player['xpAtt']-$player['xpMiss'])."/".$player['xpAtt']." XP";
  }
  echo "</p>";
  echo "</td><td class='pos'>";
  calculatePoints($pos,$player);
  echo "</td></tr>";
}

function calculatePoints($pos, $player) {
  $points = 0;
  if ($pos == "DF") {
    $points = 10;
    if($player['defTYA'] > 99) {
      $points--;
    }
    if($player['defTYA'] > 199) {
      $points--;
    }
    if($player['defTYA'] > 299) {
      $points--;
    }
    if($player['defTYA'] > 399) {
      $points--;
    }
    if($player['defTYA'] > 499) {
      $points--;
    }
    $points = $points + (6*$player['defTds']) + (2*($player['defFR']+$player['defInt']+$player['defSafety']));
  } else if ($pos == "PK") {
    $points = (3*$player['fgAtt']) - (1*$player['fgMiss']) + (1*$player['xpAtt']) - (1*$player['xpMiss']);
  } else {
    $rushTds = $player['rushTds'] == "" ? 0 : $player['rushTds'];
    $recTds = $player['recTds'] == "" ? 0 : $player['recTds'];
    $passTds = $player['passTds'] == "" ? 0 : $player['passTds'];
    $passYds = $player['passYds'] == "" ? 0 : $player['passYds'];
    $recYds = $player['recYds'] == "" ? 0 : $player['recYds'];
    $rushYds = $player['rushYds'] == "" ? 0 : $player['rushYds'];
    $int = $player['interceptions'] == "" ? 0 : $player['interceptions'];
    $fumbles = $player['fumbles'] == "" ? 0 : $player['fumbles'];
    $points = (6*($rushTds+$recTds)) + (4*$passTds);
    $points += (0.04*$passYds) + (0.1*($recYds + $rushYds));
    $points -= (2*($int + $fumbles));
  }
  global $totalPoints;
  $totalPoints += $points;
  echo $points;
}
?>

<script>
  $(".tile").click(function() {
    id = $(this).children("h3").attr('id') + ".php";
    window.location.href= id;
  });
  $('.seasonWeek').change(function() {
    $(this).closest('form').trigger('submit');
  });
</script>
