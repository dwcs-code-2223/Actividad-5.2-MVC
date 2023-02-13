<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of MyPDO
 *
 * @author mfernandez
 */
class MyPDO extends PDO {

   
    public function  __construct(string $dsn, ?string $username = null, ?string $password = null, ?array $options = null) {

       
        

        parent::__construct($dsn, $username,
                $password, $options
        );
        
        
    }

}
