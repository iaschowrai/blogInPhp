<?php
session_start();

// Isset function check session is set or not
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  // user is not logged in, redirect to login page
  header("Location: auth/login.php");
  exit;
}

?>


<?php
$username = $_SESSION['username'];
require 'auth/query.php';
// calling the function to load the details of user
$records = userDbQuery($username);
$usertype= "";
$userid = "";
$firstname ="";
$lastname="";

foreach ($records as $record) {

  $userid = $record['register_id'];
  $firstname = $record['first_name'];
  $lastname = $record['last_name'];
  $dob = $record['date_of_birth'];
  $gender = $record['gender'];
  $username = $record['username'];
  $email = $record['email'];
  // $highlight = "Yes";
  $usertype = $record['user_type'];
  
  // 
}  $_SESSION['userid'] = $userid;
$_SESSION['fullname'] = $firstname.' '.$lastname;
// echo $_SESSION['fullname'];

// echo $_SESSION['userid'];
?>

<?php include 'hnf/header.php';
require_once 'auth/query.php';
$highlight = highlight('Yes');

?>
<!-- header  -->
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
        <div>
        <!-- </ul> -->
        <?php echo '<a class="navbar-brand d-flex justify-content-center" href="view.php?category_id=' . $highlight['category_id'] . '">' . $highlight['title'] . '</a>'?>
        <!-- <ul> -->
      </div>

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

<div class="container center">

  <a href="profile.php"> Profile</a>
</div>
<hr>

<!-- created table -->
<div class="container mt-5">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th style="text-align: center;" scope="col">Title</th>
        <th style="text-align: center;" scope="col">Auther</th>
        <th style="text-align: center;" scope="col">Date</th>
        <th style="text-align: center;" scope="col">Action</th>

      </tr>
    </thead>

    <tbody>
      <?php
// echo $usertype;
      // $queryRecord = null;
            // echo $usertype;
      if($usertype == 'admin'){
        require_once 'auth/query.php';
// callingthe function to load data for admin for all username
        $queryRecords = indexQuery();
      
        $sno = 0;
        foreach ($queryRecords as $queryRecord) {
          $sno++;
          echo '<tr>';
          echo '<th scope="row">' . $sno . '</th>';

          echo '<td><a href="view.php?category_id=' . $queryRecord['category_id'] . '">' . $queryRecord['title'] . '</a></td>';

          echo '<td>' . $queryRecord['authurname'] . '</td>';
          echo '<td>' . $queryRecord['created_date'] . '</td>';

          echo '<td><a href="edit.php?category_id=' . $queryRecord['category_id'] . '"> Edit</a> ';

          echo '<a href="delete.php?category_id=' . $queryRecord['category_id'] . '"
                onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';


          echo '</td>';
          echo '</tr>';
        }
      }
      // callingthe function to load data for user

      elseif($usertype == 'user'){
        require_once 'auth/query.php';
          $queryRecords = allUserQuery($username);
          
          $sno = 0;
          foreach ($queryRecords as $queryRecord) {
            $sno++;
            echo '<tr>';
            echo '<th scope="row">' . $sno . '</th>';

            echo '<td><a href="view.php?category_id=' . $queryRecord['category_id'] . '">' . $queryRecord['title'] . '</a></td>';

            echo '<td>' . $queryRecord['authurname'] . '</td>';
            echo '<td>' . $queryRecord['created_date'] . '</td>';

            echo '<td><a href="edit.php?category_id=' . $queryRecord['category_id'] . '"> Edit</a> ';
// onclick javascript function are used for popup message
            echo '<a href="delete.php?category_id=' . $queryRecord['category_id'] . '"
                  onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';


            echo '</td>';
            echo '</tr>';
          }
        }

      ?>
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<!-- java script query for pagination -->
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>


<?php include 'hnf/footer.php'; ?>