<?php

session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // user is not logged in, redirect to login page
    header("Location: auth/login.php");
    exit;
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

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="create.php">Write</a>
                    </li> -->
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


<div>

    <?php require_once('create.php');
    create();

    ?>

</div>




<?php include '/~user/project1/buzzio/hnf/footer.php'; ?>