<?php
include 'config.php';
class db
{
    var $conn;
    function __construct($servername, $username,$password,$dbname,$port)
    {
        $this->conn = new mysqli($servername, $username,$password,$dbname,$port);
        if($this->conn) {
            echo "Connection established\n";
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
                    echo "\n";
                }
            } else {
                echo "0 results";
            }
        }
        return $ret;
    }
    function close(){
        CloseCon($this->conn);
    }
}

//Tests
if (!count(debug_backtrace())) {
    $test=new db($servername,$username,$password, $dbname,$port);
    $query="Select * from softwares";
    $args=Null;
    print_r($test->sql($query,$args,true));
}

?>