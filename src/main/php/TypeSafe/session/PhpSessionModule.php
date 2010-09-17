<?php
require_once('pinjector/Module.php');
require_once('Session.php');
require_once('PhpSession.php');


/**
 *
 * @author Tobias Sarnowski
 */ 
class PhpSessionModule implements Module {

    public function configure(Binder $binder) {
        $binder->bind('Session')->to('PhpSession')->inRequestScope();
    }
}
