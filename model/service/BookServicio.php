<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of BookServicio
 *
 * @author mfernandez
 */
class BookServicio {

    private IBaseRepository $book_repository;
    private IBaseRepository $pub_repository;
    private IBaseRepository $author_repository;

    public function __construct() {
        $this->book_repository = new BookRepository();
        $this->pub_repository = new PublisherRepository();
        $this->author_repository = new AuthorRepository();
    }

    public function addPublisher(Publisher $publisher): ?Publisher {

        try {

            if ($this->pub_repository->exists($publisher->getName())) {
                $publisher->setStatus(Util::OPERATION_NOK);
                $publisher->addError("Ya existe una editorial con ese nombre");
            } else {
                $publisher = $this->pub_repository->create($publisher);
                $publisher->setStatus(Util::OPERATION_OK);
            }
        } catch (\Exception $ex) {
            echo "Ha ocurrido una excepción: " . $ex->getMessage();
            $publisher = null;
        }
        return $publisher;
    }

    public function addAuthor(Author $author): Author {
        return $this->author_repository->create($author);
    }

    public function getPublishers() {
        return $this->pub_repository->findAll();
    }

    public function getAuthors() {
        return $this->author_repository->findAll();
    }

    public function addBook(Book $book, $authors) {
        $exito = true;

        try {
            //comenzamos transaction
             $this->book_repository->beginTransaction();
           
                $book = $this->book_repository->create($book);

                if (isset($authors) && count($authors) > 0):
                    foreach ($authors as $author_id):
                        $exito = $exito && $this->book_repository->addAuthorToBook($book->getBook_id(), $author_id);
                        if (!$exito):
                            break;
                        endif;
                    endforeach;
                endif;

                //confirmamos la transaction
               $this->book_repository->commit();
            
        } catch (Exception $ex) {
            echo "Ha ocurrido una exception: " . $ex->getMessage();
            $this->book_repository->rollback();
            $exito = false;
        }
        return ($book != null) && $exito;
    }

}
