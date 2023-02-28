<?php
session_start();

include 'hnf/header.php'; ?>
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

            <!-- <a class="navbar-brand d-flex justify-content-center" href="#">Highlight</a> -->

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
<style>
    .page-title {
        font-weight: bold;
        font-size: 2em;
        text-align: center;
        margin-bottom: 20px;
    }

    .author-name {
        font-size: 1.2em;
        font-style: italic;
        text-align: center;
        margin-bottom: 10px;
    }

    .publish-date {
        font-size: 1.1em;
        color: #999;
        text-align: center;
        margin-bottom: 30px;
    }

    .content {
        text-align: left;
    }
</style>
<?php

require_once 'auth/query.php';

$id = "";
if (isset($_GET['category_id'])) {
    $id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($id === false) {
        echo 'Invalid category_id parameter';
        exit;
    }
    $record = readQuery($id);
    if (!$record) {
        echo 'No Record Found!';
    }
} else {
    echo 'No Record Found!';
}

?>

<?php if ($record) { ?>
    <div class="container">

        <h1 class="page-title"><?php echo htmlspecialchars($record['title']); ?></h1>

        <p class="publish-date">Author name: <?php echo htmlspecialchars($record['authurname']); ?></p>

        <p class="publish-date">Published on <?php echo htmlspecialchars($record['created_date']); ?></p>

        <div class="content">
            <p><?php echo htmlspecialchars($record['content']); ?></p>
        </div>

    </div>
<?php } ?>

<?php include 'hnf/footer.php'; ?>