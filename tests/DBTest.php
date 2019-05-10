<?php 

declare(strict_types=1);

require_once(__DIR__ . '/../bootstrap.php');

use App\Classes\DB;
use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase
{


    public function test_DB_class_return_only_one_instance_per_life_cycle_request(){

        $firstInstance =  DB::create();
        $secondInstance = DB::create();

        $this->assertTrue($firstInstance === $secondInstance); 
    }

   
}