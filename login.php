<style>
input[type="text"], input[type="password"]{
  width: 300px;
}
</style>
<?php
include('includes/header.php');
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM Users WHERE username='".$username."' AND password='".$password."'";
  $result = $mysqli->query($query);
  if($result->num_rows > 0){
    $array = r2a($result);
    $_SESSION['user']['id'] = $array[0]['userID'];
    $_SESSION['user']['username'] = $array[0]['username'];
    $_SESSION['user']['firstName'] = $array[0]['fName'];
    $_SESSION['user']['lastName'] = $array[0]['lName'];
    header("Location: index.php");
  } else { ?>
    <div class="alert alert-danger">
      <strong>Error:</strong> Username or password is incorrect.
    </div>
  <?php }
}
?>
<?php if(!checkLogin()) { ?>
<form method="post">
  <div class="form-group">
    <label for="firstName">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Login">
  </div>
</form>
<?php } else { ?>
  <div class="alert alert-warning">
    <strong>Warning:</strong> You are already logged in.
  </div>
<?php } ?>

<?php
include('includes/footer.php');
?>
