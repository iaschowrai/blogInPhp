<?php
session_start();
// session confirmation 
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // user is not logged in, redirect to login page
    header("Location: auth/login.php");
    exit;
}

?>

<?php

function create()
{
    if (isset($_POST['cre-submit'])) {
        // var_dump($_POST['cre-submit']);
        insert();
    } else {
        createform();
    }
}
?>

<?php
// insert function loading all the relevent data to database
function insert()
{
    session_start();
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $insertTitle = $_POST['title'];
    $insertContent = $_POST['content'];
    $authurname = $_SESSION['fullname'];
    $category_type = 'category';
    $created_date = date("Y-m-d H:i:s");
    $checkbox = NULL;
    // check box checked then Yes otherwise No
    if ($_POST['checkbox']) {
        $checkbox = "Yes";
    } else {
        $checkbox = "No";
    }
   
    require_once 'auth/query.php';

    if (insertiontodb($category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox, $authurname, $userid)) {
        header('location: aboutme.php');
        exit;
    } else {
        return "Record Not Submitted";
    }
}
?>

<?php
function createform()
{
    $location = $_SERVER["PHP_SELF"];
?>
    <div class="container mt-3">
        <form action='<?php echo ($location); ?>' method='POST'>

            <div class="mb-3 col-6">
                <label for="title" class="form-label">Title: </label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class=" mb-3 col-7">
                <label for="exampleFormControlTextarea1" class="form-label">Content: </label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" size="20" rows="18"></textarea>
            </div>

            <div>
                <label class="form-check-label" for="exampleCheck1">To Highlight Check me out</label>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="checkbox" class="form-check-input" id="exampleCheck1">

                </div>

            </div>
            <div>
                <button aligh-item="center" type="submit" class="btn btn-primary" name="cre-submit">Submit</button>
            </div>
        </form>

    </div>
    <?php include '../hnf/footer.php'; ?>
<?php

}
?>
