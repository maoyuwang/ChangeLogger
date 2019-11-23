<?php
include_once "db.php";
class Searcher{
    var $db;
    function __construct()
    {
        $this->db = new db();
    }

    function search($keyword){
        $query = "SELECT * FROM softwares WHERE Name LIKE '%$keyword%' OR Description LIKE '%$keyword%'";
        return  $this->db -> select($query);
    }
}