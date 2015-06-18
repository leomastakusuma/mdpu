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
    protected $_modelCostumer;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->_modelCostumer = Mydb::getModelCostumer();
    }

    public function index() {
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
        
        require UD . 'header.html';
        require  APP_MODUL.'/kendaraan/form/form-add-kendaraan.phtml';
        require UD . 'footer.html';
    }
    
    public function add($id) {
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
        if(!isset($id)){
            $this->redirect('error'); 
        }
        $where = $this->_modelCostumer->getAdapter()->quoteInto('nik_costumer =?', $id);
        if(empty($this->_modelCostumer->fetchRow($where))){
            $this->redirect('error');
        }
        $nik = $id;
        require UD . 'header.html';
        require  APP_MODUL.'/kendaraan/form/form-add-kendaraan.phtml';
        require UD . 'footer.html';
    }
    
    public function save(){
        if($_SESSION['level']!='superadmin' && $_SESSION['level']!='admin'){
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        try{
           $this->_modelKendaraan->insert($form); 
           $this->redirect('costumer/index/detail/'.$form['nik_costumer']);
        } catch (Exception $ex) {
           require UD . 'header.html';
           echo $ex->getMessage();
           require  APP_MODUL.'/kendaraan/form/form-add-kendaraan.phtml';
           require UD . 'footer.html';
        }
        
    }

}
