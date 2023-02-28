<?php
if (isset($_POST['update'])) {
    // var_dump($_POST['update']);
    session_start();

    // echo $_post['update'];
    $userid = $_SESSION['userid'];
    // echo $user_id;

    $category_id = $_POST['category_id'];
    $username = $_SESSION['username'];
    $editTitle = $_POST['edit_title'];
    $editContent = $_POST['editcontent'];
    $authurname = $_POST['authurname'];
    $category_type = 'category';
    $created_date = date("Y-m-d H:i:s");


    // echo $userid;
    // echo $category_id;
    // echo $category_type;
    // echo $username;
    // echo $editTitle;
    // echo $editContent;
    // echo $authurname;   

    $k = $_POST['editcheckbox'];
    // var_dump($k);


    $checkbox = NULL;
    if ($_POST['editcheckbox']) {
        $checkbox = "Yes";
        // echo $checkbox;
    } else {
        $checkbox = "No";
        // echo $checkbox;
    }

    require_once 'auth/query.php';

    if (editInToDb($category_id, $category_type, $editTitle, $editContent, $created_date, $username, $checkbox, $authurname, $userid)) {
        header('location: aboutme.php');
        // exit;
    } else {
        return "Record Not Submitted";
    }
}
