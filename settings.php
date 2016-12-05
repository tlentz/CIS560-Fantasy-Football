<?php
session_start();
$mysqli = new mysqli("mysql.cis.ksu.edu", "markloev", "pcEkhG5B5kg8XExJ%RD", "markloev");

if(isset($_GET['username'])){
  echo "<div class='alert alert-success'>
    <strong>Success! </strong>You have successfully updated your username.
  </div>";
}

if(isset($_POST['confirmNewUsername'])){
  $username = $_POST['newUsername'];
  $query = "SELECT username FROM Users";
  $result = $mysqli->query($query);
  $array = r2aSettings($result);
  $taken = false;
  foreach($array as $a){
    if($username == $a['username']){
      $taken = true;
    }
  }
  if(!$taken){
    $query = "UPDATE Users SET username='".$username."' WHERE username='".$_SESSION['user']['username']."'";
    $mysqli->query($query);
    $_SESSION['user']['username'] = $username;
    header("settings.php?username=true");
  }
}

if(isset($_POST['confirmNewPassword'])){
  $password = $_POST['confirmPassword'];
  $query = "UPDATE Users SET password='".$password."' WHERE username='".$_SESSION['user']['username']."'";
  $mysqli->query($query);
  echo "<div class='alert alert-success'>
    <strong>Success! </strong>You have successfully updated your password.
  </div>";
}

include('includes/header.php');

?>

<style>
  .btn{
    width: 15%;
  }

  #usernameSection, #passwordSection{
    display: none;
  }

  input[type="text"], input[type="password"]{
    width: 300px;
  }
</style>

<button class='btn btn-primary' id="changeUsername" name="changeUsername">Change Username</button>
<button class='btn btn-primary' id="changePassword" name="changePassword">Change Password</button>
<br><br>
<form method="post">
  <div id="usernameSection">
    <label>New Username</label>
    <input type="text" class="form-control" id="newUsername" name="newUsername"><br>
    <input type="submit" class="btn btn-primary form-control" id="confirmNewUsername" name="confirmNewUsername">
  </div>
  <div id="passwordSection">
    <label>New Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <label>Confirm New Password</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
    <label id="match"></label><br><br>
    <input type="submit" disabled class="btn btn-primary" id="confirmNewPassword" name="confirmNewPassword">
  </div>
</form>

<?php
include('includes/footer.php');

function r2aSettings($r) {
  $a = array();
  while($row = mysqli_fetch_assoc($r)) {
    $a[] = $row;
  }
  return $a;
}
?>

<script>
$("#changeUsername").click(function(){
  $("#usernameSection").css("display", "block");
  $("#passwordSection").css("display", "none");
})

$("#changePassword").click(function(){
  $("#passwordSection").css("display", "block");
  $("#usernameSection").css("display", "none");
})

$("#confirmPassword").on('input', function(){
  var password = $("#password").val();
  var confirmPassword = $("#confirmPassword").val();
  if(password==confirmPassword){
    $("#match").css("color", "green");
    $("#match").text("Passwords match");
    $("#confirmNewPassword").removeAttr("disabled");
  }
  else{
    $("#match").css("color", "red");
    $("#match").text("Passwords do not match");
    $("#confirmNewPassword").attr("disabled","disabled");
  }
});
</script>
