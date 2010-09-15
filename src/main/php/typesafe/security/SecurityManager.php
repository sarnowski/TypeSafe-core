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

require_once('IncorrectCredentialsException.php');
require_once('Subject.php');


/**
 * This interface has to be implemented and bind to gain access to this
 * security features.
 * 
 * @author Tobias Sarnowski
 */
interface SecurityManager {

    /**
     * Will be called on a login to verify the given credentials. Must
     * return a unique identifier (principal) for the logged in subject
     * or throw an {@link IncorrectCredentialsException}.
     *
     * @abstract
     * @param  Subject $subject
     * @param  mixed $credentials
     * @return mixed
     */
    public function login(Subject $subject, $credentials);

    /**
     * Will be called on a logout. The return value will be used as the
     * new principal of the subject.
     *
     * @abstract
     * @param  Subject $subject
     * @param  mixed $principal
     * @return mixed
     */
    public function logout(Subject $subject, $principal = null);

    /**
     * Returns if the subject is authenticated.
     *
     * @abstract
     * @param Subject $subject
     * @return boolean
     */
    public function isAuthenticated(Subject $subject);

    /**
     * Returns a list of textual roles for the given subject.
     *
     * @abstract
     * @param  Subject $subject
     * @return array
     */
    public function getRoles(Subject $subject);

    /**
     * Returns a list of textual permissions for the given subject.
     *
     * @abstract
     * @param  Subject $subject
     * @return array
     */
    public function getPermissions(Subject $subject);

}
