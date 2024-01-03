<?php

namespace Core;

class Session
{

    // does this session have this key
    public static function has($key)
    {
        return (bool) static::get($key);
    }

    // allows you to set session keys
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        // look to see if session key has been flashed
        if (isset($_SESSION['_flash'][$key])) {
            return $_SESSION['_flash'][$key];
        }
        //otherwise see if $key exists at the top level
        return $_SESSION[$key] ?? $default;

        // folowing code is refactor for all this function code
        // return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {

        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    // helper function to flush the Session data entirely
    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        // log the user out
        static::flush();
        session_destroy();

        // expire cookie
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
