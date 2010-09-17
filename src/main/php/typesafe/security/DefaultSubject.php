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

require_once('Subject.php');
require_once('SecurityManager.php');


/**
 * 
 * @author Tobias Sarnowski
 */ 
class DefaultSubject implements Subject {

    /**
     * Session key to use.
     */
    const PRINCIPAL_KEY = "__DEFAULT_SUBJECT_PRINCIPAL";

    /**
     * @var SecurityManager
     */
    private $securityManager;

    /**
     * @var array
     */
    private $roles = null;

    /**
     * @var array
     */
    private $permissions = null;

    function __construct(SecurityManager $securityManager) {
        $this->securityManager = $securityManager;
    }

    function loadRoles() {
        if ($this->roles == null) {
            $this->roles = $this->securityManager->getRoles($this);
        }
    }

    function loadPermissions() {
        if ($this->permissions == null) {
            $this->permissions = $this->securityManager->getPermissions($this);
        }
    }

    public function checkPermission($permission) {
        if (!$this->hasPermission($permission)) {
            throw new NotAuthorizedException("Permission denied: $permission");
        }
    }

    public function checkRole($role) {
        if (!$this->hasRole($role)) {
            throw new NotAuthorizedException("Role denied: $role");
        }
    }

    public function getPrincipal() {
        return $_SESSION[self::PRINCIPAL_KEY];
    }

    public function hasPermission($permission) {
        $this->loadPermissions();
        return in_array($permission, $this->permissions);
    }

    public function hasRole($role) {
        $this->loadRoles();
        return in_array($role, $this->roles);
    }

    public function isAuthenticated() {
        return $this->securityManager->isAuthenticated($this);
    }

    public function login($credentials) {
        $_SESSION[self::PRINCIPAL_KEY] = $this->securityManager->login($this, $credentials);
        $this->roles = null;
        $this->permissions = null;
    }

    public function logout($principal = null) {
        $_SESSION[self::PRINCIPAL_KEY] = $this->securityManager->logout($this, $principal);
        $this->roles = null;
        $this->permissions = null;
    }
}
