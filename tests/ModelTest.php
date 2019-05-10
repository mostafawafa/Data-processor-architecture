<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Models\Product;

final class ModelTest extends TestCase
{

 
    public function test_save_works_correctly(){
        $productModel = (new Product);
        $uniqeName = uniqid();
        $productModel->save([
            'price' => 12,
            'name' => $uniqeName,
            'description' => 'best product'
            ]);
         $object =   $productModel->getFirstWhere('name',$uniqeName);
        $this->assertInstanceOf(stdClass::class,$object); 

    }

    public function test_save_return_false_if_attribute_not_allowed(){

        $productModel = (new Product);
        $uniqeName = uniqid();
       $result =  $productModel->save([
            'notAllowedColumn' => 'ffff',
            'price' => 12,
            'name' => $uniqeName,
            'description' => 'best product'
            ]);
        $this->assertFalse($result); 
    }


    public function test_getFirstWhere_return_false_if_not_found(){
        $productModel = (new Product);
        $uniqeName = uniqid();
        $result = $productModel->getFirstWhere('name',$uniqeName);
        $this->assertFalse($result);
    }
  

}