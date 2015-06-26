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
    public $id_user;
    public $id_cabang;
    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelPinjaman = Mydb::getModelPinjaman();
        $this->_modelCabang = Mydb::getModelCabang();
        $this->id_user= $_SESSION['dataLogin']['id_user'];
        $this->id_cabang = $_SESSION['dataLogin']['id_cabang'];
    }

    public function index() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'headerDataTables.phtml';
        $where = $this->_modelCabang->getAdapter()->quoteInto('id_cabang = ? ', $this->id_cabang);
        $cabang = $this->_modelCabang->fetchRow($where);
        if (!$cabang) {
            $this->redirect('error');
        }
        $data = $this->_modelPinjaman->getDataPinjamanByCabang($this->id_user, $this->id_cabang);
        require APP_MODUL . '/pinjaman/view/dataPinjaman.phtml';
        require UD . 'footerDataTables.phtml';

    }

    public function add() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $no_kontrak = generateNoKontrak('AT-');
        $nik_costumer = $this->_modelCostumer->getNoKontrak();

        require UD . 'header.html';
        require APP_MODUL . '/pinjaman/form/form-add-pinjaman.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        $form = $this->getPost();
        try {
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
