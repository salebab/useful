<?php

namespace useful\traits;

/**
 * Trait Singleton
 * @package useful\traits
 */
trait Singleton
{
    /**
     * @var array
     */
    private static $instances = array();

    /**
     * @param string $instanceName
     * @return static
     */
    public static function getInstance($instanceName = 'default')
    {
        if(!array_key_exists($instanceName, self::$instances)) {
            self::$instances[$instanceName] = new static();
        }

        return self::$instances[$instanceName];
    }

    function __construct() {}
}