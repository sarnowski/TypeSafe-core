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
require_once('TypeSafe/session/Session.php');
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
     * @var Session
     */
    private $session;

    /**
     * @var array
     */
    private $roles = null;

    /**
     * @var array
     */
    private $permissions = null;

    /**
     * @param SecurityManager $securityManager
     * @param Session $session
     * @return void
     */
    function __construct(SecurityManager $securityManager, Session $session) {
        $this->securityManager = $securityManager;
        $this->session = $session;
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
        return $this->session->get(self::PRINCIPAL_KEY);
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
        $principal = $this->securityManager->login($this, $credentials);
        $this->session->set(self::PRINCIPAL_KEY, $principal);
        $this->roles = null;
        $this->permissions = null;
    }

    public function logout($principal = null) {
        $principal = $this->securityManager->logout($this, $principal);
        $this->session->set(self::PRINCIPAL_KEY, $principal);
        $this->roles = null;
        $this->permissions = null;
    }
}
