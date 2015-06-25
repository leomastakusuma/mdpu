<?php
/**
 * MDPU Finance
 * @category   Modules
 * @package    Pinjamin
 * @subpackage Controller
 * @filesource IndexController
 */

class IndexController extends Controller {
    
    protected $_modelCostumer;
    protected $_modelPinjaman;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelPinjaman = Mydb::getModelPinjaman();
    }

    public function index(){
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $no_kontrak = $this->generateNoKontrak('AT-');
        $nik_costumer = $this->_modelCostumer->getNoKontrak();
        
        require UD . 'header.html';
        require APP_MODUL . '/pinjaman/form/form-add-pinjaman.phtml';
        require UD . 'footer.html';
    }
    
    public function save(){
        $form = $this->getPost();
        try{
            $this->_modelPinjaman->insert($form);
        } catch (Exception $ex) {
            require UD . 'header.html';
            $error = $ex->getMessage();
            $nik_costumer = $this->_modelCostumer->getNoKontrak();
            require APP_MODUL . '/pinjaman/form/form-add-pinjaman.phtml';
            require UD . 'footer.html';
        }
    }
}