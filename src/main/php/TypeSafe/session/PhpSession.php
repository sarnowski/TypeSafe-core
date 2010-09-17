<?php
require_once('Session.php');


/**
 *
 * @author Tobias Sarnowski
 */ 
class PhpSession implements Session {

    public function contains($key) {
        return isset($_SESSION[$key]);
    }

    public function entries() {
        return $_SESSION;
    }

    public function get($key, $default = null) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public function keySet() {
        return array_keys($_SESSION);
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
}
