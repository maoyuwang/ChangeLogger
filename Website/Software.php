<?php
include 'db.php';
include 'config.php';
class Software {
    private $ID;
    private $name;
    private $icon;
    private $description;
    private $database;
    

    function __construct($_ID) {
        global $servername,$username,$password, $dbname,$port;
        $this->database = new db($servername,$username,$password, $dbname,$port);
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
        $query = "SELECT Detail FROM data";
        $args = "SoftwareID = {$this->ID}";
        $result = $this->database->sql($query, $args, true);

        if ($result==NULL) return "No details available.";
        else return $result;
    }

    //get the changelog of a specific version
    function getChangelog($version) {
        $query = "SELECT Detail FROM data";
        $args = "SoftwareID = {$this->ID} and Version = {$version}";
        $result = $this->database->sql($query, $args, true);

        if ($result==NULL) return "No details available.";
        else return $result[0]["Detail"];
    }

    //find and return the name.
    function findName() {
        $query = "SELECT Name FROM softwares";
        $args = "ID = {$this->ID}";
        $result = $this->database->sql($query, $args, true);

        if ($result==NULL) return NULL;
        else return $result[0]["Name"];
    }

    //find and return the description.
    function findDescription() {
        $query = "SELECT Description FROM softwares";
        $args = "ID = {$this->ID}";
        $result = $this->database->sql($query, $args, true);

        if ($result==NULL) return NULL;
        else return $result[0]["Description"];
    }

    //find and return the icon file name.
    function findIcon() {
        $query = "SELECT Icon FROM softwares";
        $args = "ID = {$this->ID}";
        $result = $this->database->sql($query, $args, true);

        if ($result==NULL) return NULL;
        else return $result[0]["Icon"];
    }
    
}

//Tests
if (!count(debug_backtrace())) {
    $test_software=new Software(2);
    //echo $test_software->getName();
    //print_r($test_software->getChangelogs("1.8"));
    //print_r($test_software->getChangelogs("1.8.3"));
    print_r($test_software->getChangelogs());
    print_r($test_software);
}

?>