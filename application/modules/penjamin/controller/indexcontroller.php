<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Penjamin
 * @subpackage Controller
 * @filesource IndexController
 */
class indexcontroller extends Controller {

    protected $_modelCostumer ;
    protected $_modelPenjamin;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelPenjamin = Mydb::getModelPenjamin();
        
    }

    public function index() {
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
//        $id=$_SESSION['dataLogin']['id_user'];
//        $this->_modelCostumer->getAllCostumerByCabang($id);
        require UD . 'header.html';
//        require APP_MODUL . '/penjamin/form/form-add-penjamin.phtml';
        require UD . 'footer.html';
    }
    
    public function detail($id){
        if(!isset($id)){
            $this->redirect('error');
        }
        $where = $this->_modelPenjamin->getAdapter()->quoteInto('nik_costumer', $id);
        $data = $this->_modelPenjamin->fetchRow($where);
        if(empty($data)){
            $this->redirect('error');
        }
        require UD . 'header.html';
        require APP_MODUL . '/penjamin/form/form-detail-penjamin.phtml';
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
        require UD . 'header.html';
        require APP_MODUL . '/penjamin/form/form-add-penjamin.phtml';
        require UD . 'footer.html';
    }
    
    public function save(){
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        try{
            $this->_modelPenjamin->insert($form);
            $this->redirect('costumer/index/detail/'.$form['nik_costumer']);
            
        } catch (Exception $ex) {
          require UD . 'header.html';
          echo $ex->getMessage();
          require APP_MODUL . '/penjamin/form/form-add-penjamin.phtml';
          require UD . 'footer.html';
        }
    }

}
