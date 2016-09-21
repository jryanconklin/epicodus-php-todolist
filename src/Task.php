<?php
    class Task
    {
//Properties
        private $description;
        private $category_id;
        private $id;
        private $due_date;

//Constructor
        function __construct($description, $id = null, $category_id, $due_date = null)
        {
            $this->description = $description;
            $this->id = $id;
            $this->category_id = $category_id;
            $this->due_date = $due_date;
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

        function getId()
        {
            return $this->id;
        }

        function getCategoryId()
        {
            return $this->category_id;
        }

        function setDueDate($new_due_date)
        {
            $this->due_date = $new_due_date;
        }

        function getDueDate()
        {
            return $this->due_date;
        }

//Regular Methods
        function save()
        {
            $GLOBALS['DB']->exec(
            "INSERT INTO tasks (description, category_id)
            VALUES ('{$this->getDescription()}',
            {$this->getCategoryId()})"
        );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function convertDueDate($due_date)
        {
            $due_date = strtotime($due_date);
            $due_date = date('Y-m-d', $due_date);
            return $due_date;
        }

        function saveDate()
        {
            $GLOBALS['DB']->exec(
            "INSERT INTO tasks (description, category_id, due_date)
            VALUES ('{$this->getDescription()}',
            {$this->getCategoryId()}, '{$this->getDueDate()}');"
        );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }




//Static Methods

        static function getAll()
            {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks ORDER BY due_date;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $category_id = $task['category_id']; //pull due date :)
                $due_date = $task['due_date'];
                $new_task = new Task($description, $id, $category_id, $due_date);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks;");
        }

        static function findId($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach($tasks as $task) {
                $task_id = $task->getId();
                if ($task_id == $search_id) {
                    $found_task = $task;
                }
            }
            return $found_task;
        }



    }
?>
