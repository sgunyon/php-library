<?php

class UserController {

    private $user_model;

    //default constructor
    public function __construct() {
        //create an instance of the UserModel class
        $this->user_model = new UserModel();
    }

    public function listuser() {
        //retrieve all users and store them in an array
        $users = $this->user_model->list_user();
//        try {
        //disply all users
//            if (!empty($users)) {
        $view = new User_List;
        $view->display($users);
        /*            } else {
          throw new NoResults();
          }
          } catch (NoResults $e) {
          $message = $e->getError();
          $this->error($message);
          } catch (Exception $e) {
          $message = $e->getMessage();
          $this->error($message);
          }
         */
    }

    //show details of a user
    public function detail($id) {
        //retrieve the specific user
        $user = $this->user_model->view_user($id);
        try {
            //display user details
            if ($user) {
                //display user details
                $view = new User_Detail();
                $view->display($user);
            } else {
                throw new NoResults();
            }
        } catch (NoResults $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new User_Error();

        //display the error page
        $error->display($message);
    }

    //diplay a user in a form for editing
    public function edit($id) {
        //retrieve the specific user
        $user = $this->user_model->view_user($id);
        try {
            //display user details in a form to be modified
            if ($user) {
                $view = new User_Edit();
                $view->display($user);
            } else {
                throw new NoResults();
            }
        } catch (NoResults $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    //update a user in the database
    public function update($id) {
        try {
            //call the updateUser method to update the user
            if ($this->user_model->update_user($id)) {
                $view = new User_Update();
                $view->display($id);
            } else {
                throw new UserEditDb();
            }
        } catch (UserEditDb $e) {
            $message = $e->getError();
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    public function delete($id) {
        $this->user_model->delete_user($id);
        $view = new User_Delete();
        $view->display();
    }

    public function addform() {
        try {
            //call the updateUser method to update the user
            $view = new User_AddForm();
            if (!$view->display()) {
                throw new BadPage();
            }
        } catch (BadPage $e) {
            $message = $e->getError();
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    public function add() {
        try {
            //run add_user from model and checks if two types of errors occur...
            //  0  == there is at least one field empty from user input.
            //  1  == an error occured while running the sql.
            //  2  == query was runned successfully, but not currently used.
            //
            $newUser = $this->user_model->add_user();
            if ($newUser === 0) {
                throw new AllFields();
            } elseif ($newUser === 1) {
                throw new UserEditDb();
            } else {
                //display the update details
                //header("Location: " . base_url . "/user/detail/" . $id);
                $view = new User_Add();
                $view->display();
            }
        } catch (AllFields $e) {
            $message = $e->getError();
            $this->error($message);
        } catch (UserEditDb $e) {
            $message = $e->getError();
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        //call the updateUser method to update the user
        $view = new Logout();
        $view->display();
        //sleep(10);
        //header("Location: " . base_url);
    }

    public function loginform() {
        //call the updateUser method to update the user
        $view = new User_LoginForm();
        $view->display();
    }

    public function login() {
        $username = isset($_POST['username']) && ($_POST['username'] != "") ? $_POST['username'] : null;
        $password = isset($_POST['password']) && ($_POST['password'] != "") ? $_POST['password'] : null;
        try {
            $user = $this->user_model->auth_user($username, $password);

            if ($user) {
                $view = new Login();
                $view->display();
                session_start();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['firstname'] = $user->getFirstname();
                $_SESSION['lastname'] = $user->getLastname();
            } else {
                throw new UserWrongLogin();
            }
        } catch (UserWrongLogin $e) {
            $message = $e->getError();
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
    }

}
