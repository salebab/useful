<?php

namespace useful\libraries;

/**
 * Class StaticCache
 * @package useful\libraries
 */
class StaticCache
{
    /**
     * @var array
     */
    private static $store = array();

    /**
     * Put data to the cache
     *
     * @param string|int $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        self::$store[$key] = $value;
    }

    /**
     * Get data from cache
     * If is provided, notFoundCallback will be called if cache not exists
     *
     * @param string|int $key
     * @param callable $notFoundCallback
     * @param array $callbackParams
     * @return null
     */
    public static function get($key, \Closure $notFoundCallback = null, array $callbackParams = array())
    {
        if(isset(self::$store[$key])) {
            return self::$store[$key];
        }

        if(is_callable($notFoundCallback)) {
            return self::$store[$key] = call_user_func_array($notFoundCallback, $callbackParams);
        }

        return null;
    }

    /**
     * Returns all data as associative array
     *
     * @return mixed
     */
    public static function getAll()
    {
        return self::$store;
    }

    /**
     * Check does cache exist in data store
     *
     * @param string|int $key
     * @return bool
     */
    public static function exists($key)
    {
        return isset(self::$store[$key]);
    }

    /**
     * Delete data from store
     *
     * @param $key
     * @return void
     */
    public static function delete($key)
    {
        if(isset(self::$store[$key])) {
            unset(self::$store[$key]);
        }
    }

    /**
     * Flush cache store
     * @return void
     */
    public static function flush()
    {
        self::$store = array();
    }
} 