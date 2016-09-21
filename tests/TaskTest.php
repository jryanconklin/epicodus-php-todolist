<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../src/Task.php";
    require_once __DIR__."/../src/Category.php";
    require_once __DIR__."/../inc/ConnectionTest.php";



    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
       {
           Task::deleteAll();
           Category::deleteAll();
       }

       function test_getId()
       {
           //Arrange
           $name = "Home stuff";
           $id = null;
           $test_category = new Category($name, $id);
           $test_category->save();

           $description = "Wash the dog";
           $category_id = $test_category->getId();
           $test_task = new Task($description, $id, $category_id);
           $test_task->save();

           //Act
           $result = $test_task->getId();

           //Assert
           $this->assertEquals(true, is_numeric($result));
       }

        function test_getCategoryId()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            //Act
            $result = $test_task->getCategoryId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 = "Water the lawn";
            $test_task2 = new Task($description2, $id, $category_id);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 = "Water the lawn";
            $test_task2 = new Task($description2, $id, $category_id);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_findId()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $test_task = new Task($description, $id, $category_id);
            $test_task->save();

            $description2 = "Water the lawn";
            $test_task2 = new Task($description2, $id, $category_id);
            $test_task2->save();

            //Act
            $result = Task::findId($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }

        function test_getDueDate()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = "07/09/1980";
            $test_task = new Task($description, $id, $category_id, $due_date);
            $test_task->save();

            //Act
            $result = $test_task->getDueDate();

            //Assert
            $this->assertEquals($due_date, $result);
        }

        function test_convertDueDate()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = "07/09/1980";
            $test_task = new Task($description, $id, $category_id, $due_date);
            $test_task->save();

            //Act
            $result = $test_task->convertDueDate($due_date);

            //Assert
            $this->assertEquals("1980-07-09", $result);
        }

        function test_saveDate()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = "07/09/1980";
            $due_date = strtotime($due_date);
            $due_date = date('Y-m-d', $due_date);
            $test_task = new Task($description, $id, $category_id, $due_date);

            //Act
            $test_task->saveDate();

            //Assert
            $result = Task::getAll();
            // var_dump($result[0]);
            $this->assertEquals($test_task, $result[0]);
        }


    }
?>
