<?php
require_once(LIB_PATH.DS.'database.php');

class Remarks {
    protected static $tblname = "tblremarks"; // Assuming this is your table name

    // Fetch all remarks
    public function all_remarks() {
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tblname);
        return $mydb->loadResultList();
    }

    // Create new remark
    public function create_remark($remark) {
        global $mydb;
        $remark = $mydb->escape_value($remark);
        $mydb->setQuery("INSERT INTO ".self::$tblname." (REMARK) VALUES ('$remark')");
        return $mydb->executeQuery();
    }

    // Retrieve single remark
    public function get_remark($id) {
        global $mydb;
        $id = $mydb->escape_value($id);
        $mydb->setQuery("SELECT * FROM ".self::$tblname." WHERE ID = '$id' LIMIT 1");
        return $mydb->loadSingleResult();
    }

    // Delete remark
    public function delete_remark($id) {
        global $mydb;
        $id = $mydb->escape_value($id);
        $mydb->setQuery("DELETE FROM ".self::$tblname." WHERE ID = '$id' LIMIT 1");
        return $mydb->executeQuery();
    }

    public function single_remark($id) {
        global $mydb;
        $sql = "SELECT * FROM " . self::$tblname . " WHERE ID = '{$id}' LIMIT 1";
        $mydb->setQuery($sql);
        $remark = $mydb->loadSingleResult();
        return $remark;
    }
}

?>
