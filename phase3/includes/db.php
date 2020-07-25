<?php
//DB Constants
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'hurc_guestbook');
define('TABLE_GUEST', 'guests');
define('TABLE_USERS', 'users');

class DB
{
    //Connection string
    private $conn = null;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Make db connection
     */
    public function connect()
    {
        try {
            $this->conn = new mysqli(HOST, USER, PASS, DB);
            if ($this->conn->connect_errno) {
                throw new Exception("Connection failed. " . $this->conn->connect_error);
            }
            //$this->setConn($temp);
        } catch (Exception $e) {
            echo "Something went wrong.  Couldn't connect.";
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Invoke database query
     * @param $query
     * @return bool|mysqli_result
     */
    public function makeQuery($query)
    {
        return @mysqli_query($this->conn, $query);
    }

    /**
     * Method to retrieve a single record from a table
     * @param $id - the unique id to filter
     * @param $table - the table to query data
     * @return bool|mysqli_result - query set or false
     */
    public function getOneRecord($id, $table)
    {
        $query = "SELECT * FROM $table WHERE id='$id'";
        return $this->makeQuery($query);
    }

    /**
     * Method to retrieve all records from a table
     * @param $table
     * @return bool|mysqli_result
     */
    public function getAllRecords($table)
    {
        $query = "SELECT * FROM $table";
        return $this->makeQuery($query);
    }

    /**
     * Method to delete a single record from a table
     * @param $id
     * @param $table
     * @return bool|mysqli_result
     */
    public function deleteOneRecord($id, $table)
    {
        $query = "DELETE FROM $table WHERE id='$id'";
        return $this->makeQuery($query);
    }

    /**
     * Method to update or modify a specific record in a table
     * @param $data
     * @param $table
     * @return bool|mysqli_result
     */
    public function updateOneRecord($data, $table)
    {
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $comment = $data['comment'];

        $query = "UPDATE $table SET name='$name', email='$email', comment='$comment'
               WHERE id='$id'";
        return $this->makeQuery($query);
    }

    /**
     * Method to insert a single record into a table
     * @param $table
     * @param $data
     * @return bool|mysqli_result
     */
    public function insertOneRecord($table, $data)
    {
        $str = "";
        foreach ($data as $value) {
            $str .= "'$value',";
        }

        $str = rtrim($str, ',');  //Remove last character
        $query = "INSERT INTO $table VALUES(NULL,$str)";
        return $this->makeQuery($query);
    }

    /**
     * Method to check if username is already taken
     * @param $username
     * @param $table
     * @return bool
     */
    public function verifyUser($username, $table)
    {
        $query = "SELECT * FROM $table WHERE username='$username'";
        $result = $this->makeQuery($query);
        if (@mysqli_num_rows($result) > 0) {
            //User exists
            return true;
        }
        return false;
    }

    /**
     * Method to verify a user's password using a hash
     * @param $username
     * @param $password
     * @param $table
     * @return bool
     */
    public function verifyPassword($username, $password, $table)
    {
        $query = "SELECT password FROM $table WHERE username='$username'";
        $result = $this->makeQuery($query);
        if (@mysqli_num_rows($result) > 0) {
            $row = @mysqli_fetch_array($result);
            if (password_verify($password, $row['password'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return null
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param null $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    public function close(){
        $this->conn->close();
    }
}
