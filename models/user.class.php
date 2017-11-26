<?php

class User {

    //private data members
    private $id, $firstname, $lastname, $username, $password, $role;

    public function __construct($firstname, $lastname, $username, $password, $role) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    //getter methods
    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    //set user id
    public function setId($id) {
        $this->id = $id;
    }

}

?>