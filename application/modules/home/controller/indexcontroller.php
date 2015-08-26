<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    home
 * @subpackage Controller
 * @filesource Index.php
 */
class indexcontroller extends Controller {

    public function __construct() {
        Auth::handleLogin();
    }

    public function index() {
        require_once UD . 'header.html';
        require APP_MODUL . '/home/view/index.phtml';
        require_once UD . 'footer.html';
    }

}
