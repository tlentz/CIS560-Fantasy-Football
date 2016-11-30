<link rel="stylesheet" href="index.css">
<?php
include('includes/header.php');
?>

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
      <a class='btn btn-primary form-control' href="createTeam.php?season=<?= $season ?>&week=<?= $week ?>">Create Team</a>
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
    <?php } else { pprint($team) ?>
      <table class='table table-striped'>
        <thead>
          <th>Position</th>
          <th>Player</th>
          <th>Points</th>
        </thead>
        <tbody>
          <?php $pos = array("QB","RB1","RB2","WR1","WR2","TE","FLEX","DF","PK");
          foreach($pos as $p) {
            printPlayer($p, $team[$p]);
          } ?>
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
  echo "</td><td></td>";
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
