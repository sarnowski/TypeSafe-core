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
require_once('pinjector/DocParser.php');
require_once('pinjector/Pointcut.php');


/**
 *
 * @author Tobias Sarnowski
 */
class RequiresRolesPointcut implements Pointcut {

    public function matchesMethod(ReflectionMethod &$method) {
        $value = DocParser::parseSetting($method->getDocComment(), 'requiresRoles');
        if (is_null($value)) {
            return false;
        } else {
            if (trim($value) == '') {
                throw new SecurityConfigurationException(
                    "@requiresRoles without role hints found in method ".
                            $method->getDeclaringClass()->getName().
                            "->".
                            $method->getName()
                );
            } else {
                return true;
            }
        }
    }
}
