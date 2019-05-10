<?php 


namespace App\Classes\Savers;


class SaverFactory{

    public static function create($saver){
        
        if($saver === 'db'){
            return new DBSaver;
        }
        if($saver === 'file'){
            return new FileSaver;
        }
        return false;
    }
}