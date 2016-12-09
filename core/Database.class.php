<?php

/**
 * Singlenton Implementation of a universal Database object, with functions to execute queries.
 * Only one instance of this object is active per session.
 * 
 */
class database {

    private $host;
    private $user;
    private $pass;
    private $dbName;
    private static $instance;
    private $connection;
    private $results;
    private $numRows; // optional

    /**
     * 
     */

    private function __construct() {
        
    }

    // singleton pattern
    /**
     * Singlenton pattern database, to ensure only 1 instance of a database connection is initiated
     * 
     * @return type of Database instance
     */
    static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Connection function to connect to the Database using the current instanse, using the connection parameters.
     * 
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $dbName
     */
    function connect($host, $user, $pass, $dbName) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbName = $dbName;
        try {

            $conn = new PDO("sqlsrv:server=$this->host;Database=$this->dbName", $this->user, $this->pass);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $conn;
        } catch (Exception $e) {

            die(print_r($e->getMessage()));
        }
    }

    /**
     * Executes the SQL query passed as parameter.
     * 
     * @param string $sql the sql command to be executed
     */
    public function doQuery($sql) {

        //echo $sql."<br>";
        //exit();
        $this->results = $this->connection->prepare($sql);
        $this->results->execute();
        $this->numRows = $this->results->rowCount();
    }

    /**
     * Function that executes a SQL parameterized query. The variable parameters are passed as an array.
     * 
     * @param string $sql the sql command to be executed (variable parameters passed as :param)
     * @param array $param the parameters to be binded to the variables in the sql parameters (:param =>value) 
     */
    public function doQueryParam($sql, $param) {

        $this->results = $this->connection->prepare($sql);
        $this->results->execute($param);
        $this->numRows = $this->results->rowCount();
    }

    /**
     * Function to load the querry result in an arrar for processing. Also counts the number of rows affected and update numRows 
     * 
     * @return associate array
     */
    public function loadObjectList() {
        $obj = "No Results";
        $count = 0;
        if ($this->results) {
            $obj = $this->results->fetchAll(PDO::FETCH_ASSOC);
        }
        if (isset($obj) && is_array($obj)) {
            foreach ($obj as $row) {
                $count ++;
            }
            $this->numRows = $count;
        }

        if ($count == 0) {
            return false;
        } else {
            return $obj;
        }
    }

    /**
     * Returns the number of rows affected by the SQl query
     * 
     * @return int
     */
    public function getRows() {

        return $this->numRows;
    }

    /**
     * Return the last Insert ID to an Instert SQL query. 
     * Only works on "Insert Into" SQl command and requires the ";SELECT SCOPE_IDENTITY() AS LastInsertID"
     * at the end of the SQL command
     * 
     * @return int
     */
    public function getInsertID() {
        $this->results->nextRowset();
        $result = $this->results->fetchAll();
        return $result[0]["LastInsertID"];
    }
    
     /**
     * Return the last Insert ID to an Instert SQL query from a Stored Procedure. The reason for the second method it that
     * stored procedures returns the results in oposite way. 
     * Only works on "Insert Into" SQl command and requires the ";SELECT SCOPE_IDENTITY() AS LastInsertID"
     * at the end of the SQL command
     * 
     * @return int
     */
    public function getInsertIDFromStorProc(){
        $result = $this->results->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]["LastInsertID"];
    }
    
    

    public function getConnection() {
        return $this->connection;
    }

}

// end class
