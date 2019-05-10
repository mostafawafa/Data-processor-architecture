<?php 

namespace App\Models;

class Product extends Model
{

    protected $table = "products"; 

    protected $fillable = [
        'name','price','description'
    ];

}