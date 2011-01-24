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

require_once('pinjector/ConfigurationException.php');
require_once('pinjector/DefaultKernel.php');
require_once('pinjector/Kernel.php');
require_once('pinjector/Module.php');
require_once('http/NotFoundException.php');
require_once('DefaultRequestCallback.php');
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

    function __construct(Module $module) {
        $this->kernel = DefaultKernel::boot($module);
    }

    public function install(Module $module) {
        $this->kernel->install($module);
    }

    public function request($requestUri) {
        // try the handlers
        $registry = $this->kernel->getInstance('Registry');
        try {
            $notfound = $registry->call('RequestHandler',
                new DefaultRequestCallback($requestUri, $this->kernel)
            );
        } catch (Exception $e) {
            $logger = $this->kernel->getInstance('Logger');
            $logger->error("Uncatched exception during request $requestUri", $e);
            throw $e;
        }

        // nothing matched? bad
        if ($notfound) {
            throw new NotFoundException("no request handler matched");
        }
    }

}
