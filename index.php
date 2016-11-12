<link rel="stylesheet" href="index.css">
<?php
include('header.php');
?>

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

<?php

$array = array('Arizona Cardinals','Atlanta Falcons','Baltimore Ravens','Buffalo Bills','Carolina Panthers','Chicago Bears','Cincinnati Bengals','Cleveland Browns','Dallas Cowboys','Denver Broncos','Detroit Lions','Green Bay Packers','Houston Texans','Indianapolis Colts','Jacksonville Jaguars','Kansas City Chiefs','Los Angeles Rams','Miami Dolphins','Minnesota Vikings','New England Patriots','New Orleans Saints','New York Giants','New York Jets','Oakland Raiders','Philadelphia Eagles','Pittsburgh Steelers','San Diego Chargers','San Francisco 49ers','Seattle Seahawks','Tampa Bay Buccaneers','Tennessee Titans','Washington Redskins');
$abbrevArray = array('ARI','ATL','BAL','BUF','CAR','CHI','CIN','CLE','DAL','DEN','DET','GB','HOU','IND','JAC','KC','LA','MIA','MIN','NE','NO','NYG','NYJ','OAK','PHI','PIT','SD','SEA','SF','TB','TEN','WAS');
for($i=0;$i<32;$i++){
  $query = "INSERT INTO Team (teamAbbrev, team) VALUES ('".$abbrevArray[$i]."', '".$array[$i]."')";
  echo $query;
  $mysqli->query($query);
}
include('footer.php');
?>

<script>
  $(".tile").click(function(){
    id = $(this).children("h3").attr('id') + ".php";
    window.location.href= id;
  });
</script>
