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
<!-- when the user edit and submit button then id will pass -->

<?php

$category_id = "";
if (isset($_GET['category_id'])) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id === false) {
        // exit;
    }

    require_once 'auth/query.php';
    $record = readQuery($category_id);

    $checkbox_value = $record["highlights"];

?>
    <div class="container mt-3">
        <form action='y.php' method='POST'>
            <!-- <input name="category_id" type="hidden" value='<?php echo htmlspecialchars($record['category_id']); ?>' /> -->
            <input name="category_id" type="hidden" value='<?php echo htmlspecialchars($record['category_id']); ?>' />

            <div class="mb-3 col-3">
                <label for="disabledTextInput" class="form-label">Authur Name:</label>
                <input name="authurname" type="hidden" value='<?php echo htmlspecialchars($record['authurname']); ?>' />

                <input type="text" id="disabledTextInput" name="disabled" value='<?php echo htmlspecialchars($record['authurname']); ?>' 
                class="form-control" disabled>
            </div>

            <div class="mb-3 col-6">
                <label for="title" class="form-label">Title: </label>
                <input type="text" class="form-control" id="title" name="edit_title" required value='<?php echo htmlspecialchars($record['title']); ?>'>
            </div>

            <div class=" mb-3 col-7">
                <label for="exampleFormControlTextarea1" class="form-label">Content: </label>
                <textarea class="form-control" name="editcontent" id="exampleFormControlTextarea1" size="20" rows="18"><?php echo htmlspecialchars($record['content']); ?></textarea>
            </div>

            <div>
                <label class="form-check-label" for="exampleCheck1">To Highlight Check me out</label>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="editcheckbox" class="form-check-input" id="exampleCheck1" value="Yes" <?php if ($checkbox_value == 'Yes') echo 'checked'; ?>>

                </div>

            </div>
            <div>
                <button aligh-item="center" type="submit" class="btn btn-primary" name="update">Submit</button>
            </div>
        </form>

    </div>
<?php

}


?>