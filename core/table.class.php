<?php

/**
 *  Uses Active Record design pattern to implement a class that
 *  closely matches a given database table.  This class contains
 *  methods for binding the class members and methods to CRUD
 *  database management principles.  This type of class is sometimes
 *  referred to a "Table Model", and in many designs it is implemented
 *  as an abstract base class, which is then extended and specialized
 *  as necessary.
 */
class table {

    protected $id = null;
    protected $_isValid = FALSE;

    /**
     *
     * @var string $table Table name must be set in all classes extenting table class 
     */
    protected $table = null;

    /**
     *
     * @var string $IDName the name of the key column in the database table. Must be set in all classes extenting table class 
     */
    protected $IDName = null;

    function __construct() {
        
    }

    /**
     * Takes assoc array as param $data.  Dynamically creates class properties
     * with key as property name and value as its value.
     *
     * @param array $data key value pairs
     * @return
     * @access
     */
    function bind($data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Function to load the database values into the object properties based on the id
     * 
     * @param int $id the key of the table
     */
    function load($id) {
        $this->id = $id;
        $dbo = database::getInstance();
        $sql = $this->buildQuery('load');

        $dbo->doQuery($sql);

        $Arr = $dbo->loadObjectList();
        if (isset($Arr) && is_array($Arr)) {
            foreach ($Arr as $row) {
                if (isset($row) && is_array($row)) {
                    foreach ($row as $key => $value) {
                        if ($key == "id") {
                            continue;
                        }
                        $this->$key = $value;
                    }
                }
            }
            $this->_isValid = TRUE;
        } else {
            $this->_isValid = FALSE;
        }
    }

    /**
     * Function to store the object properties in the database table. Object properties names must match database column names
     * 
     */
    function store() {
        $dbo = database::getInstance();
        $sql = $this->buildQuery('store');

        $dbo->doQuery($sql);
        if ($this->id == "") {
            $this->id = $dbo->getInsertID();
            $this->setVar($this->IDName, $this->id);
        }
    }

    /**
     * Function to build the sql query for the table object. Uses the table parameters and match them with the
     * database columns. Database column names must match the object properties
     *  
     * @param string $task The require tasks (store,load) 
     * @return string
     */
    protected function buildQuery($task) {
        $sql = "";
        $dbo = database::getInstance();

        if ($task == "store") {
            // if no id value has been store in this object yet,
            //  add new record to the database, else just update the record.
            if ($this->id == "") {
                $tmpConn = $dbo->getConnection();
                $keys = "";
                $values = "";
                $classVars = get_object_vars($this);
                $sql .= "INSERT INTO {$this->table}";

                foreach ($classVars as $key => $value) {
                    $result = strpos($key, '_') === 0;
                    if ($key == "id" || $key == "table" || $key == "IDName" || $result) {
                        continue;
                    }
                    if ($value != "") {
                        $keys .= "{$key},";
                        //remove special characters
                        $tmpVal = $tmpConn->quote($value);
                        $values .= "$tmpVal,";
                    }
                }
                //	die();
                // NOTE: all substr($keys, 0, -1) does is gets rid of the comma
                // at the on the last array element.
                $sql .= "(" . substr($keys, 0, -1) . ") Values (" . substr($values, 0, -1) . ")";
                $sql .= ";SELECT SCOPE_IDENTITY() AS LastInsertID";
            } else {
                $tmpConn = $dbo->getConnection();
                $classVars = get_object_vars($this);
                $sql .= "UPDATE {$this->table} SET ";
                foreach ($classVars as $key => $value) {
                    $result = strpos($key, '_') === 0;
                    if ($key == "id" || $key == "table" || $key == "IDName" || $result) {
                        continue;
                    }
                    if ($value != "") {
                        //remove special characters
                        $tmpVal = $tmpConn->quote($this->$key);
                        //if ($value != "" && $key != $this->IDName){
                        if ($value == "NULL") {
                            if ($key != $this->IDName) {
                                $sql .= "{$key} = NULL, ";
                            }
                        } else {
                            if ($key != $this->IDName) {
                                $sql .= "{$key} = {$tmpVal}, ";
                            }
                        }
                    }
                }
                $sql = substr($sql, 0, -2) . " WHERE {$this->IDName} = {$this->id}";
                //echo $sql;
                //exit();
            }
        } elseif ($task == "load") {
            $tmpConn = $dbo->getConnection();
            $classVars = get_object_vars($this);
            $sql = "SELECT ";

            $first = true;
            foreach ($classVars as $key => $value) {
                $result = strpos($key, '_') === 0;
                if ($key == "id" || $key == "table" || $key == "IDName" || $result) {
                    continue;
                }
                if ($key != $this->IDName) {
                    if ($first) {
                        $sql .= "$key";
                        $first = false;
                    } else {
                        $sql .= ",$key";
                    }
                }
            }

            $sql .= " FROM {$this->table} WHERE {$this->IDName} = '{$this->id}'";
        }
        return $sql;
    }

    /**
     * Function to get a column value.
     */
    public function getVar($varName) {
        return $this->$varName;
    }

    /**
     * Function to set a column value.
     */
    public function setVar($varName, $value) {
        $this->$varName = $value;
    }

    /**
     * Function to return if row is valid
     *  
     * @return $_isValid
     */
    public function isValid() {
        return $this->_isValid;
    }

    /**
     * Function to initialize the table row with an array of columns or with the row id
     *  
     * @param $properties Can be an array or an int.
     */
    public function initialize($properties) {
        if (is_array($properties)) {
            foreach ($properties as $var => $value) {
                if (property_exists($this, $var)) {
                    $this->$var = $value;
                }
            }
        } else {
            $this->load($properties);
        }
    }

}

// end class
?>