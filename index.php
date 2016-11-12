<link rel="stylesheet" href="index.css">
<?php
include('header.php');
?>

<div class="row">
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
</div>

<?php
$query = "SELECT * FROM Team";
$teams = r2a($mysqli->query($query));
$new_teams = array();
foreach($teams as $t) {
  $new_teams[$t['teamAbbrev']] = $t['teamID'];
}
$query = "SELECT * FROM Position";
$positions = r2a($mysqli->query($query));
$pos = array();
foreach($positions as $p) {
  $pos[$p['name']] = $p['positionID'];
}
$file = fopen("scrape_data/players.txt", "r") or die("Unable to open file!");
echo "<pre>"; print_r($new_teams); echo "</pre>";
while(! feof($file)) {
  $line = fgets($file);
  $parts = explode(" -- ",$line);
  echo $parts[2];
  echo $new_teams[$parts[2]];
  echo $new_teams['ARI'];
  $abbr = rtrim($parts[2]," ");
  echo $abbr;
  echo $new_teams[$abbr];
  echo "<pre>"; print_r($parts); echo "</pre>";
  $query = "INSERT INTO Player (name,teamID,positionID) VALUES ('".$parts[1]."','".$new_teams[$parts[2]]."','".$pos[$parts[0]]."')";
  echo $query;
  die;
}
fclose($file);
include('footer.php');
?>

<script>
  $(".tile").click(function(){
    id = $(this).children("h3").attr('id') + ".php";
    window.location.href= id;
  });
</script>
