<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of BaseRepository
 *
 * @author mfernandez
 */
abstract class BaseRepository implements IBaseRepository {

    protected string $table_name;
    protected string $pk_name;
    protected MyPDO $conn;
    protected string $class_name;

    public function __construct() {
        $this->conn = new MyPDO();
    }

    abstract public function create($object);

    public function read($id) {
        $pdostmt = $this->conn->prepare("SELECT * FROM $this->table_name "
                . "WHERE $this->pk_name = :id");
        $pdostmt->bindValue("id", $id);
        $pdostmt->execute();

//Llama al constructor después de establecer las propiedades. No usa los métodos setters
        $object = $pdostmt->fetchObject($this->class_name);

        return $object;
    }

    abstract public function update($object): bool;

//abstract public function delete($id): bool;

    public function delete($id): bool {
        $pdostmt = $this->conn->prepare(
                "DELETE FROM " . $this->table_name . " WHERE " . $this->pk_name
                . " = :id");
//"DELETE FROM :table_name  WHERE :pk_name = :id");
//        $pdostmt->bindParam("table_name", $this->table_name);
//        $pdostmt->bindParam("pk_name", $this->pk_name);
        $pdostmt->bindValue("id", $id);

        $pdostmt->debugDumpParams();
        $pdostmt->execute();

        return ($pdostmt->rowCount() == 1);
    }

    public function findAll(): array {
        $pdostmt = $this->conn->prepare("SELECT *  FROM $this->table_name ORDER BY :orderCriteria");
        $pdostmt->bindParam("orderCriteria", $this->default_order_column);

        $pdostmt->debugDumpParams();
        $pdostmt->execute();
        $pdostmt->debugDumpParams();
        $array = $pdostmt->fetchAll(PDO::FETCH_CLASS, $this->class_name);
        return $array;
    }

    public function beginTransaction(): bool {

        return $this->conn->beginTransaction();
    }

    public function commit(): bool {

        return $this->conn->commit();
    }

    public function rollback(): bool {

        return $this->conn->rollback();
    }

}
