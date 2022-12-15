<?php

require_once "connection.php";
$errors = array();
if (isset($_POST['save'])) {

  $full_name = $_POST['full_name'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if (empty($full_name)) {
    array_push($errors, "Full Name is Required");
  }

  if (empty($email)) {
    array_push($errors, "Email is Required");
  }

  if (empty($password)) {
    array_push($errors, "Password is Required");
  }

  $sql = "INSERT INTO `users` (`full_name`, `email`, `password`) VALUES ('$full_name', '$email', '$password')";

  if (count($errors) == 0) {
    mysqli_query($conn, $sql);
    $_SESSION['success'] = "User Added successfully !";
    header('Location: index.php');
  }
  mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
  <div class="row justify-content-md-center">
    <div class="col col-lg-4">
      <div class="container mt-5">
        <h1 class="mb-4">Add New User</h1>
        <?php
        if (count($errors) > 0) {
          foreach ($errors as $error) {
        ?>
            <div class="alert alert-danger mt-3">
              <?php echo $error;
              ?>
            </div>
        <?php }
        } ?>
        <form action="add-user.php" method="post" class="mt-2">

          <div class="form-group mb-3">
            <label class="form-label">Full Name</label>
            <input class="form-control" type="text" name="full_name" placeholder="Full Name">
          </div>

          <div class="form-group mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Email Address">
          </div>

          <div class="form-group mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password">
          </div>

          <div class="form-group">
            <button class="btn btn-primary" type="submit" name="save">Save</button>
            <a class="btn btn-danger" href="index.php">Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>