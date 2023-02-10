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

    public function __construct() {
        $this->book_repository = new BookRepository();
        $this->pub_repository = new PublisherRepository();
    }
    
    public function addPublisher(Publisher $publisher): Publisher{
         return $this->pub_repository->create($publisher);
    }

}
