<?php
include 'db.php';
class Software {
    var $ID;
    var $name;
    var $icon;
    var $description;
    function __construct($_ID, $_name, $_icon, $_description) {
        $this->ID = $_ID;
        $this->name = $_name;
        $this->icon = $_icon;
        $this->description = $_description;
    }

    function getID() {
        return $this->ID;
    }

    function getName() {
        echo $this->name;
    }

    function getIcon() {
        return $this->icon;
    }

    function getDescription() {
        return $this->description;
    }

    
    
}
/*$test_software=new Software(1, "HAHA", "k.jpg", "Feueuiw");
echo $test_software->getName();
print_r($test_software);
print_r($test->sql($query,$args,true));*/
?>