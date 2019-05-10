<?php 

namespace App\Classes;


class DB{

    
    private static $instance = null;
    private   $connection = null;
    private $sth;

    private function __construct(){
        $dsn = getenv('DB_CONNECTION') . ':host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') ;

        $user = getenv('DB_USERNAME')  ;
        $password =  getenv('DB_PASSWORD') ;
        $this->connection =  new \PDO($dsn, $user, $password);

    }


    private function __clone(){


    }

    public static function create(){
        
        if( is_null( self::$instance)){
            self::$instance =(new self); 
              return  self::$instance;
        }
        return self::$instance;

    }

    public function getConnection(){
        return self::$connection;
    }  

    public function execute($sql,$values = []){
        $this->sth = $this->connection->prepare( $sql);
        $this->sth->execute(array_values($values));
        return $this;
    }

    public function fetch(){
        return $this->sth->fetch(\PDO::FETCH_OBJ);

    }

    public function fetchAll($resultFormat = 'object'){
        $fetchType = \PDO::FETCH_OBJ;
        if($resultFormat == 'array'){
         $fetchType =   \PDO::FETCH_ASSOC;
        }

        return $this->sth->fetchAll($fetchType);

    }
}
