<?php
include_once "db.php";

class Comments
{
    private $SoftwareID;
    private $db;

    /**
     * Comments constructor.
     * @param $SoftwareID The id of the software.
     */
    public function __construct($SoftwareID)
    {
        $this->SoftwareID = $SoftwareID;
        $this->db = new db();
    }

    /**
     * Return all the comments data.
     */
    public function getComments()
    {
        $sql = "SELECT * FROM comments WHERE SoftwareID = $this->SoftwareID";
        return $this->db->select($sql);
    }

    /**
     * Add a comment to the database.
     * @param $username The name of the user.
     * @param $rating The rating of this comment.
     * @param $comment The content of the comment.
     */
    public function addComment($username,$rating,$comment)
    {
        $sql = "INSERT INTO `comments` (`SoftwareID`, `Rating`, `Comment`, `User`) 
                VALUES ($this->SoftwareID,$rating , '$comment', '$username');";
        $this->db->insert($sql);
    }}?>