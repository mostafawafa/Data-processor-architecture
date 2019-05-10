<?php

namespace App\Classes\Savers;

use App\Contracts\SaverInterface;
use App\Classes\DB;
use App\Models\Product;

class DBSaver implements SaverInterface
{


    public function save($values)
    {   
        $productModel = new Product;
        return  $productModel->saveAll($values);    


     }
}


