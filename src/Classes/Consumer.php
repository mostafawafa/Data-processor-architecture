<?php

namespace App\Classes;

use App\Contracts\SaverInterface;
use App\Models\DataProvider;

class Consumer
{


    protected  $products = [];
    protected $saver;

    //dependecy injection of saver class
    public function __construct(SaverInterface $saver)
    {
        $this->saver = $saver;        
    }

    
    /**
     * getProductsFromAll: get products from all available data providers
     *
     * @return array of products
     */
    public function getProductsFromAll()
    {

        $dataProviders = (new DataProvider)->all();


        foreach ($dataProviders as $dataProvider) {
            if(class_exists($dataProvider->src)){
                $class = new $dataProvider->src;

                $this->products =   array_merge($this->products,$class->getFormatedData());
            }
      

        }
        return  $this->products;


    }

    /**
     * getProductsFrom: get products from specified providers
     *
     * @return array of products
     */
    public function getProductsFrom(string $provider)
    {        
        $provider = (new DataProvider)->getWhere('name', $provider);
        if($provider){
            if(class_exists($provider->src)){
                $class = new $provider->src;
                $this->products = $class->getFormatedData();

            }
        }
        
        return  $this->products;
    }


    /**
     * save: delegate saving products to one of savers classes which implemented save method  
     *
     */
    public function  save()
    {
        $this->saver->save($this->products);
    }
}
