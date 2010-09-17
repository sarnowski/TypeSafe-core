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
require_once('PHPUnit/Framework.php');
require_once('TypeSafe/BootLoader.php');
require_once('TestModule.php');

/**
 *
 * @author Tobias Sarnowski
 */
class ApplicationTest extends PHPUnit_Framework_TestCase {

    public function testDummy() {
        $framework = BootLoader::boot(new TestModule());

        // do your work
        $framework->request('/test/1234/9.html');
    }

}
