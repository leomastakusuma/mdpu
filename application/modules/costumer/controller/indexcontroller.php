<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Costumer
 * @subpackage Controller
 * @filesource IndexController
 */
class indexcontroller extends Controller {

    protected $_modelCostumer ;


    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        
    }

    public function index() {
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
        require UD . 'footer.html';
    }
    
    
    public function add() {
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
        require UD . 'footer.html';
    }
    
    public function save(){
        if(($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] !='admin')){
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $form['id_user'] = $_SESSION['dataLogin']['id_user'];
        try{
            $this->_modelCostumer->insert($form);
            $this->redirect('costumer');
            
        } catch (Exception $ex) {
          require UD . 'header.html';
          echo $ex->getMessage();
          require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
          require UD . 'footer.html';
        }
    }

}
