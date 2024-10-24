<?php

namespace Framework;

class Session
{
    /**
     * check if a session is started and start a session
     * @return void
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    /**
     * set session key to value
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /**
     * get session value by key
     *
     * @param string $key
     * @param mixed $defult
     * @return mixed
     */
    public static function get($key, $defult = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $defult;
    }
    /**
     * Check if session has key
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }
    /**
     * Unsset a session
     * @param string $key
     * @return void
     */
    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    /**
     * delete all sessions
     * @return bool
     */
    public static function clearAll()
    {
        session_unset();
        session_destroy();
    }
    /**
     * set a flash message
     * @param string $key
     * @param string $message
     * @return void 
     */
    public static function setFlashmessage($key, $message)
    {
        self::set('flash_' . $key, $message);
    }
    public static function getFlashmessage($key, $defult = null)
    {
        $message = self::get('flash_' . $key, $defult);
        self::clear('flash_' . $key);
        return $message;
    }
}
