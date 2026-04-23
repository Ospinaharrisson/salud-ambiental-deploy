<?php

namespace App\Helpers\Admin;

class CurrentModule
{
    protected static $module;

    public static function set($module)
    {
        self::$module = $module;
    }

    public static function get()
    {
        return self::$module;
    }
}
