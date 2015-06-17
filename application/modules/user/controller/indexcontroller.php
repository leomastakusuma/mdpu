<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    User
 * @subpackage Controller
 * @filesource Indexcontroller.php
 */
class Indexcontroller extends Controller {

    protected $_modelUser;
    protected $_modelCabang;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelUser = Mydb::getModelUser();
        $this->_modelCabang = Mydb::getModelCabang();
    }

    public function index() {
        if($_SESSION['level']!='superadmin'){
            $this->redirect('error/index/notAllowed');
        }
        require_once UD . 'headerDataTables.phtml';
        $data = $this->_modelUser->getAllUser();
        include APP_MODUL . '/user/view/dataUser.phtml';
        require_once UD . 'footerDataTables.phtml';
    }

    public function add() {
        require_once UD . 'header.html';
        $data = $this->_modelCabang->getAllCabang();
        include APP_MODUL . '/user/form/form-user.phtml';
        require_once UD . 'footer.html';
    }

    public function save() {
        $form = $this->getPost();
        $form['Password']=  sha1($form['Password']);
        
        try {
            $this->_modelUser->insert($form);
            $this->redirect('user');
        } catch (Exception $ex) {
            require_once UD . 'header.html';
            echo $ex->getMessage();
            $data = $this->_modelCabang->getAllCabang();
            include APP_MODUL . '/user/form/form-user.phtml';
            require_once UD . 'footer.html';
        }
    }

    public function edit($id) {
        pr($_SESSION);
        if (!is_numeric($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelUser->getAdapterSelect()->quoteInto('id_user = ?', $id);
        $data = $this->_modelUser->fetchRow($where)->toArray()
        ;
        if (empty($data)) {
            $this->redirect();
        }
        $data;
        pr($data);
    }
    
    public function delete($id) {
        if (!is_numeric($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelUser->getAdapter()->quoteInto('id_user =?', $id);
        $this->_modelUser->delete($where);
        $this->redirect('user');
    }
    
    public function profile($id){
        if(!is_numeric($id)){
            $this->redirect('error');
        }
        require_once UD . 'header.html';
//        $where = $this->_modelUser->getAdapter()->quoteInto('id_user = ?', $id);
//        $data = $this->_modelUser->fetchRow($where)->toArray();
        $data = $this->_modelUser->profile($id);
        include APP_MODUL . '/user/form/form-profile.phtml';
        require_once UD . 'footer.html';

        
    }
    
    public function changepassword(){
        echo 'leo';
    }
}
