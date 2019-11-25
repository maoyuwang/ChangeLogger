<?php
include_once "db.php";

/**
 * Class Searcher
 * A class for handling search operation.
 */
class Searcher{
    var $db;
    function __construct()
    {
        $this->db = new db();
    }

    /**
     * @param $keyword The keyword to do searching.
     * @return The search result.
     */
    function search($keyword){
        $query = "SELECT * FROM softwares WHERE Name LIKE '%$keyword%' OR Description LIKE '%$keyword%'";
        return  $this->db -> select($query);
    }
}