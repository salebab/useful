<?php
include_once __DIR__ ."/../vendor/autoload.php";

use useful\libraries\StaticCache;

function get_something()
{
    return StaticCache::get("some.key", function() {
       return md5(rand());
    });
}

function get_something2()
{
    if(!StaticCache::exists("some.key2")) {
        StaticCache::set("some.key2", md5(rand()));
    }

    return StaticCache::get("some.key2");
}

for($i = 0; $i < 5; $i++) {
    echo get_something() . "\t";
    echo get_something2() . PHP_EOL;
}

StaticCache::delete("some.key");
echo StaticCache::get("some.key") . PHP_EOL; // null

StaticCache::flush();
print_r(StaticCache::getAll()); // should be empty array