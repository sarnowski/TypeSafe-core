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

require_once('RequestHandler.php');


/**
 * 
 * @author Tobias Sarnowski
 */ 
class DefaultRequestHandler implements RequestHandler {

    private $regexMatcher;
    private $className;
    private $annotation;

    function __construct($regexMatcher) {
        $this->regexMatcher = $regexMatcher;
    }

    public function with($className, $annotation = null) {
        $this->className = $className;
        $this->annotation = $annotation;
    }

    public function getAnnotation() {
        return $this->annotation;
    }

    public function getClassName() {
        return $this->className;
    }

    public function getRegexMatcher() {
        return $this->regexMatcher;
    }

}
