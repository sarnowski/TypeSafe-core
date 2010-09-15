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

require_once('pinjector/DefaultKernel.php');
require_once('pinjector/Kernel.php');
require_once('pinjector/Module.php');
require_once('DefaultRequestHandler.php');
require_once('Framework.php');

/**
 * 
 * @author Tobias Sarnowski
 */
class DefaultFramework implements Framework {

    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @var array
     */
    private $matches;

    function __construct(Module $module) {
        $this->kernel = DefaultKernel::boot($module);
    }

    public function request($requestUri) {
        // search for the handler
        foreach ($this->matches as $match) {
            if (preg_match($match->getRegexMatcher(), $requestUri, $matches)) {
                // get the handler instance
                $handler = $this->kernel->getInstance(
                    $match->getClassName(),
                    $match->getAnnotation()
                );

                // call it!
                $handler->handleRequest($matches);
                return;
            }
        }

        // nothing matched? bad
        throw new ConfigurationException("no request handler matched");
    }

    public function install(Module $module) {
        $this->kernel->install($module);
    }

    public function handle($requestMatching) {
        $handler = new DefaultRequestHandler($requestMatching);
        $this->matches[] = $handler;
        return $handler;
    }
}
