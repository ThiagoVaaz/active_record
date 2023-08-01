<?php

namespace app\bind;

use app\exceptions\BindException;

class Bind
{

    private static $bind = [];

    public static function set($name, $value)
    {

        if (!isset(static::$bind[$name])) {
            static::$bind[$name] = $value;
        }
    }

    public static function get($name)
    {

        if (!isset(static::$bind[$name])) {
            throw new BindException();
        }

        return (object) static::$bind[$name];
    }
}
