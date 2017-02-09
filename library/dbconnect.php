<?php

/* 
databases
 */
function acmeConnect() {

    $server = 'localhost';
    $acmedatabase = 'acme';
    $username = 'iClient';
    $password = 'dAXz5MGK6spVdYvz';

    $dsn1 = 'mysql:host=' . $server . ';dbname=' . $acmedatabase;


    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $acmeLink = new PDO($dsn1, $username, $password, $options);
        //echo 'Connection successful <br>';
        return $acmeLink;
    } catch (PDOException $exc) {
        //echo $exc->getTraceAsString();
        //echo 'Connection Unsuccessful';
        //header("Location: http://localhost/ACME/errordocs/500.php");
        //$error = '.?action=error';
        header("Location: .?action=error");
        //return $error;
    }
}

function shop1Connect() {

    $server = 'localhost';
    $shop1database = 'my_guitar_shop1';
    $username = 'iClient';
    $password = 'dAXz5MGK6spVdYvz';

    $dsn2 = 'mysql:host=' . $server . ';dbname=' . $shop1database;

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);


    try {
        $shop1Link = new PDO($dsn2, $username, $password, $options);
        return $shop1Link; 
        //echo 'Connection successful <br>';
    } catch (PDOException $exc) {
        //echo $exc->getTraceAsString();
        //echo 'Connection Unsuccessful';
        //header("Location: http://localhost/ACME/errordocs/500.php");
        header("Location: .?action=error");        
        //return '.?action=error';       
    }
}

function shop2Connect() {

    $server = 'localhost';
    $shop2database = 'my_guitar_shop2';
    $username = 'iClient';
    $password = 'dAXz5MGK6spVdYvz';


    $dsn3 = 'mysql:host=' . $server . ';dbname=' . $shop2database;

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);


    try {
        $shop2Link = new PDO($dsn3, $username, $password, $options);
        return $shop2Link;
        //echo 'Connection successful <br>';
    } catch (PDOException $exc) {
        //echo $exc->getTraceAsString();
        //echo 'Connection Unsuccessful';
        //header("Location: http://localhost/ACME/errordocs/500.php");
        header("Location: .?action=error");
        //return '.?action=error';       
    }
}
