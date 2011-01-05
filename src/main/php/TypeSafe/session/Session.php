<?php
/*
 * Copyright 2010,2011 Tobias Sarnowski
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */



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
     * Removes the given key from the session.
     *
     * @abstract
     * @param string $key
     * @return void
     */
    public function remove($key);

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
