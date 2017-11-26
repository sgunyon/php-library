<?php

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'library',
        'tblUser' => 'users',
        'tblBook' => 'books',
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        try {
            $this->objDBConnection = @new mysqli(
                    $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
            );

            if (mysqli_connect_errno() != 0) {
                throw new DatabaseException();
            }
        } catch (DatabaseException $ex) {
            $message = $ex->getError();
            UserController::error($message);
            exit();
        } catch (Exception $ex) {
            $message = $ex->getMessage();
            UserController::error($message);
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getInstance() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores books
    public function getBookTable() {
        return $this->param['tblBook'];
    }

    //returns the name of the table storing games
    public function getUserTable() {
        return $this->param['tblUser'];
    }

}

?>
