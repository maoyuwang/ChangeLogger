<?php
include_once 'config.php';
/**
 * Class db
 * The abstraction of database operations.
 */
class db
{
    var $conn;

    /**
     * db constructor.
     * Create a connection to the database.
     */
    function __construct()
    {
        global $config;
        $this->conn = new mysqli($config['DB_SERVER'], $config['DB_USER'],$config['DB_PASSWORD'],$config['DB_NAME'],$config['DB_PORT']);
        if($this->conn) {
            //echo "Connection established\n";
        }else{
            echo "Connection could not be established.\n";
            die( print_r( sqlsrv_errors(), true));
        }
    }

    /**
     * @param $query The query string to execute.
     * @return null
     */
    function select($query){
        $ret=null;
        $result = $this->conn->query($query);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $set[] = $row;
                    $ret=$set;
                }
            }
        return $ret;
    }

    /**
     * @param $sql The query string to execute.
     * @return bool True/False if the execution is successful.
     */
    function insert($sql){
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    /**
     * Close the database connection.
     */
    function close(){
        CloseCon($this->conn);
    }
}?>