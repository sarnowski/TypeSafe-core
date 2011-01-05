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
class HttpException extends Exception {

    private $statusCode;

    private $title;

    /**
     * @param  int $statusCode
     * @param  string $title
     * @return void
     */
    function __construct($statusCode, $title, $message, $exception = null) {
        parent::__construct($message, $exception);
        $this->statusCode = $statusCode;
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getTitle() {
        return $this->title;
    }

}
