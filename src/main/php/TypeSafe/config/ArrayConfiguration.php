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

require_once('Configuration.php');

/**
 * Gets an array and provides is as the configuration.
 * 
 * @author Tobias Sarnowski
 */
class ArrayConfiguration implements Configuration {

    /**
     * @var array
     */
    private $config;

    /**
     * @param  string $file a php file where the $config[] is stored
     * @return void
     */
    public function __construct($config) {
        if (is_null($config)) {
            throw new InternalErrorException("config is null");
        }
        $this->config = $config;
    }

    public function get($key, $default = null) {
        if (!isset($this->config[$key])) {
            return $default;
        }
        return $this->config[$key];
    }
}
