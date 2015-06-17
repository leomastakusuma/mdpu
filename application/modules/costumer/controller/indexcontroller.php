<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Costumer
 * @subpackage Controller
 * @filesource IndexController
 */
class indexcontroller extends Controller {

    public function __construct() {
        Auth::handleLogin();
    }

    public function index() {
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
        require UD . 'footer.html';
    }

}
