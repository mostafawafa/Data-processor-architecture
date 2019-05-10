<?php


namespace App\Classes\DataProviders;

use App\Contracts\DataProviderInterface;

class ApiNumberOne implements DataProviderInterface
{

    protected $data;

    public function get()
    {

        $this->data = json_encode([
            [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],
            [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],
            [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],
            [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],  [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],  [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],  [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],  [
                'name' => 'ay7aga' . uniqid(),
                'description' => 'ay 7aga ' . uniqid(),
                'price' => rand(1, 433)
            ],



        ]);


        return $this->data;
    }


    

    public function getFormatedData()
    {
        $this->get();
        // any neccesserry steps/calls to methods to format data.
        return $this->format();
    }


    protected function format(){
        return json_decode($this->data,true);
    }
}
