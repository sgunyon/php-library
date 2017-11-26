<?php

class Book {

    //private data members
    private $id, $title, $author, $isbn, $publisher, $on_hand, $image, $description;

    public function __construct($title, $author, $isbn, $publisher, $on_hand, $image, $description) {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->publisher = $publisher;
        $this->on_hand = $on_hand;
        $this->image = $image;
        $this->description = $description;
    }
    
    //getter methods
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getAuthor() {
        return $this->author;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function getOn_hand() {
        return $this->on_hand;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    //set book id
    public function setId($id) {
        $this->id = $id;
    }
}

?>