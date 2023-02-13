<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
class DuplicateInstanceException extends \Exception{
    private $key;
    private $entity;
    
    public function __construct(string $entity, string $key, string $message = "Ya existe una entidad con ese identificador: ", int $code = 0, ?\Throwable $previous = null): \Exception {
        $this->entity=$entity;
        $this->key= $key;
        return parent::__construct("$message: Entidad: $this->entity Clave: $this->key", $code, $previous);
    }
    
    

}
