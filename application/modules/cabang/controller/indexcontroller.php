<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Cabang
 * @subpackage Controller
 * @filesource Index.php
 */


class Indexcontroller extends Controller {
    
    protected $_modelCabang ;
    
    public function __construct() {
        Auth::handleLogin();
        
        $this->_modelCabang = Mydb::getModelCabang();
    }
    
    protected function form() {
        include APP_MODUL . '/cabang/form/form-add-cabang.phtml';
    }
    
    public function index(){
        if($_SESSION['level']!='superadmin'){
            $this->redirect('error/index/notAllowed');
        }
        require_once UD.'headerDataTables.phtml';
        $data = $this->getAlldata();
        include  APP_MODUL.'/cabang/view/dataCabang.phtml';       
        require_once UD.'footerDataTables.phtml';
        
    }
    
    public function add(){
        require_once UD . 'header.html';
        $data = $this->_modelCabang->getLastCabang();
        pr($data);
        $lasID = !empty($data['0']['id_cabang']) ? $data['0']['id_cabang'] : 0;
        $idcabang = generateID($lasID);
        include APP_MODUL . '/cabang/form/form-add-cabang.phtml';;
        
        require_once UD . 'footer.html';
    }
    
    public function save() {
        $data = $this->getPost();
//        pr($data);die;
        try {
            $this->_modelCabang->insert($data);
            $this->redirect('cabang/index');
        } catch (Exception $ex) {
            require_once UD . 'header.html';
            echo $ex->getMessage();
            $this->form();
            require_once UD . 'footer.html';         
        }
    }
    
    public function edit($id) {
        if (!is_numeric($id)) {
            $this->redirect('error');
        }
        require_once UD . 'header.html';
        $where =  $this->_modelCabang->getAdapter()->quoteInto('id_cabang =?', $id);
        $dataCabang =  $this->_modelCabang->fetchRow($where)->toArray();
        include APP_MODUL . '/cabang/form/form-edit-cabang.phtml';
        require_once UD . 'footer.html';
    }

    public function update() {
        $data = $this->getPost();
        if (!is_numeric($data['id_cabang'])) {
            $this->redirect();
        }

        try {
            $where =  $this->_modelCabang->getAdapter()->quoteInto('id_cabang = ?', $data['id_cabang']);
            unset($data['id_cabang']);
            $this->_modelCabang->update($data, $where);
            $this->redirect('cabang');
        } catch (Exception $ex) {
            require_once UD . 'header.html';
            echo $ex->getMessage();
            $this->form();
            require_once UD . 'footer.html';  
        }
    }
    public function delete($id) {
        if (!is_numeric($id)) {
            $this->redirect();
        }
        $where = $this->_modelCabang->getAdapter()->quoteInto('id_cabang =?', $id);
        $this->_modelCabang->delete($where);
        $this->redirect('cabang');
    }
    public function getAlldata() {
        $data = $this->_modelCabang->getAllCabang();
        return $data;
    }
    
}


