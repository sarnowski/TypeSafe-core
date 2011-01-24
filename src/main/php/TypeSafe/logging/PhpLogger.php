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
 * 
 * @author Tobias Sarnowski
 */
class PhpLogger implements Logger {

    /**
     * @private
     * @param string $priority
     * @param string $message
     * @param Exception $exception
     * @return void
     */
    function log($priority, $message, $exception) {
        $log = "$priority $message";
        if (!is_null($exception)) {
            $log .= "\n".$exception->__toString();
        }
        error_log($log);
    }

    public function debug($message, $exception = null) {
        $this->log('DEBUG', $message, $exception);
    }

    public function error($message, $exception = null) {
        $this->log('ERROR', $message, $exception);
    }

    public function info($message, $exception = null) {
        $this->log('INFO', $message, $exception);
    }

    public function trace($message, $exception = null) {
        $this->log('TRACE', $message, $exception);
    }

    public function warn($message, $exception = null) {
        $this->log('WARN', $message, $exception);
    }
}
