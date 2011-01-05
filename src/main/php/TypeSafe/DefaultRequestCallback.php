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

require_once('pinjector/Kernel.php');
require_once('pinjector/RegistryCallback.php');
require_once('DefaultRequestHandler.php');


/**
 *
 * @author Tobias Sarnowski
 */
class DefaultRequestCallback implements RegistryCallback {

    /**
     * @var string
     */
    private $requestUri;

    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @param string $requestUri
     * @param Kernel $kernel
     * @return void
     */
    function __construct($requestUri, Kernel $kernel) {
        $this->requestUri = $requestUri;
        $this->kernel = $kernel;
    }

    /**
     * @param DefaultRequestHandler $handler
     * @return bool
     */
    public function process($handler) {
        if (preg_match($handler->getRegexMatcher(), $this->requestUri, $matches)) {
            // get the handler instance
            $handlerInstance = $this->kernel->getInstance(
                $handler->getClassName(),
                $handler->getAnnotation()
            );

            // call it!
            $handlerInstance->handleRequest($matches);
            return false;
        }
        return true;
    }
}
