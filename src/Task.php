<?php
class Task
{
    private $description;

//Constructor
    function __construct($description)
    {
        $this->description = $description;
    }

//Getter and Setters
    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

//Regular Methods
    function save()
    {
        array_push($_SESSION['list_of_tasks'], $this);
    }

//Static Methods

    static function getAll()
    {
        return $_SESSION['list_of_tasks'];
    }

    static function deleteAll()
    {
        $_SESSION['list_of_tasks'] = array();
    }

}
?>
