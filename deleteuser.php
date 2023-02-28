<?php

$id = $_GET['register_id'];
require_once 'auth/query.php';
if (deleteuser($id)) {
    // echo "Record deletion success.";

    header('location:profile.php');
} else {
    echo "Record deletion failed.";
}

?>