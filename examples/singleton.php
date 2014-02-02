<?php
include_once __DIR__ ."/../vendor/autoload.php";
use useful\traits\Singleton;

class MyClass
{
    use Singleton;

    public $hash;

    function __construct()
    {
        $this->hash = md5(rand());
    }
}

class MyClass2 extends MyClass
{
    use Singleton; // note: without defining, it will use existent instance of class MyClass
    public function getById() {}
}

echo MyClass::getInstance()->hash . PHP_EOL;
echo MyClass2::getInstance()->hash . PHP_EOL;