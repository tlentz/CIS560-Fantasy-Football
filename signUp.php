<style>
input[type="text"], input[type="password"]{
  width: 300px;
}

#confirmPassword{
  display: inline-block;
}

#confirm{
  display: block;
}
</style>
<?php
include('includes/header.php');

if(isset($_POST['submit'])){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "INSERT INTO Users (fName, lName, username, password) VALUES ('".$firstName."', '".$lastName."', '".$username."', '".$password."')";
  $result = $mysqli->query($query);
  if ($mysqli->connect_errno) { ?>
    <div class="alert alert-danger">
      <strong>Error!</strong> There was a problem processing your request.
    </div>
  <?php } else { ?>
    <div class="alert alert-success">
      <strong>Success!</strong> You have successfully created an account.  <a href="login.php">Login</a>
    </div>
  <?php }
}
?>

<form method="post">
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName">
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName">
  </div>
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label id="confirm">Confirm Password</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
    <label id="match"></label>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Create User" disabled>
  </div>
</form>

<?php
include('includes/footer.php');
?>

<script>
  $("#confirmPassword").on('input', function(){
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    if(password==confirmPassword){
      $("#match").css("color", "green");
      $("#match").text("Passwords match");
      $("#submit").removeAttr("disabled");
    }
    else{
      $("#match").css("color", "red");
      $("#match").text("Passwords do not match");
      $("#submit").attr("disabled","disabled");
    }
  });
</script>
