<?php
require_once(LIB_PATH.DS.'database.php');

class Employee {
    protected static $tblname = "tblemployees";

    public static function getTableName() {
        return self::$tblname;
    }

    function dbfields() {
        global $mydb;
        return $mydb->getfieldsononetable(self::$tblname);
    }

    function listofemployee() {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname);
        return $mydb->loadResultList();
    }

    function find_employee($id="", $name="") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname." 
            WHERE EMPLOYEEID = {$id} OR Lastname = '{$name}'");
        
        $row_count = $mydb->num_rows();
        return $row_count;
    }

    function find_all_employee($lname="", $Firstname="", $mname="") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname." 
            WHERE LNAME = '{$lname}' AND FNAME= '{$Firstname}' AND MNAME='{$mname}'");
        
        $row_count = $mydb->num_rows();
        return $row_count;
    }

    function single_employee($id="") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname." 
            Where EMPLOYEEID= '{$id}' LIMIT 1");
        $cur = $mydb->loadSingleResult();
        return $cur;
    }

    function select_employee($id="") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname." 
            Where INCID= '{$id}' LIMIT 1");
        $cur = $mydb->loadSingleResult();
        return $cur;
    }

    function EmployeeAuthentication($U_USERNAME, $h_pass) {
        global $mydb;
        $mydb->setQuery("SELECT * FROM `tblemployees` WHERE `EMPUSERNAME`='".$U_USERNAME."' AND `EMPPASSWORD`='".$h_pass."'"); 
        $row_count = $mydb->num_rows();
        if ($row_count == 1) {
            $emp_found = $mydb->loadSingleResult();
            $_SESSION['INCID'] = $emp_found->INCID; 
            $_SESSION['EMPLOYEEID'] = $emp_found->EMPLOYEEID; 
            $_SESSION['EMPUSERNAME'] = $emp_found->EMPUSERNAME;
            $_SESSION['EMPPASSWORD'] = $emp_found->EMPPASSWORD; 
            $_SESSION['FNAME'] = $emp_found->FNAME; 
            $_SESSION['LNAME'] = $emp_found->LNAME; 
            $_SESSION['MNAME'] = $emp_found->MNAME; 
            $_SESSION['ADDRESS'] = $emp_found->ADDRESS;  
            $_SESSION['DEPARTMENTID'] = $emp_found->DEPARTMENTID;  
            return true;
        } else {
            return false;
        }
    }

    static function instantiate($record) {
        $object = new self;
        foreach($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        } 
        return $object;
    }

    private function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        global $mydb;
        $attributes = array();
        foreach ($this->dbfields() as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $mydb;
        $clean_attributes = array();
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $mydb->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ".self::$tblname." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        
        if ($mydb->setQuery($sql)) {
            $this->id = $mydb->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update($id='') {
        global $mydb;
          $attributes = $this->sanitized_attributes();
          $attribute_pairs = array();
          foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
          }
          $sql = "UPDATE ".self::$tblname." SET ";
          $sql .= join(", ", $attribute_pairs);
          $sql .= " WHERE EMPLOYEEID='". $id."'";
       
           if(!$mydb->setQuery($sql)) return false; 	
          
      }
  
     public function empupdate($id=0) {
        global $mydb;
          $attributes = $this->sanitized_attributes();
          $attribute_pairs = array();
          foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
          }
          $sql = "UPDATE ".self::$tblname." SET ";
          $sql .= join(", ", $attribute_pairs);
          $sql .= " WHERE INCID=". $id;
       
           if(!$mydb->setQuery($sql)) return false; 	
          
      }

    public function delete($id='') {
        global $mydb;
        $sql = "DELETE FROM ".self::$tblname;
        $sql .= " WHERE EMPLOYEEID='". $id."'";
        $sql .= " LIMIT 1 ";
        
        if (!$mydb->setQuery($sql)) return false;
    }
}
?>
