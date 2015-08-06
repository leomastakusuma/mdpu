<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Costumer
 * @subpackage Controller
 * @filesource IndexController
 */
class indexcontroller extends Controller {

    protected $_modelCostumer;
    protected $_modelKendaraan;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
    }

    public function index() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'headerDataTables.phtml';
        $cabang = $_SESSION['dataLogin']['id_cabang'];
        $data = $this->_modelCostumer->getAllCostumerByCabang($cabang,null);
        $cabang=$_SESSION['dataLogin']['cabang'];
        require APP_MODUL . '/costumer/view/dataCostumer.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function all() {
        if (($_SESSION['level'] != 'superadmin')) {
            $this->redirect('error/index/notAllowed');
        }

        require UD . 'headerDataTables.phtml';
        $data = $this->_modelCostumer->getAllCostumer();
        require APP_MODUL . '/costumer/view/dataCostumerAllCabang.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function add() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $form['id_user'] = $_SESSION['dataLogin']['id_user'];
        $form['id_cabang'] = $_SESSION['dataLogin']['id_cabang'];
        try {
            $this->_modelCostumer->insert($form);
            $this->redirect('costumer');
        } catch (Exception $ex) {
            require UD . 'header.html';
            $error = $ex->getMessage();
            require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
            require UD . 'footer.html';
        }
    }

    public function detail($id) {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $data = $this->_modelCostumer->getCostumer($id);
        $cekPenjamin = $this->_modelCostumer->getPenjaminCostumer($id);
        $whereKendaraan = $this->_modelKendaraan->getAdapter()->quoteInto('nik_costumer = ?', $id);
        $cekKendaraan = $this->_modelKendaraan->fetchRow($whereKendaraan);
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-detail-costumer.phtml';
        require UD . 'footer.html';
    }
    
     public function delete($id) {
        if ($_SESSION['level'] != 'superadmin') {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelCostumer->getAdapter()->quoteInto('nik_costumer = ?', $id);
        try {
            $this->_modelCostumer->delete($where);
            $this->redirect('costumer');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function edit($id) {
        if ($_SESSION['level'] != 'superadmin') {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelCostumer->getAdapter()->quoteInto('nik_costumer = ?', $id);
        $data = $this->_modelCostumer->fetchRow($where);
        pr($data->toArray());
        if (empty($data)) {
            $this->redirect('error');
        }
        $config = Mydb::getConfig();
        $agama = $config->agama;
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-edit-costumer.phtml';
        require UD . 'footer.html';
    }

    public function saveedit() {
        if ($_SESSION['level'] != 'superadmin') {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $where = $this->_modelCostumer->getAdapter()->quoteInto('id_costumer = ?', $form['id_costumer']);
        try {
            $this->_modelCostumer->update($form, $where);
            $this->redirect('costumer');
        } catch (Exception $ex) {
            $config = Mydb::getConfig();
            $agama = $config->agama;
            require UD . 'header.html';
            $error = $ex->getMessage();
            require APP_MODUL . '/costumer/form/form-edit-costumer.phtml';
            require UD . 'footer.html';
        }
    }

}
