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

    /**
     * @return The id of the software.
     */
    function getID() {
        return $this->ID;
    }

    /**
     * @return The name of the software.
     */
    function getName() {
        return $this->name;
    }

    /**
     * @return The description of the software.
     */
    function getDescription() {
        return $this->description;
    }

    /**
     * @return The icon filename of the software.
     */
    function getIcon() {
        return $this->icon;
    }


    /**
     * @return All the changelogs of this software.
     */
    function getChangelogs() {
        $query = "SELECT * FROM data WHERE SoftwareID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return "No details available.";
        else return $result;
    }

    /**
     * Get the software name from the database.
     */
    function findName() {
        $query = "SELECT Name FROM softwares WHERE ID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return NULL;
        else return $result[0]["Name"];
    }

    /**
     * Get the description from the database.
     */
    function findDescription() {
        $query = "SELECT Description FROM softwares WHERE ID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return NULL;
        else return $result[0]["Description"];
    }

    /**
     * Get the icon from the database.
     */
    function findIcon() {
        $query = "SELECT Icon FROM softwares WHERE ID = {$this->ID}";
        $result = $this->database->select($query);

        if ($result==NULL) return NULL;
        else return $result[0]["Icon"];
    }}?>
