<?php


/**
 *
 * @author Tobias Sarnowski
 */
interface Session {

    /**
     * Returns a key from the session or the default value if the entry
     * does not exist.
     *
     * @abstract
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Sets the session value for the given key.
     *
     * @abstract
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function set($key, $value);

    /**
     * Checks if a value is set in the session.
     *
     * @abstract
     * @param  string $key
     * @return boolean
     */
    public function contains($key);

    /**
     * Returns a list of all keys in the session.
     *
     * @abstract
     * @return array
     */
    public function keySet();

    /**
     * Returns an array of all entries with their keys of the session.
     *
     * @abstract
     * @return array
     */
    public function entries();

}
