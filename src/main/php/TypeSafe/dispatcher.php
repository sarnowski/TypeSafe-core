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

// possible include paths to add and check
$includePaths = array(
    realpath(dirname(__FILE__).'/../'),  // general path
    realpath(dirname(__FILE__).'/../../../src/main/php/'),  // for development with maven
    realpath(dirname(__FILE__).'/../../../src/main/resources/'),  // for development with maven
);

// set include path to root directory
$includePath = get_include_path();
foreach ($includePaths as $path) {
    $includePath .= PATH_SEPARATOR.$path;
}
if (!set_include_path($includePath)) {
    die('Cannot set include path!');
}

// helper for file_exists
function include_file_exists($filename) {
    global $includePaths;
    if (file_exists($filename)) {
        return true;
    }
    foreach ($includePaths as $path) {
        if (file_exists("$path/$filename")) {
            return true;
        }
    }
    return false;
}

// basic requirements
require_once('pinjector/Module.php');
require_once('TypeSafe/BootLoader.php');
require_once('TypeSafe/http/HttpException.php');
require_once('TypeSafe/http/InternalServerErrorException.php');


// throw php errors as exceptions
function exceptions_error_handler($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

set_error_handler('exceptions_error_handler');

// buffer output
ob_start();

// helper to print nice errors
function print_exception(Exception $e) {
    $debug = ini_get('display_errors');

    ob_end_clean();

    if ($e instanceof HttpException) {
        if (!headers_sent()) header('HTTP/1.0 '.$e->getStatusCode().' '.$e->getTitle());
        echo '<h1>'.$e->getTitle().'</h1>';
    } else {
        if (!headers_sent()) header('HTTP/1.0 500 Internal Server Error');
        echo '<h1>Internal Server Error</h1>';
    }
    if ($debug) {
        echo '<h2>'.get_class($e).': '.$e->getMessage().'</h2>';
        echo '<pre>'.$e->getTraceAsString().'</pre>';
    }
}


// main boot
try {

    // load configuration file
    $configFile = 'config.typesafe.php';
    if (!include_file_exists($configFile)) {
        throw new InternalServerErrorException('Configuration file not found ['.$configFile.']');
    }
    require($configFile);
    if (!isset($config) || !is_array($config)) {
        throw new InternalServerErrorException('$config not set in configuration file');
    }

    // test the application modul
    if (!isset($config['applicationModule'])) {
        throw new InternalServerErrorException('"applicationModule" not set in configuration file');
    }
    $applicationModule = $config['applicationModule'];
    if (!($applicationModule instanceof Module)) {
        throw new InternalServerErrorException('"applicationModule" is not a Module');
    }

    // initialize
    $framework = BootLoader::boot($applicationModule);

    // execute
    $framework->request($_GET['uri']);

    // print output buffer
    ob_end_flush();

} catch (Exception $e) {
    print_exception($e);
}

die();