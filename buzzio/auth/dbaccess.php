<!-- This is based on OOP concept -->
<?php
class User
{
    private $dbserver = "localhost";
    private $dbusername = "root";
    private $dbpassword = "mysqlpassword";
    private $dbdatabase = "usersdb";
    protected $db;


    public function __construct()
    {
        $this->db = new mysqli($this->dbserver, $this->dbusername, $this->dbpassword, $this->dbdatabase);
        if ($this->db->connect_error) {
            die('Connection failed: ' . $this->db->connect_error);
        }
    }
// registering the first time user with cross check whether username or email is already registered otherwise the username will register
    public function register($firstname, $lastname, $dob, $gender, $email, $username, $password, $created_date)
    {

        // check if username already exists
        $stmt = $this->db->prepare("SELECT * FROM usersregistration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return "Username already exists";
        }

        // check if email already exists
        $stmt = $this->db->prepare("SELECT * FROM usersregistration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return "Email already exists";
        }
// password hassing
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usersregistration (first_name, last_name, date_of_birth, gender, email, username, password,  created_date) 
        VALUES (?, ?, ? ,?, ?, ?, ? ,?)");
        $stmt->bind_param("ssssssss", $firstname, $lastname, $dob, $gender, $email, $username, $hashpassword, $created_date);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
// login authentication 
    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT password FROM usersregistration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
// loading the databased on username wise for aauthentication
    public function user_Db_Query($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM usersregistration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // var_dump($rows);
            return $rows;
        } else {
            return false;
        }
    }

// load all the data from database for index page
    public function allIndex_Query()
    {
        $stmt = $this->db->prepare("SELECT * FROM compose ORDER BY created_date DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        } else {
            return false;
        }
    }
// load data based on id wise
    public function read_Query($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM compose WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // $rows = $result->fetch_all(MYSQLI_ASSOC);
            $rows = $result->fetch_assoc();
            return $rows;
        } else {
            return false;
        }
    }
// load the data for aboutme page
    public function allUser_Query($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM compose WHERE compose_username = ? ORDER BY created_date DESC");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // $rows = $result->fetch_assoc();
            // var_dump($rows);
            return $rows;
        } else {
            return false;
        }
    }
// deleting the record if the user delete the record
    public function deleteQuery($id)
    {
        $stmt = $this->db->prepare("DELETE FROM compose WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function countuser($usertype)
    {
        $stmt = $this->db->prepare("SELECT * FROM usersregistration WHERE user_type = ?");
        $stmt->bind_param("s", $usertype);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // $rows = $result->fetch_assoc();
            var_dump($rows);
            return $rows;
        } else {
            return false;
        }
    }


    public function insertIntoDb($category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox, $authurname, $userid)
    {

        $stmt = $this->db->prepare("INSERT INTO compose(category_type, title, content, created_date, compose_username, highlights, authurname, user_id)
        VALUES (?, ?, ? ,?, ?, ?, ?, ?)");
        var_dump($stmt);

        $stmt->bind_param("sssssssi", $category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox, $authurname, $userid);
        if ($stmt->execute()) {
            // var_dump($stmt);
            // echo $stmt;
            return true;
        } else {
            return false;
        }
    }

    public function updateintodb($category_id, $category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox, $authurname, $userid)
    {
        $stmt = $this->db->prepare("UPDATE compose SET category_type = ?, title = ?, content = ?, created_date = ?,compose_username = ?, highlights = ?, authurname = ? , user_id = ? WHERE category_id = ?");
        $stmt->bind_param("sssssssii", $category_type, $insertTitle, $insertContent, $created_date, $username, $checkbox, $authurname, $userid, $category_id);
        if ($stmt->execute()) {
            var_dump($stmt);
            // echo $stmt;
            return true;
        } else {
            return false;
        }
    }



    public function highlight_Query($highlight)
    {
        $stmt = $this->db->prepare("SELECT * FROM compose WHERE highlights = ? ORDER BY created_date DESC");
        $stmt->bind_param("s", $highlight);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {

            $rows = $result->fetch_assoc();
            // var_dump($rows);
            return $rows;
        } else {
            return false;
        }
    }

    public function displayusername($usertype){
        $stmt = $this->db->prepare("SELECT * FROM usersregistration WHERE user_type = ? ORDER BY username ASC");
        $stmt->bind_param("s", $usertype);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // $rows = $result->fetch_assoc();
            // var_dump($rows);
            return $rows;
        } else {
            return false;
        }

    }

    public function deleteuserdatabase($id){

        $stmt = $this->db->prepare("DELETE usersregistration, compose
        FROM usersregistration
        LEFT JOIN compose ON usersregistration.register_id = compose.user_id
        WHERE usersregistration.register_id =  ? ");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        var_dump($result);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }



    // public function __destruct() {
    //     $this->db->close();
    // }
}

?>