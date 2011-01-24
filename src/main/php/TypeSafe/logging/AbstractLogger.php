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
require_once('Logger.php');

/**
 * @author Tobias Sarnowski
 */
abstract class AbstractLogger implements Logger {
    private $priorities = array(
        0 => 'TRACE',
        1 => 'DEBUG',
        2 => 'INFO',
        3 => 'WARN',
        4 => 'ERROR'
    );

    private $min = 2;


    /**
     * @abstract
     * @param string $priority (TRACE|DEBUG|INFO|WARN|ERROR)
     * @param string $message
     * @param Exception $exception
     * @return void
     */
    abstract function log($priority, $message, $exception = null);

    /**
     * @param int $priority
     * @param string $message
     * @param null $exception
     * @return void
     */
    private function _log($priority, $message, $exception = null) {
        if ($priority < $this->min) {
            // filtered
            return;
        }

        // call the real implementation
        $this->log($this->priorities[$priority], $message, $exception);
    }

    /**
     * @optional
     * @param Configuration $configuration
     * @return void
     */
    public function configure(Configuration $configuration) {
        $priority = $configuration->get('logging.level', 'INFO');
        foreach ($this->priorities as $key => $prio) {
            if (strtoupper($priority) == $prio) {
                $this->min = $key;
                return;
            }
        }
    }

    /**
     * @param string $min
     * @return void
     */
    public function setMin($min) {
        $this->min = $min;
    }

    /**
     * @return string
     */
    public function getMin() {
        return $this->min;
    }

    /**
     * @param  string $message
     * @param  Exception $exception
     * @return void
     */
    public function debug($message, $exception = null) {
        $this->_log(1, $message, $exception);
    }

    /**
     * @param  string $message
     * @param  Exception $exception
     * @return void
     */
    public function error($message, $exception = null) {
        $this->_log(4, $message, $exception);
    }

    /**
     * @param  string $message
     * @param  Exception $exception
     * @return void
     */
    public function info($message, $exception = null) {
        $this->_log(2, $message, $exception);
    }

    /**
     * @param  string $message
     * @param  Exception $exception
     * @return void
     */
    public function trace($message, $exception = null) {
        $this->_log(0, $message, $exception);
    }

    /**
     * @param  string $message
     * @param  Exception $exception
     * @return void
     */
    public function warn($message, $exception = null) {
        $this->_log(3, $message, $exception);
    }
}
