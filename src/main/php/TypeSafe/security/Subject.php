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

require_once('SecurityManager.php');
require_once('NotAuthenticatedException.php');
require_once('NotAuthorizedException.php');


/**
 * 
 * @author Tobias Sarnowski
 */
interface Subject {

    /**
     * Returns the unique identifier, given by the {@link SecurityManager} during
     * login.
     *
     * @abstract
     * @return mixed
     */
    public function getPrincipal();

    /**
     * Logs in the current user.
     *
     * @abstract
     * @param  mixed $credentials
     * @return void
     */
    public function login($credentials);

    /**
     * Logs out the current user.
     *
     * @abstract
     * @param mixed $principal an optional hint for the security manager
     * @return void
     */
    public function logout($principal = null);

    /**
     * Returns if the current user is authenticated.
     *
     * @abstract
     * @return boolean
     */
    public function isAuthenticated();

    /**
     * Returns if the user has the given role.
     *
     * @abstract
     * @param  string $role
     * @return boolean
     */
    public function hasRole($role);

    /**
     * Tests if the user has the given role or throws a
     * {@link NotAuthorizedException}.
     *
     * @abstract
     * @param  string $permission
     * @return boolean
     */
    public function checkRole($role);

    /**
     * Returns if the user has the given permission.
     *
     * @abstract
     * @param  string $permission
     * @return boolean
     */
    public function hasPermission($permission);

    /**
     * Tests if the user has the given permission or throws a
     * {@link NotAuthorizedException}.
     *
     * @abstract
     * @param  string $permission
     * @return boolean
     */
    public function checkPermission($permission);

}
