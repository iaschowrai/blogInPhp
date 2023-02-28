<?php
// Check if the form is submitted
function register()
{
    if (isset($_POST['reg-submit'])) {
        // Check if all required fields are filled
        if (
            empty($_POST['firstname']) || empty($_POST['lastname']) ||
            empty($_POST['dob'])       ||  empty($_POST['gender'])  ||
            empty($_POST['email'])     || empty($_POST['username']) ||
            empty($_POST['password'])  || empty($_POST['cpassword'])
        ) {
            echo "Please fill all the details.";
            show_register_form();
        } else {
            registered();
        }
    } else {
        show_register_form();
    }
}
function registered()
{
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $dob       = $_POST['dob'];
    $gender    = $_POST['gender'];
    $email     = $_POST['email'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Get the current date and time
    $created_date = date("Y-m-d H:i:s");

    // Verify if the entered password and confirm password match
    if ($password == $cpassword) {
        require_once 'dbaccess.php';
        $user = new User();

        if ($user->register($firstname, $lastname, $dob, $gender, $email, $username, $password, $created_date)) {
            header('Location: login.php');
            exit();
        } else {
            echo $result;
            show_register_form();
        }
    } else {
        echo 'Password not matched!';
        show_register_form();
    }
}

// User registration HTML Form 
function show_register_form()
{
    $location = $_SERVER["PHP_SELF"];
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Registration</h2>

                <form action='<?php echo ($location); ?>' method='POST'>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="cpassword" placeholder="Confirm Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="reg-submit" class="btn btn-primary">Submit</button>
                    </div>
                    Already a member? <a href="./login.php">Login here</a>
            </div>
            </form>
        </div>
    </div>

<?php
}
?>