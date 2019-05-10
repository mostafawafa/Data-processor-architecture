<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Savers\DBSaver;
use App\Classes\Savers\SaverFactory;
use App\Classes\Savers\FileSaver;

final class SaverFactoryTest extends TestCase
{

    public function test_return_DBSaver(){
        
        $class = SaverFactory::create('db');
        $this->assertInstanceOf(DBSaver::class,$class); 
    }

    public function test_return_False_if_unknown_attribute_passed(){
        
        $result = SaverFactory::create(uniqid());
        $this->assertFalse($result); 
    }

    public function test_return_FileSaver(){
        
        $class = SaverFactory::create('file');
        $this->assertInstanceOf(FileSaver::class,$class); 
    }


 

}