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
    function sql($query,$args,$isselect){
        $ret=null;
        $where="1";
        if(!is_null($args)){
            $where=$args;
        }
        $query="{$query} WHERE {$where}";
        $result = $this->conn->query($query);
        if($isselect){
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $set[] = $row;
                    $ret=$set;
                    #echo "\n";
                }
            } else {
                #echo "0 results";
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
}

//Tests
if (!count(debug_backtrace())) {
    $test=new db();
    $query="Select * from softwares";
    $args=Null;
    print_r($test->sql($query,$args,true));
}

?>