<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  // user is not logged in, redirect to login page
  header("Location: auth/login.php");
  exit;
}

?>

<?php
$username = $_SESSION['username'];
require 'auth/query.php';
$records = userDbQuery($username);
foreach ($records as $record) {

  $rid = $record['register_id'];
  $firstname = $record['first_name'];
  $lastname = $record['last_name'];
  $dob = $record['date_of_birth'];
  $gender = $record['gender'];
  $username = $record['username'];
  $email = $record['email'];
  $usertype = $record['user_type'];
  $highlight = "Yes";
  $_SESSION['usertype'] = $usertype;
}
?>

<?php include 'hnf/header.php'; ?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">buzzio</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <?php if (isset($_SESSION['authenticated'])) { ?>

          <li class="nav-item">
            <a class="nav-link" href="aboutme.php">Aboutme</a>
          </li>
        <?php } ?>

      </ul>
      <!-- <a class="navbar-brand d-flex justify-content-center" href="#">highlight </a> -->

      <ul class="navbar-nav">
        <?php if (isset($_SESSION['authenticated'])) { ?>

          <li class="nav-item">
            <a class="nav-link" href="write.php">Write</a>
          </li>
          <li class="nav-item">

            <a class="nav-link" href="profile.php">Welcome, <?php echo $_SESSION['fullname']; ?></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="auth/logout.php">Logout</a>
          </li>
        <?php } else { ?>

          <li class="nav-item">
            <a class="nav-link" href="auth/login.php">Login</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="auth/registration.php">Register</a>
          </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <?php
  // $_SESSION['fullname'] = $firstname . " " . $lastname;
  // echo $_SESSION['fullname'];
  ?>
  <p>User Type: <?php echo $usertype; ?></p>
  <p>Full Name: <?php echo $firstname . " " . $lastname; ?> </p>
  <p>DOB: <?php echo $dob; ?> Gender: <?php echo $gender; ?></p>
  <p>Email: <?php echo $email; ?></p>
</div>
<hr>

<?php
if ($usertype == 'admin') {
?>
  <div class="container mt-7 ">
    <table class="table border" id="myTable">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th style="text-align: left;" scope="col">Fullname</th>

          <th style="text-align: left;" scope="col">Username</th>

          <th style="text-align: left;" scope="col">Action</th>
        </tr>
      </thead>

      <tbody>
      <?php

      require_once 'auth/query.php';

      $allRecords = displayuser();

      $sno = 0;
      foreach ($allRecords as $allRecord) {

        $sno = $sno + 1;

        echo '<tr>';
        echo '<th scope="row">' . $sno . '</th>';

        echo '<td>' . $allRecord['first_name'] . ' ' . $allRecord['last_name'] . '</td>';
        echo '<td>' . $allRecord['username'] . '</td>';
        // echo '<td>' . $allRecord['register_id'] . '</td>';


        echo '<td><a href="deleteuser.php?register_id=' . $allRecord['register_id'] . '" 
        onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';


        echo '</td>';

        echo '</tr>';
      }
    }

      ?>
  </div>