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
require_once('pinjector/Interceptor.php');
require_once('NotAuthenticatedException.php');
require_once('Subject.php');


/**
 * 
 * @author Tobias Sarnowski
 */ 
class RequiresAuthenticationInterceptor implements Interceptor {

    /**
     * @var Subject
     */
    private $subject;

    /**
     * @param Subject $subject
     * @return void
     */
    function __construct(Subject $subject) {
        $this->subject = $subject;
    }

    public function intercept(InterceptionChain $chain) {
        if ($this->subject->isAuthenticated()) {
            return $chain->proceed();
        } else {
            throw new NotAuthenticatedException("Subject is not authenticated");
        }
    }
}
