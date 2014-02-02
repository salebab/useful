<?php

namespace useful\libraries;
/**
 * Class Event
 * @package useful\libraries
 */
class Event {

    const PRIORITY_HIGHEST = 100;
    const PRIORITY_HIGH = 75;
    const PRIORITY_NORMAL = 50;
    const PRIORITY_LOW = 25;
    const PRIORITY_LOWEST = 0;

    /**
     * @var array
     */
    private static $events = array();

    /**
     * Bind the event
     *
     * @param string|array $name
     * @param \Closure $callback
     * @param int $priority
     */
    public static function bind($name, \Closure $callback, $priority = self::PRIORITY_NORMAL)
    {
        if(!is_array($name)) {
            $name = array($name);
        }

        foreach($name as $n) {
            self::$events[$n][$priority][] = $callback;
        }
    }

    /**
     * Trigger an event
     *
     * @param string $name
     * @param array $args
     */
    public static function trigger($name, $args = array())
    {
        if(!self::exists($name)) {
            return;
        }

        // sort by priority, highest first
        krsort(self::$events[$name]);

        foreach(self::$events[$name] as $events) {
            foreach($events as $callback) {
                call_user_func_array($callback, $args);
            }
        }
    }

    /**
     * Check does event exists
     *
     * @param string $name
     * @return bool
     */
    public static function exists($name)
    {
        return array_key_exists($name, self::$events);
    }
}