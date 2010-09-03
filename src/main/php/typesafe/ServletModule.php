<?php
/*
 * Copyright 2010 Tobias Sarnowski
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

require_once('pinjector/Module.php');

/**
 * 
 * @author Tobias Sarnowski
 */
abstract class ServletModule implements Module {

    private $matcher = array();

    /**
     * Registers a matching regex to dispatch a request
     * to the given binding.
     *
     * @param  string $requestMatching
     * @param  string $className
     * @param  string $annotation
     * @return void
     */
    public function handle($requestMatching, $className, $annotation = null) {
        $this->matcher[] = array(
            'requestMatching' => $requestMatching,
            'className' => $className,
            'annotation' => $annotation
        );
    }

    /**
     * @return array
     */
    public function getMatcher() {
        return $this->matcher;
    }

}
