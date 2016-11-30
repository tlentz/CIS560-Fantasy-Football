<?php
include('includes/header.php');
?>

<?php
$season = "";
$week = "";
if(isset($_GET['season'])) {
  $season = $_GET['season'];
}
if(isset($_GET['week'])) {
  $week = $_GET['week'];
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
  $errors = array();

  $QB = $_POST['QB'];
  if($QB == '') {
    $errors['QB'] = "QB is empty.";
  }

  $RB1 = $_POST['RB1'];
  if($RB1 == '') {
    $errors['RB1'] = "RB is empty.";
  }

  $RB2 = $_POST['RB2'];
  if($RB2 == '') {
    $errors['RB2'] = "RB is empty.";
  }

  $WR1 = $_POST['WR1'];
  if($WR1 == '') {
    $errors['WR1'] = "WR is empty.";
  }

  $WR2 = $_POST['WR2'];
  if($WR2 == '') {
    $errors['WR2'] = "WR is empty.";
  }

  $TE = $_POST['TE'];
  if($TE == '') {
    $errors['TE'] = "TE is empty.";
  }

  $FLEX = $_POST['FLEX'];
  if($FLEX == '') {
    $errors['FLEX'] = "FLEX is empty.";
  }

  $DF = $_POST['DF'];
  if($DF == '') {
    $errors['DF'] = "DF is empty.";
  }

  $PK = $_POST['PK'];
  if($PK == '') {
    $errors['PK'] = "PK is empty.";
  }

  if(empty($errors)) {
    $userID = $_SESSION['user']['id'];
    $weekID = $week;
    if(hasTeam($userID,$weekID)) {
      echo "<div class='alert alert-danger'><strong>Error!</strong> You already have a team for this week.  You can edit your current team or delete your current team before creating a new one.</div>";
    } else {
      $query = "INSERT INTO FantasyTeam (userID,weekID,QB,RB1,RB2,WR1,WR2,TE,FLEX,DF,PK) VALUES ($userID,$weekID,$QB,$RB1,$RB2,$WR1,$WR2,$TE,$FLEX,$DF,$PK)";
      $mysqli->query($query);
    }
  }
} else {
  $errors = array();
}
?>

<?php if($season == "" || $week == "") { ?>
  <div class="alert alert-danger"><strong>Error!</strong> Season and Week are not set.</div>
<?php } else if (hasTeam($_SESSION['user']['id'],$week)) {
      echo "<div class='alert alert-danger'><strong>Error!</strong> You already have a team for this week.  You can edit your current team or delete your current team before creating a new one.</div>";
  } else {
  printCreatingTeamHeader($season,$week);
  foreach($errors as $e) {
    echo "<div class='alert alert-danger'><strong>Error!</strong> $e</div>";
  }
  ?>
  <form method="POST">
    <?php //printPlayers("QB",isset($_POST['QB']) ? $_POST['QB'] : "",$week); ?>
    <table class='table table-striped'>
      <thead>
        <th>Position</th>
        <th>Player</th>
      </thead>
      <tbody>
        <tr><td>QB</td><td><select class='form-control' name="QB"><?php printPlayers("QB",isset($_POST['QB']) ? $_POST['QB'] : "",$week); ?></select></td></tr>
        <tr><td>RB</td><td><select class='form-control' name="RB1"><?php printPlayers("RB",isset($_POST['RB1']) ? $_POST['RB1'] : "",$week); ?></select></td></tr>
        <tr><td>RB</td><td><select class='form-control' name="RB2"><?php printPlayers("RB",isset($_POST['RB2']) ? $_POST['RB2'] : "",$week); ?></select></td></tr>
        <tr><td>WR</td><td><select class='form-control' name="WR1"><?php printPlayers("WR",isset($_POST['WR1']) ? $_POST['WR1'] : "",$week); ?></select></td></tr>
        <tr><td>WR</td><td><select class='form-control' name="WR2"><?php printPlayers("WR",isset($_POST['WR2']) ? $_POST['WR2'] : "",$week); ?></select></td></tr>
        <tr><td>TE</td><td><select class='form-control' name="TE"><?php printPlayers("TE",isset($_POST['TE']) ? $_POST['TE'] : "",$week); ?></select></td></tr>
        <tr><td>FLEX</td><td><select class='form-control' name="FLEX"><?php printPlayers("FLEX",isset($_POST['FLEX']) ? $_POST['FLEX'] : "",$week); ?></select></td></tr>
        <tr><td>DF</td><td><select class='form-control' name="DF"><?php printPlayers("DF",isset($_POST['DF']) ? $_POST['DF'] : "",$week); ?></select></td></tr>
        <tr><td>PK</td><td><select class='form-control' name="PK"><?php printPlayers("PK",isset($_POST['PK']) ? $_POST['PK'] : "",$week); ?></select></td></tr>
      </tbody>
    </table>
    <input class="btn btn-primary" type="submit" value="Create Team">
  </form>
  <?php } ?>
<?php
include('includes/footer.php');
?>
