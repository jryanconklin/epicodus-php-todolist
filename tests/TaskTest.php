<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../src/Task.php";
    require_once __DIR__."/../inc/ConnectionTest.php";

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
       {
           Task::deleteAll();
       }

        function test_save()
        {
            //Arrange
            $description = "Wash the dog";
            $test_task = new Task($description);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }
        function test_getId()
        {
            //Arrange
            $description = "Wash the dog";
            $id = 1;
            $test_Task = new Task($description, $id);

            //Act
            $result = $test_Task->getId();

            //Assert
            $this->assertEquals(1, $result);
        }
        function test_find()
        {
            //Arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            //Act
            $id = $test_task->getId();
            $result = Task::findTaskID($id);

            //Assert
            $this->assertEquals($test_task, $result);
        }



    }


?>
