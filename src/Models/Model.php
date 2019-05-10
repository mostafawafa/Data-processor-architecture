<?php

namespace App\Models;

use App\Classes\DB;

class Model
{

    protected $primaryKey = 'id'; 


    public function __construct()
    {
        $this->db = DB::create();
    }



   /**
     * Get all rows
     *
     * @param  string $resultFormat
     *
     * @return mixed object / array depend on $resultFormat attr
    */

    public function all($resultFormat= 'object')
    {
        $sql = "select * from $this->table";
        return $this->db->execute($sql)->fetchAll($resultFormat);
        
     
    }


  

    /**
     * Get row by primary key
     *
     * @param  mixed $primaryKey
     *
     * @return stdclass object
     */
    public function get($primaryKey)
    {
        $sql = "select * from $this->table  where $this->primaryKey = ?";
        return $this->db->execute($sql,[$primaryKey])->fetch();
        
    
    }


    /**
     * Get first row with giveing condiition 
     *
     * @param  string $column
     * @param  mixed $value
     *
     * @return stdclass object
     */
    public function getFirstWhere(string $column, $value)
    {
        
        if(! in_array($column,$this->fillable)){
            return false;
        }
        $sql = "select * from $this->table  where $column = ?";

        return $this->db->execute($sql,[$value])->fetch();

    }

    /**
     * save row to database
     *
     * @param  array $values
     *
     * @return Boolean
     */
    public function save($values)
    {   
        if( ! empty( array_diff( array_keys($values), $this->fillable) )){
            return false;
        };
        $len = count($values);

        $sql = $this->sqlInsertSkelton($values);

        $params =   implode(',',array_fill(0,$len-1,'?') ) . ',?'; 

        $sql .= "($params)";

        return $this->db->execute($sql,$values);

        
    }


    /**
     * Bulk save
     * 
     * @param  array $array of arrays
     *
     * @return void
     */
    public function saveAll($array)
    {


        $sql = $this->sqlInsertSkelton($array[0]);
        $len = count($array[0]);   
        foreach(range( 0,count($array) -1) as $i){
            $params =   implode(',',array_fill(0,$len-1,'?') ) . ',?'; 
            $sql .= "($params)";

                if($i !== count($array) -1){
                    $sql .= ',';
                }
        }
        
        $result =[];
        foreach($array as $arr){
            foreach($arr as $val ){
                $result[] = $val;
            }
        }

        return $this->db->execute($sql,$result);





     }


     protected function sqlInsertSkelton($array){

        $sql = "insert into $this->table (";
        
        $len = count($array);
        foreach ( array_keys($array) as $key => $attr) {
            $sql .= "$attr";
      
        if ($key != $len - 1) {
            $sql .= ",";
        }
    }
        $sql .= ') VALUES ';
        return $sql;

     }

    }
