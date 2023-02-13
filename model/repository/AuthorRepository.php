<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of AuthorRepository
 *
 * @author mfernandez
 */
class AuthorRepository extends BaseRepository {

    public function __construct() {
        // $this->conn = new MyPDO();
        parent::__construct();
        $this->table_name = "authors";
        $this->pk_name = "author_id";
        $this->class_name = "Author";
        $this->default_order_column = "last_name";
    }

    //put your code here
    public function create($author) {
        $pdostmt = $this->conn->prepare("INSERT INTO `authors`(`first_name`, `middle_name`, `last_name`, `birth_date`) VALUES ( :first, :middle, :last, :bdate)");
        $pdostmt->bindValue("first", $author->getFirst_name());
        $pdostmt->bindValue("middle", $author->getMiddle_name());
        $pdostmt->bindValue("last", $author->getLast_name());
        $pdostmt->bindValue("bdate", ($author->getBirthDate() !== null) ? $author->getBirthDate()->format("Y-m-d") : null);

        //$pdostmt->debugDumpParams();
        $pdostmt->execute();

        //Recuperamos el id de la última inserción
        $author_id = $this->conn->lastInsertId();

        //Establecemos el id como parte del objeto
        if ($author_id !== false) {
            $author->setAuthor_id($author_id);
            return $author;
        } else {
            return null;
        }
    }

    public function update($object): bool {
        //TO DO
    }
    
   
    
    public function findAll(): array {
       $pdostmt = $this->conn->prepare("SELECT author_id, "
                . "CONCAT (COALESCE(a.last_name, ''), ' ', COALESCE(a.first_name,''), ' ',"
                . "COALESCE(a.middle_name, '' )) as completeName " .
                " FROM authors a ORDER BY $this->default_order_column");
     
        $pdostmt->execute();
        $pdostmt->debugDumpParams();
        //Se añadió un nuevo atributo en Author.php: $completeName
        $array = $pdostmt->fetchAll(PDO::FETCH_CLASS, $this->class_name);
        return $array;
    }


}
