<?php
include 'config.php';
class db
{
    var $conn;
    function __construct($servername, $username,$password,$dbname)
    {
        $this->conn = new mysqli($servername, $username, $password,$dbname);
        if($this->conn) {
            echo "Connection established\n";
        }else{
            echo "Connection could not be established.\n";
            die( print_r( sqlsrv_errors(), true));
        }
    }
    function translate(){
        $query="SELECT * FROM 'data'";
        $result = $this->conn->query($query);
        if(is_null($result)){
            echo "Sccuess";
        }else{
            echo "Fail";
        }
        /*if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["ID"]. " - Name: " . $row["Name"]. " " . $row["Description"]. "<br>";
            }
        } else {
            echo "0 results";
        }*/
    }
    function  close(){
        CloseCon($this->conn);
    }
}
$test=new db($servername, $username,$password, $dbname);
$test->translate();
?>