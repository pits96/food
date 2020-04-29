<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
//Require the autoload file
require_once ("vendor/autoload.php");
//instantiate the f3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /',function(){

    $view = new Template();
    echo $view->render('views/home.html');
});
//breakfast route
$f3->route('GET /Breakfast',function(){
    $view = new Template();
    echo $view->render('views/bfast.html');
});
//breakfast green-eggs and ham route
$f3->route('GET /Breakfast/green-eggs',function(){
    $view = new Template();
    echo $view->render('views/greenEggsAndHam.html');
});
$f3->route('GET /Lunch',function(){
    $view = new Template();
    echo $view->render('views/lunch.html');
});
$f3->route('GET /Lunch/porkchop',function(){
    $view = new Template();
    echo $view->render('views/porkchop.html');
});
$f3->route('GET|POST /order',function($f3){
    if($_SERVER['REQUEST_METHOD']=='POST') {
//        var_dump($_POST);
        $meals = array("breakfast","lunch","dinner");
        if(empty($_POST['food'])||!in_array($_POST['meal'],$meals)){
            echo "<p>Please enter a food</p>";
        }
        else{
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            $f3->reroute('summary');
        }
    }
    $view = new Template();
    echo $view->render('views/order.html');
});
$f3->route('GET|POST /summary',function (){
    $view = new Template();
    echo $view->render('views/summary.html');
});
$f3->run();