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
<?php if($season == "" || $week == "") { ?>
  <div class="alert alert-danger">
    <strong>Error!</strong> Season and Week are not set.
  </div>
<?php } else {
  printCreatingTeamHeader($season,$week); ?>
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
        <tr><td>RB</td><td><select class='form-control' name="TE"><?php printPlayers("TE",isset($_POST['TE']) ? $_POST['TE'] : "",$week); ?></select></td></tr>
        <tr><td>RB</td><td><select class='form-control' name="FLEX"><?php printPlayers("FLEX",isset($_POST['FLEX']) ? $_POST['FLEX'] : "",$week); ?></select></td></tr>
        <tr><td>WR</td><td><select class='form-control' name="DF"><?php printPlayers("DF",isset($_POST['DF']) ? $_POST['DF'] : "",$week); ?></select></td></tr>
        <tr><td>WR</td><td><select class='form-control' name="WR2"><?php printPlayers("PK",isset($_POST['PK']) ? $_POST['PK'] : "",$week); ?></select></td></tr>
      </tbody>
    </table>
    <input class="btn btn-primary" type="submit" value="Create Team">
  </form>
  <?php } ?>
<?php
include('includes/footer.php');
?>
