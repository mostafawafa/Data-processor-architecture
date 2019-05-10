<?php

namespace App\Classes\Savers;

use App\Contracts\SaverInterface;

class FileSaver implements SaverInterface
{

  

    public function save($values)
    {   
        file_put_contents(__Dir__.  '/../../../storage/ay7aga' . uniqid(),json_encode($values));

     }
}


