<?php
include 'db.php';
include 'config.php';
class Homepage
{

    var $SearchName;
    var $conn;
    function __construct()
    {
        $this->conn = new db();
    }
    function searchSoftware($_SearchName)
    {
        $this->SearchName = $_SearchName;
        $query = "select Name from softwares";
        $args = "Name = SearchName";
        $this->conn->sql($query, $args, true);


    }
    function getAllSupportedSoftware()
    {
        $query = "SELECT * FROM softwares";
        $args = Null;
        $this->conn -> sql($query, $args, true);
        return  $this->conn -> sql($query, $args, true);
    }


}
$test_software=new Homepage();
print_r($test_software->getAllSupportedSoftware()) ;


