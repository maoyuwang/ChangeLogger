<?php
include_once "db.php";

class Comments
{
    private $SoftwareID;
    private $db;

    /**
     * Comments constructor.
     * @param $SoftwareID
     */
    public function __construct($SoftwareID)
    {
        $this->SoftwareID = $SoftwareID;
        $this->db = new db();
    }

    public function getComments()
    {
        $sql = "SELECT * FROM comments";
        return $this->db->select($sql);
    }

    public function addComment($username,$rating,$comment)
    {
        $sql = "INSERT INTO `comments` (`SoftwareID`, `Rating`, `Comment`, `User`) 
                VALUES ($this->SoftwareID,$rating , '$comment', '$username');";
        $this->db->insert($sql);
    }}?>