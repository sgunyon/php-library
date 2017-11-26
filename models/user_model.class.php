<?php

class UserModel {

    //private data members
    private $db;
    private $dbConnection;

    //the constructor. It initializes two data members.
    public function __construct() {
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    /*
     * the list_user method retrieves all users from the database and
     * returns an array of User objects if successful or false if failed.
     * Users should also be filtered by ratings and/or sorted by firstnames or rating if they are available.
     */

    public function list_user() {
        //Construct the MySQL select statement.
        $sql = "SELECT * FROM " . $this->db->getUserTable() . " WHERE role != 4";
        try {
            //execute the query
            if (!($query = $this->dbConnection->query($sql))) {
                throw new UserBadResults();
            } else {

                //handle the result
                if ($query && $query->num_rows > 0) {
                    //create an array to store all returned users
                    $users = array();

                    //loop through all rows in the returned recordsets
                    while ($query_row = $query->fetch_assoc()) {

                        //create a User object
                        $user = new User($query_row['firstname'], $query_row['lastname'], $query_row['username'], $query_row['password'], $query_row['role']);

                        //set the id for the user
                        $user->setId($query_row["id"]);
                        //add the user into the array
                        $users[] = $user;
                    }
                    return $users;
                } else {
                    throw new NoResults();
                }
            }
        } catch (NoResults $ez) {
            $message = $ez->getError();
            UserController::error($message);
            exit();
        } catch (UserBadResults $ez) {
            $message = $ez->getError();
            UserController::error($message);
        } catch (Exception $ex) {
            $message = $ex->getMessage();
            UserController::error($message);
            exit();
        }
    }

    /*
     * the view_user method retrieves the details of the user specified by its id
     * and returns a user object. Return false if failed.
     */

    public function view_user($id) {
        //the select sql statement
        $sql = "SELECT * FROM " . $this->db->getUserTable() . " WHERE id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);
        try {
            if ($query && $query->num_rows > 0) {
                $query_row = $query->fetch_assoc();

                //create a user object
                $user = new User($query_row['firstname'], $query_row['lastname'], $query_row['username'], $query_row['password'], $query_row['role']);

                //set the id for the user
                $user->setId($query_row["id"]);

                return $user;
            } else {
                throw new UserNoUser();
            }
        } catch (UserNoUser $e) {
            $message = $e->getError();
            UserController::error($message);
            die();
        } catch (Exception $e) {
            $message = $e->getMessage();
            UserController::error($message);
        }
    }

    //search the database for users that match words in firstnames. Return an array of users if succeed; false otherwise.
    //update a user in the database. Details of the user are posted in a form. Return true if succeed; false otherwise.
    public function update_user($id) {
        //retrieve user details

        $firstname = isset($_POST['firstname']) && ($_POST['firstname'] != "") ? $_POST['firstname'] : null;
        $lastname = isset($_POST['lastname']) && ($_POST['lastname'] != "") ? $_POST['lastname'] : null;
        $username = isset($_POST['username']) && ($_POST['username'] != "") ? $_POST['username'] : null;
        $password = isset($_POST['password']) && ($_POST['password'] != "") ? $_POST['password'] : null;
        $role = isset($_POST['role']) && is_numeric($_POST['role']) && ($_POST['role'] != "") ? $_POST['role'] : null;
        try {
            //make sure none of them is null
            if ($firstname && $username && $lastname && $password && $role) {
                //query string for update 
                $sql = "UPDATE " . $this->db->getUserTable() .
                        " SET firstname='$firstname', lastname='$lastname', username='$username', password='$password', role='$role' WHERE id='$id'";

                //execute the query
                return $this->dbConnection->query($sql);
            } else {
                throw new AllFields();
            }
        } catch (AllFields $e) {
            $message = $e->getError();
            BookController::error($message);
            die();
        } catch (Exception $e) {
            $message = $e->getMessage();
            BookController::error($message);
        }
    }

    public function add_user() {
        //retrieve user details

        $firstname = isset($_POST['firstname']) && ($_POST['firstname'] != "") ? $_POST['firstname'] : null;
        $lastname = isset($_POST['lastname']) && ($_POST['lastname'] != "") ? $_POST['lastname'] : null;
        $username = isset($_POST['username']) && ($_POST['username'] != "") ? $_POST['username'] : null;
        $password = isset($_POST['password']) && ($_POST['password'] != "") ? $_POST['password'] : null;
        $role = 2;

        //check null first
        if ($firstname && $username && $lastname && $password && $role) {
            //query string for update 
            $sql = "INSERT INTO " . $this->db->getUserTable() .
                    " (id, firstname, lastname, username, password, role) VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$role');";

            //execute the query
            if (!($this->dbConnection->query($sql))) {
                //to check if query was run sucussfully for model
                return 1;
            }
            //else {
            //query was runned sucessfully.  Not used at current time of coding 5/1/14
            //    return 2;
            //}
        } else {
            //a field was empty
            return 0;
        }
    }

    public function delete_user($id) {
        //select statement
        $sql = "DELETE FROM " . $this->db->getUserTable() . " WHERE id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);
    }

    public function auth_user($username, $password) {

        $sql = "SELECT id FROM " . $this->db->getUserTable() . " WHERE username='$username' AND password='$password'";

        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $query_row = $query->fetch_assoc();
            return $this->view_user($query_row['id']);
        } else {
            return FALSE;
        }
    }

}
