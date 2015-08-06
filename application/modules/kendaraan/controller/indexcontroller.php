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
    protected $_modelpinjaman;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelCabang = Mydb::getModelCabang();
        $this->_modelpinjaman = Mydb::getModelPinjaman();
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
        $data = $this->_modelKendaraan->getAllKendaraanByCabang(null, $id_cabang);
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
    
    public function detailbyid($id) {
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
        require APP_MODUL . '/kendaraan/form/form-detail-kendaraan-byid.phtml';
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

    public function save($id) {
        if ($_SESSION['level'] != 'superadmin' && $_SESSION['level'] != 'admin') {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        $form['status'] = 'new';
        $nik = $form['nik_costumer'];
        $where = $this->_modelCostumer->getAdapter()->quoteInto('nik_costumer =?', $nik);
        if (empty($this->_modelCostumer->fetchRow($where))) {
            $this->redirect('error');
        }
        try {
            $this->_modelKendaraan->insert($form);
            $this->redirect('kendaraan/index/byid/'.$form['nik_costumer']);

        } catch (Exception $ex) {
            require UD . 'header.html';
            $error  = $ex->getMessage();
            $nik    = $form['nik_costumer'];
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
        $where = $this->_modelKendaraan->getAdapter()->quoteInto('id_kendaraan = ?', $id);
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
            $where[] = $this->_modelKendaraan->getAdapter()->quoteInto('id_kendaraan = ?', $form['id_kendaraan']);
            
            $this->_modelKendaraan->update($form, $where);
            $this->redirect('kendaraan');
            
        } catch (Exception $ex) {
            require UD . 'header.html';
            $error = $ex->getMessage();
            require APP_MODUL . '/kendaraan/form/form-edit-kendaraan.phtml';
            require UD . 'footer.html';
        }
    }
    
    public function byid($nik_costumer){
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        if (!isset($nik_costumer)) {
            $this->redirect('error');
        }
        require UD . 'headerDataTables.phtml';
        $where = $this->_modelpinjaman->getAdapter()->quoteInto('nik_costumer = ?', $nik_costumer);
        $cekPinjaman = $this->_modelpinjaman->fetchRow($where);
        
        $data = $this->_modelKendaraan->getByidCostumer($nik_costumer);
        $cekPenjamin = $this->_modelCostumer->getPenjaminCostumer($nik_costumer);
        require APP_MODUL . '/kendaraan/view/dataKendaraanbyCostumer.phtml';
        require UD . 'footerDataTables.phtml';
        
    }

//    public function saveAdd($id){
//
//        $form   = $this->getPost();
//        pr($form);
//        try{
//
//            require UD . 'header.html';
//            $msg    = "Berhasil Menambah kendaraaan untuk Costumer ".$id ;
//            require APP_MODUL . '/kendaraan/form/form-add-kendaraan.phtml';
//            require UD . 'footer.html';
//        }
//        catch(PDOException $ex){
//            require UD . 'header.html';
//            $error  = $ex->getMessage();
//            require APP_MODUL . '/kendaraan/form/form-add-kendaraan.phtml';
//            require UD . 'footer.html';
//        }
//    }
}
