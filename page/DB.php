<?php

class DB
{
    private $host = 'localhost';
    private $dbname = "exampleDBName";
    private $user = "user";
    private $pwd = "password";
    public $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pwd);
        }catch (Exception $e)
        {
            echo $e;
        }
    }
}