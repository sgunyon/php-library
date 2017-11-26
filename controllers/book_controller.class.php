<?php

class BookController {

    private $book_model;

//default constructor
    public function __construct() {
//create an instance of the BookModel class
        $this->book_model = new BookModel();
    }

//index action that displays all books
    public function index() {
//retrieve all books and store them in an array
        try {
            $books = $this->book_model->list_book();
            $random = $this->book_model->random_book();

//disply all books
            if ($books && $random) {
                $view = new Book_Index();
                $view->display($books, $random);
            } else {
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

    public function inventory() {
//retrieve all books and store them in an array
        $books = $this->book_model->list_book();

//disply all books
        if ($books) {
            $view = new Book_Inventory();
            $view->display($books);
        }
    }

//show details of a book
    public function detail($id) {
//retrieve the specific book
        $book = $this->book_model->view_book($id);
        try {
//display book details
            if ($book) {
//display book details
                $view = new Book_Detail();
                $view->display($book);
            } else {
                throw new BookNoBook();
            }
        } catch (BookNoBook $e) {
            $message = $e->getError($id);
            $this->error($message);
            die();
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    public function random($id) {
//retrieve the specific book
        $book = $this->book_model->random_book($id);
        try {
//display book details
            if ($book) {
//display book details
                $view = new Book_Detail();
                $view->display($book);
            } else {
                throw new BookNoBook();
            }
        } catch (BookNoBook $e) {
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
        $error = new Book_Error();

//display the error page
        $error->display($message);
    }

//diplay a book in a form for editing
    public function edit($id) {
//retrieve the specific book
        $book = $this->book_model->view_book($id);
        try {
//display book details in a form to be modified
            if ($book) {
                $view = new Book_Edit();
                $view->display($book);
            } else {
                throw new BookNoBook();
            }
        } catch (BookNoBook $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

//update a book in the database
    public function update($id) {
        try {
            //run add_user from model and checks if two types of errors occur...
            //  0  == there is at least one field empty from user input.
            //  1  == an error occured while running the sql.
            //  2  == query was runned successfully, but not currently used.
            //  17 == a numerical field wasn't containing a numeral value.
            //
$book = $this->book_model->update_book($id);
            if ($book === 17) {
                throw new BookNotNumeric();
            } else if ($book === 0) {
                throw new AllFields();
            } else if ($book === 1) {
                throw new BookEditDb();
            } else {
//display the update details
//header("Location: " . base_url . "/book/detail/" . $id);
                $view = new Book_Update();
                $view->display($id);
            }
        } catch (BookNotNumeric $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (AllFields $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (BookEditDb $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

//deletes book
    public function delete($id) {
//call the delete_book method to delete the selected book
        $this->book_model->delete_book($id);
//create a new Book_Delete object
        $view = new Book_Delete();
//display the view for a suceesfully deleted book
        $view->display();
    }

    public function addform() {
//call the updateBook method to update the book
        $view = new Book_AddForm();
        $view->display();
    }

    public function add() {
      $id = "No id created.";
        try {
//call the updateBook method to update the book
            $book = $this->book_model->add_book();

            if ($book === 17) {
                throw new BookNotNumeric();
            } else if ($book === 0) {
                throw new AllFields();
            } else if ($book === 1) {
                throw new BookEditDb();
            } else {
//display the update details
//header("Location: " . base_url . "/book/detail/" . $id);
                $view = new Book_Add();
                $view->display();
            }
        } catch (BookNotNumeric $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (AllFields $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (BookEditDb $e) {
            $message = $e->getError($id);
            $this->error($message);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->error($message);
        }
    }

    public function search() {

//retrieve title from a textbox named "title"
        if (isset($_POST['request']))
            $title = trim($_POST['request']);

//retrieve all books and store them in an array
        if (($query = $this->book_model->search_book($title)) > 0) {
//search succeeded, display books found
            $view = new Book_Inventory();
            $view->display($query);
        }
    }

//autosuggestion
    public function fixXML($string) {
        $replace = array(
            '"' => "&quot;",
            "&" => "&amp;",
            "'" => "&apos;",
            "<" => "&lt;",
            ">" => "&gt;"
        );
        return utf8_encode(strtr($string, $replace));
    }

//autosuggestion
    public function suggest($request) {
        $results = $this->book_model->search_book($request);

        $books = new SimpleXMLElement("<books/>");

        header('Content-Type: text/xml');

        foreach ($results as $result) {
            $book = $books->addChild('book');
            $book->addChild('id', $result->getId());
            $book->addChild('title', $result->getTitle());
            $book->addChild('image', $result->getImage());
            $book->addChild('description', $this->fixXML($result->getDescription()));
            $book->addChild('publisher', $this->fixXML($result->getPublisher()));
            $book->addChild('isbn', $result->getIsbn());
            $book->addChild('on_hand', $result->getOn_hand());
        }


        echo $books->asXML();
    }

//handle calling inaccessible methods
    public function __call($name, $arguments) {
//$message = "Route does not exist.";
// Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
    }

}
