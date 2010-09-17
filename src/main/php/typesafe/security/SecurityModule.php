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
require_once('DefaultSubject.php');
require_once('RequiresAuthenticationInterceptor.php');
require_once('RequiresAuthenticationPointcut.php');
require_once('RequiresRolesInterceptor.php');
require_once('RequiresRolesPointcut.php');
require_once('RequiresPermissionsInterceptor.php');
require_once('RequiresPermissionsPointcut.php');
require_once('Subject.php');


/**
 * 
 * @author Tobias Sarnowski
 */ 
class SecurityModule implements Module {

    public function configure(Binder $binder) {
        $binder->bind('Subject')->to('DefaultSubject')->inRequestScope();

        $binder->bind('RequiresAuthenticationInterceptor')->inRequestScope();
        $binder->interceptWith('RequiresAuthenticationInterceptor')->on(new RequiresAuthenticationPointcut());

        $binder->bind('RequiresRolesInterceptor')->inRequestScope();
        $binder->interceptWith('RequiresRolesInterceptor')->on(new RequiresRolesPointcut());

        $binder->bind('RequiresPermissionsInterceptor')->inRequestScope();
        $binder->interceptWith('RequiresPermissionsInterceptor')->on(new RequiresPermissionsPointcut());
    }
}
