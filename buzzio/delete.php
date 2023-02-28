<?php
// when user click delete the codes will retrive the id and execute the delete function
$id = $_GET['category_id'];
require_once 'auth/query.php';
if (delete($id)) {
    echo "Record deletion success.";

    header('location:aboutme.php');
} else {
    echo "Record deletion failed.";
}

?>