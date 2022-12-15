<?php

// Include connection file
require_once "connection.php";

if (!isset($_SESSION['email'])) {
  header('location: login.php');
}


if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['email']); // value inside session
  header('location: login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

  <div class="container mt-5">
    <div class="d-flex justify-content-between">
      <h1>User List</h1>
      <div>
        <a href="add-user.php" class="btn btn-primary my-2">Add New User</a>
        <a href="?logout='1'" class="btn btn-outline-primary my-2">Logout</a>
      </div>
    </div>
    <?php
    if (isset($_SESSION['success'])) { ?>
      <div class=" alert alert-success my-4">
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success'])
        ?>
      </div>
    <?php } ?>

    <?php
    $sql = "SELECT * FROM users";

    if ($result = mysqli_query($conn, $sql)) {
      $i = 1;
      if (mysqli_num_rows($result) > 0) { ?>

        <table class="table table-bordered table-striped mt-3">
          <thead>
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php while ($row = mysqli_fetch_array($result)) { ?>

              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                  <a href="edit-user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                  <a href="delete-user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
        <?php }
          } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
          }
        } else {
          echo "Oops! Something went wrong. Please try again later.";
        }

        // Close connection
        mysqli_close($conn);
        ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>