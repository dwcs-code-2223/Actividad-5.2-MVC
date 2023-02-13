<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of PublisherRepository
 *
 * @author mfernandez
 */
class PublisherRepository extends BaseRepository {

     public function __construct() {
     
       parent::__construct();
        $this->table_name="publishers";
        $this->pk_name="publisher_id";
        $this->class_name="Publisher";
        $this->default_order_column="name";
    }
    
    
    public function create($publisher) {

        $pdostmt = $this->conn->prepare
                ("INSERT INTO publishers(name) VALUES ( :name) ");
        $pdostmt->bindValue("name", $publisher->getName());

        $pdostmt->execute();

        //Recuperamos el id de la última inserción
        $publisher_Id = $this->conn->lastInsertId();
        //Establecemos el id como parte del objeto
        if ($publisher_Id !== false) {
            $publisher->setPublisher_id( $publisher_Id);
            return $publisher;
        } else {
            return null;
        }
    }

    public function update($object): bool {
        //TO DO
    }
    
    public function exists($name){
        $pdostmt = $this->conn->prepare
                ("SELECT publisher_id FROM publishers WHERE name LIKE :nombre ");
        $pdostmt->bindValue("nombre", $name);

        $pdostmt->execute();

        //Recuperamos el id de la última inserción
       $resultado = $pdostmt->fetch(PDO::FETCH_ASSOC);
       return $resultado;
    }

}
