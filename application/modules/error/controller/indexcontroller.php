<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    error
 * @subpackage Controller
 * @filesource Index.php
 */


class IndexController extends Controller {
    
    public function __construct() {
        Auth::handleLogin();
    }

        public function index(){
        require_once UD . 'header.html';
        include APP_MODUL . '/error/view/error.phtml';
        require_once UD . 'footer.html';
         
    }
    
    public function notAllowed(){
        require_once UD . 'header.html';
        include APP_MODUL . '/error/view/notAllowed.phtml';
        require_once UD . 'footer.html';
    }
}