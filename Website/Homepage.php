<?php
include 'db.php';
include 'config.php';
class Homepage
{
    var $conn;
    function __construct()
    {
        $this->conn = new db();
    }

    /**
     * @return all software information data for presenting the homepage.
     */
    function getAllSupportedSoftware()
    {
        $query = "SELECT * FROM softwares";
        return  $this->conn -> select($query);
    }
}
?>