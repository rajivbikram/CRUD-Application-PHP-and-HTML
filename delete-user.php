<?php

// include database connection file

require_once "connection.php";

if (!isset($_SESSION['email'])) {
  header('location: login.php');
}

// Get id from URL to delete that user

$id = $_GET['id'];

// Delete user row from table based on given id

$deleteQuery =  "DELETE FROM users WHERE id = $id";

$result = mysqli_query($conn, $deleteQuery);

$_SESSION['success'] = "User Deleted successfully !";

// After delete redirect to index page.

header("Location: index.php");
