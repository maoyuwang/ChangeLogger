<?php
include_once 'db.php';
class Software {
    private $ID;
    private $name;
    private $icon;
    private $description;
    private $database;
    

    function __construct($_ID) {
        $this->database = new db();
        $this->ID = $_ID;
        $this->name = $this->findName();
        $this->description = $this->findDescription();
        $this->icon = $this->findIcon();
    }

    function getID() {
        return $this->ID;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getIcon() {
        return $this->icon;
    }


    //get all the changelogs of the software
    function getChangelogs() {
        $query = "SELECT * FROM data WHERE SoftwareID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return "No details available.";
        else return $result;
    }

    //find and return the name.
    function findName() {
        $query = "SELECT Name FROM softwares WHERE ID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return NULL;
        else return $result[0]["Name"];
    }

    //find and return the description.
    function findDescription() {
        $query = "SELECT Description FROM softwares WHERE ID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return NULL;
        else return $result[0]["Description"];
    }

    //find and return the icon file name.
    function findIcon() {
        $query = "SELECT Icon FROM softwares WHERE ID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return NULL;
        else return $result[0]["Icon"];
    }}?>
