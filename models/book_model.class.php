<?php

class BookModel {

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
     * the list_book method retrieves all books from the database and
     * returns an array of Book objects if successful or false if failed.
     * Books should also be filtered by ratings and/or sorted by titles or rating if they are available.
     */

    public function list_book() {
//Construct the MySQL select statement.
        $sql = "SELECT * FROM " . $this->db->getBookTable();

//execute the query
        if (!($query = $this->dbConnection->query($sql))) {
            
        } else
//handle the result
//create an array to store all returned books
            $books = array();

//loop through all rows in the returned recordsets
        while ($query_row = $query->fetch_assoc()) {

//create a Book object
            $book = new Book($query_row['title'], $query_row['author'], $query_row['isbn'], $query_row['publisher'], $query_row['on_hand'], $query_row['image'], $query_row['description']);

//set the id for the book
            $book->setId($query_row["id"]);
//add the book into the array
            $books[] = $book;
        }
        return $books;
    }

    /*
     * the view_book method retrieves the details of the book specified by its id
     * and returns a book object. Return false if failed.
     */

    public function view_book($id) {
//the select sql statement
        $sql = "SELECT * FROM " . $this->db->getBookTable() . " WHERE id='$id'";

//execute the query
        $query = $this->dbConnection->query($sql);



        if ($query && $query->num_rows > 0) {
            $query_row = $query->fetch_assoc();

//create a book object
            $book = new Book($query_row['title'], $query_row['author'], $query_row['isbn'], $query_row['publisher'], $query_row['on_hand'], $query_row['image'], $query_row['description']);

//set the id for the book
            $book->setId($query_row["id"]);

            return $book;
        }
        return FALSE;
    }

//search the database for books that match words in titles. Return an array of books if succeed; false otherwise.
    public function search_book($title) {

//select statement
        $query_str = "(SELECT * FROM books WHERE title LIKE '%" . $title . "%')"
                . " UNION " .
                "(SELECT * FROM books WHERE author LIKE '%" . $title . "%')"
                . " UNION " .
                "(SELECT * FROM books WHERE isbn LIKE '%" . $title . "%')";

//execute the query  //validated at database.class
        $result = $this->dbConnection->query($query_str);

//check for failure
        if ($result->num_rows !== 0)
            $books = array();

//loop rows in query
        while ($query_row = $result->fetch_assoc()) {

//create a Book object
            $book = new Book($query_row['title'], $query_row['author'], $query_row['isbn'], $query_row['publisher'], $query_row['on_hand'], $query_row['image'], $query_row['description']);

//set the id for the book
            $book->setId($query_row["id"]);
//add the book into the array
            $books[] = $book;
        }
        return $books;
    }

//update a book in the database. Details of the book are posted in a form. Return true if succeed; false otherwise.
    public function update_book($id) {
//retrieve book details

        $title = isset($_POST['title']) && ($_POST['title'] != "") ? $_POST['title'] : null;
        $author = isset($_POST['author']) && ($_POST['author'] != "") ? $_POST['author'] : null;
        $isbn = isset($_POST['isbn']) && ($_POST['isbn'] != "") ? $_POST['isbn'] : null;
        $publisher = isset($_POST['publisher']) && ($_POST['publisher'] != "") ? $_POST['publisher'] : null;
        $on_hand = isset($_POST['on_hand']) && ($_POST['on_hand']) && ($_POST['on_hand'] != "") ? $_POST['on_hand'] : null;
        $image = isset($_POST['image']) && ($_POST['image'] != "") ? $_POST['image'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;

        //make sure none of them is null
        if ($title && $isbn && $author && $publisher && $on_hand && $image && $description) {
            //check numeric value on inventory
            if (!is_numeric($on_hand)) {
                return 17;
            }
            //query string for update 
            $sql = "UPDATE " . $this->db->getBookTable() .
                    " SET title='$title', author='$author', isbn='$isbn', publisher='$publisher', on_hand='$on_hand', image='$image', description='$description' WHERE id='$id'";

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

    public function add_book() {
//retrieve book details

        $title = isset($_POST['title']) && ($_POST['title'] != "") ? $_POST['title'] : null;
        $author = isset($_POST['author']) && ($_POST['author'] != "") ? $_POST['author'] : null;
        $isbn = isset($_POST['isbn']) && ($_POST['isbn'] != "") ? $_POST['isbn'] : null;
        $publisher = isset($_POST['publisher']) && ($_POST['publisher'] != "") ? $_POST['publisher'] : null;
        $on_hand = isset($_POST['on_hand']) && ($_POST['on_hand']) && ($_POST['on_hand'] != "") ? $_POST['on_hand'] : null;
        $image = isset($_POST['image']) && ($_POST['image'] != "") ? $_POST['image'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;

//make sure none of them is null
                if ($title && $isbn && $author && $publisher && $on_hand && $image) {

            if (!is_numeric($on_hand)) {
                return 17;
            }
//query string for update
                    $sql = "INSERT INTO " . $this->db->getBookTable() .
                            " (id, title, author, isbn, publisher, on_hand, image, description) VALUES (NULL, '$title', '$author', '$isbn', '$publisher', '$on_hand', '$image', '$description');";

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

    public function delete_book($id) {
        try {
//select statement
            $sql = "DELETE FROM " . $this->db->getBookTable() . " WHERE id='$id'";
//execute the query
            $query = $this->dbConnection->query($sql);
//check if the query was ran properly    
            if (!$query) {
                throw new BookNoBook();
            }
        } catch (BookNoBook $e) {
            $message = $e->getError($id);
            BookController::error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            BookController::error($message);
        }
    }

    public function random_book() {

//set up random book query
        $min_max_query_str = "SELECT * FROM " . $this->db->getBookTable();
        $min_max_query = $this->dbConnection->query($min_max_query_str);

//assign variable for minimum and maximum based on entries in books table
        $max_rows = $min_max_query->num_rows;
        $min_rows = ($min_max_query->num_rows) - ($min_max_query->num_rows) + 1;

//create random number
        $rand = rand($min_rows, $max_rows);
//the select sql statement
        $sql = "SELECT * FROM " . $this->db->getBookTable() . " WHERE id='$rand'";

//execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $query_row = $query->fetch_assoc();

//create a book object
            $book = new Book($query_row['title'], $query_row['author'], $query_row['isbn'], $query_row['publisher'], $query_row['on_hand'], $query_row['image'], $query_row['description']);

//set the id for the book
            $book->setId($query_row["id"]);

            return $book;
        } else {
            return FALSE;
        }
    }

}
