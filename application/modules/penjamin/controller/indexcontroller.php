<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Penjamin
 * @subpackage Controller
 * @filesource IndexController
 */
class indexcontroller extends Controller {

    protected $_modelCostumer;
    protected $_modelPenjamin;
    protected $_modelKendaraan;
    protected $_modelpinjaman;
    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelPenjamin = Mydb::getModelPenjamin();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->_modelpinjaman = Mydb::getModelPinjaman();
    }

    public function index() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $id_user = $_SESSION['dataLogin']['id_user'];
        $id_cabang = $_SESSION['dataLogin']['id_cabang'];
        $data = $this->_modelPenjamin->getPenjaminByCabang(null, $id_cabang);
        require UD . 'headerDataTables.phtml';
        require APP_MODUL . '/penjamin/view/dataPenjamin.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function all() {
        if (($_SESSION['level'] != 'superadmin')) {
            $this->redirect('error/index/notAllowed');
        }
        $id_user = $_SESSION['dataLogin']['id_user'];
        $id_cabang = $_SESSION['dataLogin']['id_cabang'];
        $data = $this->_modelPenjamin->getAllPenjamin();
        require UD . 'headerDataTables.phtml';
        require APP_MODUL . '/penjamin/view/dataPenjaminAll.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function edit($id) {
        if (!isset($id)) {
            $this->redirect('error');
        }
        if ($_SESSION['level'] != 'superadmin') {
            $this->redirect('error/index/notAllowed');
        }
        $id_penjamin = $id;
        $data = $this->_modelPenjamin->getPenjaminByID($id_penjamin);
        if (empty($data)) {
            $this->redirect('error');
        }
        $config = Mydb::getConfig();
        $agama = $config->agama;

        require UD . 'header.html';
        require APP_MODUL . '/penjamin/form/form-edit-penjamin.phtml';
        require UD . 'footer.html';
    }

    public function detail($id) {
        if (!isset($id)) {
            $this->redirect('error');
        }
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $where = $this->_modelpinjaman->getAdapter()->quoteInto('nik_costumer = ?', $id);
        $cekPinjaman = $this->_modelpinjaman->fetchRow($where);
        $where = $this->_modelPenjamin->getAdapter()->quoteInto('nik_costumer =?', $id);
        $whereKendaraan = $this->_modelKendaraan->getAdapter()->quoteInto('nik_costumer = ?', $id);
        $cekKendaraan = $this->_modelKendaraan->fetchRow($whereKendaraan);
        $data = $this->_modelPenjamin->fetchRow($where);
        if (empty($data)) {
            $this->redirect('error');
        }
        require UD . 'header.html';
        require APP_MODUL . '/penjamin/form/form-detail-penjamin.phtml';
        require UD . 'footer.html';
    }

    public function add($id) {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelCostumer->getAdapter()->quoteInto('nik_costumer =?', $id);
        if (empty($this->_modelCostumer->fetchRow($where))) {
            $this->redirect('error');
        }
        require UD . 'header.html';
        require APP_MODUL . '/penjamin/form/form-add-penjamin.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $form['tanggal_lahir']= date('Y-m-d',  strtotime($form['tanggal_lahir']));
        try {
            $this->_modelPenjamin->insert($form);
            $this->redirect('costumer/index/detail/' . $form['nik_costumer']);
        } catch (Exception $ex) {
            require UD . 'header.html';
            echo $ex->getMessage();
            require APP_MODUL . '/penjamin/form/form-add-penjamin.phtml';
            require UD . 'footer.html';
        }
    }

    public function saveedit() {
        if ($_SESSION['level'] != 'superadmin') {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $form['tanggal_lahir']=date('Y-m-d',  strtotime($form['tanggal_lahir']));
        $where = $this->_modelPenjamin->getAdapter()->quoteInto('id_penjamin = ?', $form['id_penjamin']);
        try {
            unset($form['id_penjamin']);
            $this->_modelPenjamin->update($form, $where);
            $this->redirect('penjamin');
        } catch (Exception $ex) {
            $config = Mydb::getConfig();
            $agama = $config->agama;
            require UD . 'header.html';
            $error = $ex->getMessage();
            require APP_MODUL . '/penjamin/form/form-edit-penjamin.phtml';
            require UD . 'footer.html';
        }
    }
    
    public function delete($id){
        if ($_SESSION['level'] != 'superadmin') {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelPenjamin->getAdapter()->quoteInto('id_penjamin = ?', $id);
        try {
            $this->_modelPenjamin->delete($where);
            $this->redirect('penjamin');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
 
}
