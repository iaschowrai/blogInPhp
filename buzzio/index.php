<?php
session_start();
require 'auth/query.php';
// creating variable for highlight and calling the function to load the id and title to highlight
$highlight = highlight('Yes');

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

<div class="container mt-5">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Auther</th>
        <th scope="col">Date</th>

      </tr>
    </thead>

    <tbody>
      <?php
// calling the fucntion to load all data 
      $records = indexQuery();
      echo $records['highlight'];
      $sno = 0;
      foreach ($records as $record) {
        $sno++;
        echo '<tr>';
        echo '<th scope="row">' . $sno . '</th>';
        echo '<td><a href="view.php?category_id=' . $record['category_id'] . '">' . $record['title'] . '</a></td>';
        echo '<td>' . $record['authurname'] . '</td>';
        echo '<td>' . $record['created_date'] . '</td>';
        echo '</tr>';
      }

      ?>
    </tbody>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<!-- pagination jquery -->
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>



<?php include 'hnf/footer.php'; ?>