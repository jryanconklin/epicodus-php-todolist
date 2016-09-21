<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Task.php';
    require_once __DIR__."/../src/Category.php";
    require __DIR__."/../inc/Connection.php";

//Setup
    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    
//Home Path
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('categories' => Category::getAll()));
    });


//Tasks Path
    $app->get("/tasks", function() use ($app) {
        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    $app->post("/tasks", function() use ($app) {
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $due_date = $_POST['due_date'];
        $due_date = strtotime($due_date);
        $due_date = date('Y-m-d', $due_date);
        $task = new Task($description, $id = null, $category_id, $due_date);
        $task->saveDate();
        $category = Category::findId($category_id);
        return $app['twig']->render('category.html.twig', array('category' => $category, 'tasks' => $category->getTasks()));
    });


//Categories Path
    $app->get("/categories", function() use ($app) {
       return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    $app->post("/categories", function() use ($app) {
      $category = new Category($_POST['name']);
      $category->save();
      return $app['twig']->render('index.html.twig', array('categories' => Category::getAll()));
    });

    $app->get("/categories/{id}", function($id) use ($app) {
        $category = Category::findId($id);
        return $app['twig']->render('category.html.twig', array('category' => $category, 'tasks' => $category->getTasks()));
    });

    $app->get("/categories/{id}/edit", function($id) use ($app) {
        $category = Category::findId($id);
        return $app['twig']->render('category_edit.html.twig', array('category' => $category));
    });

    $app->patch("/categories/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $category = Category::findId($id);
        $category->update($name);
        return $app['twig']->render('category.html.twig', array('category' => $category, 'tasks' => $category->getTasks()));
    });

//Delete Categories Path
    $app->post("/delete_categories", function() use ($app) {
        Category::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/delete_tasks", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
?>
