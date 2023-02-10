<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of BookController
 *
 * @author mfernandez
 */
class BookController {

    public $page_title;
    public $view;
    private $bookServicio;

    const VIEW_FOLDER = 'book';

    public function __construct() {
        $this->view = self::VIEW_FOLDER . DIRECTORY_SEPARATOR . 'new_publisher';
        $this->page_title = '';
        $this->bookServicio = new BookServicio();
    }

    public function addPublisher() {
        $this->page_title = 'Nueva editorial';
        $this->view = self::VIEW_FOLDER . DIRECTORY_SEPARATOR . 'new_publisher';

        if (isset($_POST["publisher"])) {
            $publisher = $_POST["publisher"];
            if (trim($publisher) !== "") {
                $publisher_obj = new Publisher();
                $publisher_obj->setName($publisher);
                $obj_guardado = $this->bookServicio->addPublisher($publisher_obj);
                if ($obj_guardado != null) {
                    return "OK";
                } else {
                    return "Algo ha ido mal";
                }
            } else {
                return "NO se aceptan cadenas vacías";
            }
        }
    }

    public function addAuthor() {
        $this->page_title = 'Nuevo/a autor/a';
        $this->view = self::VIEW_FOLDER . DIRECTORY_SEPARATOR . 'new_author';

        if (isset($_POST["first"]) && isset($_POST["last"])) {

            if (Util::isNotEmpty($_POST["first"]) && Util::isNotEmpty($_POST["last"])) {
                $first = $_POST["first"];
                $last = $_POST["last"];
                $middle = "";
                $bdate = null;

                if (Util::isNotEmpty($_POST["middle"])) {
                    $middle = $_POST["middle"];
                }
                if (Util::isNotEmpty( $_POST["bdate"])) {
                    $bdate = $_POST["bdate"];
                    $bdate = DateTimeImmutable::createFromFormat("Y-m-d", $bdate);
                }

                $author = new Author();
                $author->setFirst_name($first);
                $author->setLast_name($last);
                $author->setMiddle_name($middle);
                $author->setBirthDate($bdate);

                $author_guardado = $this->bookServicio->addAuthor($author);
                
                if ($author_guardado != null) {
                    return "OK";
                } else {
                    return "Algo ha ido mal";
                }
            }
        }
    }
}
        