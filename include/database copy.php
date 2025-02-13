<?php
require_once(LIB_PATH.DS."config.php");

class Database {
    var $sql_string = '';
    var $error_no = 0;
    var $error_msg = '';
    var $query = '';
    public $conn;
    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exists;
    
    function __construct() {
        $this->open_connection();
        $this->real_escape_string_exists = function_exists("mysql_real_escape_string");
    }
	
    public function open_connection() {
        try {
            $this->conn = new PDO("mysql:host=".server.";dbname=".database_name, user, pass);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Problem in database connection! Contact administrator! " . $e->getMessage();
            exit; // Exit script on connection failure
        }
    }
	
    function InsertThis($sql='') {
        $this->sql_string = $sql;
        $this->query = $this->conn->prepare($this->sql_string);
        
        if($this->query->execute()) {
            return true;
        } else {
            $this->error_msg = "Error executing query: " . $this->conn->errorInfo()[2];
            return false;
        }
    }
	
    public function setQuery($sql) {
        try {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute();
        return $result;
        } catch (PDOException $e) {
            error_log("Database Query Error: " . $e->getMessage());
            return false;
        }
    }   
    
    public function executeQuery(){
        try {
            $this->query->execute();
        } catch (PDOException $e) {
            echo "Failed to execute query: " . $e->getMessage();
            return false;
        }
        return true;
    }
    
    function loadResultList() {
        $results = $this->query->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    function loadSingleResultAssoc() {
        $results = $this->query->fetch(PDO::FETCH_ASSOC);
        return $results;
    }	
	
	public function num_rows() {
        return $this->query->rowCount();
    }
    
    function loadSingleResult() {
        $results = $this->query->fetch(PDO::FETCH_OBJ);
        return $results;
    }
    
    function getFieldsOnOneTable($tbl_name) {
        $this->setQuery("DESC ".$tbl_name);
        $rows = $this->loadResultList();
        
        $f = array();
        foreach ($rows as $row) {
            $f[] = $row->Field;
        }
        
        return $f;
    }

	public function fetch_array($result) {
		return mysqli_fetch_array($result);
	}
	//gets the number or rows	

    public function insert_id() {
        // Get the last id inserted over the current db connection
        return $this->conn->lastInsertId();
    }
    
    public function escape_value($value) {
        // Implement proper escaping logic if needed
        return $value;
    }
    
    public function getError() {
        return $this->query->errorInfo(); // Adjust this based on PDO error handling method
    }
    
    public function close_connection() {
        $this->conn = null;
    }
    
}

$mydb = new Database();
?>