<?php
include_once 'config.php';
class db
{
    var $conn;
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
    //translating sql sentence to array(if is select)
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

    function insert($sql){
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    function close(){
        CloseCon($this->conn);
    }
}?>