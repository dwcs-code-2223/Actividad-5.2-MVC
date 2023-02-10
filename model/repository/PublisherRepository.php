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

}
