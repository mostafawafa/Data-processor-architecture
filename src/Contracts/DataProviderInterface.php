<?php 

namespace App\Contracts;

interface DataProviderInterface
{

    /**
     * method to get the data from the source
     *
     **/
    public function get();

    /**
     * method to return formated data to a format that our application use 
     * @return array
     **/
    public function getFormatedData();


}