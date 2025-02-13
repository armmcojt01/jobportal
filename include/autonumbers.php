<?php
require_once('config.php');
require_once('database.php');

class Autonumber {
    protected static $tblname = "tblautonumbers";

    function dbfields() {
        global $mydb;
        return $mydb->getfieldsononetable(self::$tblname);
    }

    function single_autonumber($id = "") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname." 
            WHERE AUTOID= '{$id}' LIMIT 1");
        $cur = $mydb->loadSingleResult();
        return $cur;
    }

public function set_autonumber($key) {
    global $mydb;
    $sql = "SELECT AUTOEND FROM ".self::$tblname." WHERE AUTOKEY='{$key}'";
    $mydb->setQuery($sql);
    $result = $mydb->loadSingleResult();
    if ($result) {
        $next_number = $result->AUTOEND + 1;
        return (object) ['AUTO' => str_pad($next_number, 5, '0', STR_PAD_LEFT)];
    } else {
        echo "Autonumber key not found.";
        exit;
    }
}

    static function instantiate($record) {
        $object = new self;
        foreach ($record as $attribute => $value) {
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

    public function update($id = "") {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".self::$tblname." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE AUTOID='{$id}'";

        if (!$mydb->setQuery($sql)) return false;
    }

    public function auto_update($id = "") {
        global $mydb;
        $sql = "UPDATE ".self::$tblname." SET AUTOEND = AUTOEND + AUTOINC WHERE AUTOKEY='{$id}'";
        $mydb->setQuery($sql);
        if ($mydb->getError()) {
            echo "Failed to update autonumber: " . $mydb->getError();
            exit;
        }
    }
    
    

    public function delete($id = "") {
        global $mydb;
        $sql = "DELETE FROM ".self::$tblname;
        $sql .= " WHERE AUTOKEY='{$id}'";
        $sql .= " LIMIT 1 ";

        if (!$mydb->setQuery($sql)) return false;
    }
}
?>
