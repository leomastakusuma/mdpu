<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Kendaraan
 * @subpackage Controller
 * @filesource IndexController.php
 */
class indexcontroller extends Controller {
    
    protected $_modelKendaraan ;


    public function __construct() {
        Auth::handleLogin();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
    }

    public function index() {
        require UD . 'header.html';
        require  APP_MODUL.'/kendaraan/form/form-add-kendaraan.phtml';
        require UD . 'footer.html';
    }
    
    public function add() {
        require UD . 'header.html';
        require  APP_MODUL.'/kendaraan/form/form-add-kendaraan.phtml';
        require UD . 'footer.html';
    }
    
    public function save(){
        $form = $this->getPost();
        try{
           $this->_modelKendaraan->insert($form); 
           $this->redirect('kendaraan');
        } catch (Exception $ex) {
           require UD . 'header.html';
           echo $ex->getMessage();
           require  APP_MODUL.'/kendaraan/form/form-add-kendaraan.phtml';
           require UD . 'footer.html';
        }
        
    }

}
