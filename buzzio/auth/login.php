<?php include '../hnf/header.php'; ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">buzzio</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/~user/Project1/buzzio/index.php">Home</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="../aboutme.php">Aboutme</a>
        </li> -->
      </ul>
      <a class="navbar-brand d-flex justify-content-center" href="#">Highlight</a>
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['user_id'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['username']; ?></a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php } else { ?>

          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registration.php">Register</a>
          </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</nav>


<!-- Login form -->

<style>
  form {
    background-color: #f8f9fa;
    /* set the background color */
  }

  .form-control {
    height: 30px;
    /* set the height of the input fields */
    font-size: 14px;
    /* set the font size of the input fields */
  }
</style>

<div>

  <?php require_once('login-auth.php');

  authenticated();

  ?>

</div>




<?php include '../hnf/footer.php';
