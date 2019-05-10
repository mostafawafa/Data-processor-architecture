<?php 

namespace App\Controllers;


class Controller
{

    public function __construct($requestParams,$templateEngine)
    {
        $this->requestParams = $requestParams;
        $this->templateEngine = $templateEngine;
    }


}