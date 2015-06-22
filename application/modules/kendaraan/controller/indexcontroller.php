<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Kendaraan
 * @subpackage Controller
 * @filesource IndexController.php
 */
class indexcontroller extends Controller {

    protected $_modelKendaraan;
    protected $_modelCostumer;
    protected $_modelCabang;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelCabang = Mydb::getModelCabang();
    }

    public function index() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'headerDataTables.phtml';
        $id_costumer = $_SESSION['dataLogin']['id_user'];
        $id_cabang = $_SESSION['dataLogin']['id_cabang'];
        $where = $this->_modelCabang->getAdapter()->quoteInto('id_cabang = ? ', $id_cabang);
        $cabang = $this->_modelCabang->fetchRow($where);
        if (!$cabang) {
            $this->redirect('error');
        }
        $data = $this->_modelKendaraan->getAllKendaraanByCabang($id_costumer, $id_cabang);
        require APP_MODUL . '/kendaraan/view/dataKendaraan.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function all() {
        if (($_SESSION['level'] != 'superadmin')) {
            $this->redirect('error/index/notAllowed');
        }

        require UD . 'headerDataTables.phtml';
        $id_costumer = $_SESSION['dataLogin']['id_user'];
        $id_cabang = $_SESSION['dataLogin']['id_cabang'];
        $data = $this->_modelKendaraan->getAllKendaraan();
        require APP_MODUL . '/kendaraan/view/dataKendaraanAll.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function detail($id) {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelKendaraan->getAdapter()->quoteInto('no_polisi = ?', $id);
        $data = $this->_modelKendaraan->fetchRow($where);
        if (!isset($data)) {
            $this->redirect('error');
        }
        require UD . 'header.html';
        require APP_MODUL . '/kendaraan/form/form-detail-kendaraan.phtml';
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
        $nik = $id;
        require UD . 'header.html';
        require APP_MODUL . '/kendaraan/form/form-add-kendaraan.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if ($_SESSION['level'] != 'superadmin' && $_SESSION['level'] != 'admin') {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $nik = $form['nik_costumer'];
        $where = $this->_modelCostumer->getAdapter()->quoteInto('nik_costumer =?', $nik);
        if (empty($this->_modelCostumer->fetchRow($where))) {
            $this->redirect('error');
        }
        try {
            $this->_modelKendaraan->insert($form);
            $this->redirect('costumer/index/detail/' . $form['nik_costumer']);
        } catch (Exception $ex) {
            require UD . 'header.html';
            echo $ex->getMessage();
            $nik = $form['nik_costumer'];
            require APP_MODUL . '/kendaraan/form/form-add-kendaraan.phtml';
            require UD . 'footer.html';
        }
    }
    
     public function edit($id) {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelKendaraan->getAdapter()->quoteInto('no_polisi = ?', $id);
        $data = $this->_modelKendaraan->fetchRow($where);
        if (!isset($data)) {
            $this->redirect('error');
        }
          
        require UD . 'header.html';
        require APP_MODUL . '/kendaraan/form/form-edit-kendaraan.phtml';
        require UD . 'footer.html';
    }
    
    public function saveedit(){
        $form = $this->getPost();
        try {
            $where = array();
            $where[] = $this->_modelKendaraan->getAdapter()->quoteInto('nik_costumer = ?', $form['nik_costumer']);
            $where[] = $this->_modelKendaraan->getAdapter()->quoteInto('no_polisi = ?', $form['no_polisi']);
            
            $this->_modelKendaraan->update($form, $where);
            $this->redirect('kendaraan');
            
        } catch (Exception $ex) {
            require UD . 'header.html';
            echo $ex->getMessage();
            require APP_MODUL . '/kendaraan/form/form-edit-kendaraan.phtml';
            require UD . 'footer.html';
        }
    }
}
