<?php

//  function to call db to fetch all data from database
function indexQuery(){
    require_once 'dbaccess.php';
    $user = new User();
    return $user->allIndex_Query();
    
}

//  function to call db to view the data
function readQuery($id){
    require_once 'dbaccess.php';
    $user = new User();
    return $user->read_Query($id);
}

// function to call db to know the userdetails
function userDbQuery($username){
    // var_dump($username);
    require_once 'dbaccess.php';
    $user = new User();
    // var_dump($user);
    return $user->user_Db_Query($username);
}

// function to call db to fetch user data
function allUserQuery($username){
    // var_dump($username);
    require_once 'dbaccess.php';
    $user = new User();
    // var_dump($user);
    return $user->allUser_Query($username);
}

function insertiontodb($category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox,$authurname, $userid){
    require_once 'dbaccess.php';
    $user = new User();
    // var_dump($user);
    // echo $user;
    return $user->insertIntoDb($category_type,$insertTitle,$insertContent,$created_date,$username, $checkbox,$authurname, $userid);
}

function editInToDb($category_id, $category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox, $authurname, $userid){
    require_once 'dbaccess.php';
    $user = new User();
    // echo $userid;
    // var_dump($user);
    return $user->updateintodb($category_id, $category_type,$insertTitle,$insertContent,$created_date,$username, $checkbox,$authurname, $userid);

}

function delete($id){
    require_once 'dbaccess.php';
    $user = new User();
    return $user->deleteQuery($id);
}

function countuser(){
    $usertype= 'user';
    require_once 'dbaccess.php';
    $user = new User();
    return $user->countuser($usertype);
}

function highlight($highlight){
    // $highlight = "Yes";
    return highligthQuery($highlight);
    // echo $ret;
    // var_dump($ret);
}

function highligthQuery($highlight){
    // var_dump($highlight);
    require_once 'dbaccess.php';
    $user = new User();
    // var_dump($user);
    
    return $user->highlight_Query($highlight);
}

function displayuser(){
    require_once 'dbaccess.php';
    $usertype = 'user';
    $user = new User();
    // var_dump($user);
    return $user->displayusername($usertype);
}


function deleteuser($id){
    require_once 'dbaccess.php';
    $user = new User();
    // var_dump($user);
    return $user->deleteuserdatabase($id);
}
?>