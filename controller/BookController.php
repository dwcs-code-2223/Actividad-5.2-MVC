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
        
        if(isset($_POST["publisher"])){
            $publisher = $_POST["publisher"];
            if(trim($publisher)!==""){
                $publisher_obj = new Publisher();
                $publisher_obj->setName($publisher);
                $obj_guardado = $this->bookServicio->addPublisher($publisher_obj);
                if($obj_guardado!=null){
                    return "OK";
                }
                else{
                    return "Algo ha ido mal";
                }
                
            }
            else{
                return "NO se aceptan cadenas vacías";
            }
        }
    }

}
