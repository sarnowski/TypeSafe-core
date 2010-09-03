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
require_once('PropertyConfiguration.php');

/**
 * 
 * @author Tobias Sarnowski
 */
class PropertyConfigurationModule implements Module {

    /**
     * @var PropertyConfiguration
     */
    private $config;

    public function __construct($file) {
        $this->config = new PropertyConfiguration($file);
    }

    public function addFile($file) {
        $this->config->addFile($file);
    }

    public function configure(Binder $binder) {
        $binder->bind('Configuration')->toInstance($this->config);
    }
}
