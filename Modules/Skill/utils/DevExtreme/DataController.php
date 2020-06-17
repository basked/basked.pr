<?php
//require_once("../../DevExtreme/LoadHelper.php");
//spl_autoload_register(array("DevExtreme\LoadHelper", "LoadModule"));

use DevExtreme\DbSet;
use DevExtreme\DataSourceLoader;

class DataController {
    private $dbSet;
   public function __construct($db_host,$db_username,$db_password, $db_database,$tableName) {
        $mySQL = new mysqli($db_host,$db_username,$db_password, $db_database,3306);
        $this->dbSet = new DbSet($mySQL, $tableName);
    }

    public function Get($params) {
        $result = DataSourceLoader::Load($this->dbSet, $params);
        if (!isset($result)) {
            $result = $this->dbSet->GetLastError();
        }
        return $result;
    }
    public function Post($values) {
        $result = $this->dbSet->Insert($values);
        if (!isset($result)) {
            $result = $this->dbSet->GetLastError();
        }
        return $result;
    }
    public function Put($key, $values) {
        $result = NULL;
        if (isset($key) && isset($values) && is_array($values)) {
            if (!is_array($key)) {
                $keyVal = $key;
                $key = array();
                $key["ID"] = $keyVal;
            }
            $result = $this->dbSet->Update($key, $values);
            if (!isset($result)) {
                $result = $this->dbSet->GetLastError();
            }
        }
        else {
            throw new \Exception("Invalid params");
        }
        return $result;
    }
    public function Delete($key) {
        $result = NULL;
        if (isset($key)) {
            if (!is_array($key)) {
                $keyVal = $key;
                $key = array();
                $key["ID"] = $keyVal;
            }
            $result = $this->dbSet->Delete($key);
            if (!isset($result)) {
                $result = $this->dbSet->GetLastError();
            }
        }
        else {
            throw new \Exception("Invalid params");
        }
        return $result;
    }
}
