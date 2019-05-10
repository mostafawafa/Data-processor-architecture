<?php

namespace App\Controllers;

use App\Classes\Savers\SaverFactory;
use App\Classes\Consumer;
use App\Models\DataProvider;

class ProductController extends Controller
{
    
    public function index()
    {
     

        $providerModel  = new DataProvider;
        $providers = $providerModel->all();

        echo $this->templateEngine->render('index.html.twig', ['providers' => $providers]);
    }


    public function save()
    {

        if(!isset($this->requestParams['saver']) || !isset($this->requestParams['provider']))return;
        $saverType = $this->requestParams['saver'];
        $saver = SaverFactory::create($saverType);

        // validate that input saver is only from allowed savers
        if(! $saver  )return;

        $providerType = $this->requestParams['provider'] ;
        $availableProviders = (new DataProvider)->all('array');
     
        // validate that input "providerType" is only from allowed data providers

        if(  ( ! in_array($providerType,array_column($availableProviders ,'name') ) ) && (! empty($providerType) ) ) return;
        
        $consumer = new Consumer($saver);
        
        if (empty($providerType)) {
            $consumer->getProductsFromAll();

        } else {
            $consumer->getProductsFrom($providerType);

        }

        $consumer->save();
        
        echo $this->templateEngine->render('success.html.twig',['saverType' => $saverType]);

    
    }
}
