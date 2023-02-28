<?php

function authenticated(){
    if (isset($_POST['log-submit'])) {
        // Check if all required fields are filled
        if (
            empty($_POST['username']) || empty($_POST['password'])
        ) {
            echo "Please fill all the details.";
            show_login_form();
        } else {
            authentication();
        }
    } else {
        show_login_form();
    }

}
function authentication(){

    $username  = $_POST['username'];
    $password  = $_POST['password'];
    require_once 'dbaccess.php';

    $user = new User();
    if ($user->login($username, $password)) {
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        header('Location: ../aboutme.php');
        exit;
    } else {
        echo "Invalid username or password";
        show_login_form();
    }

}

function show_login_form(){

    $location = $_SERVER["PHP_SELF"];
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>

                <form action='<?php echo ($location); ?>' method='POST'>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="log-submit" class="btn btn-primary">Submit</button>
                    </div><br>
                    Want to be a member? Click Here -><a href="./Registration.php">Register here</a>
            </div>
            </form>
        </div>
    </div>

    <?php
}

?>
