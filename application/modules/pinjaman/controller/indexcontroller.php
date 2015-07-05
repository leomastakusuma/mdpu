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
    protected $_modelKendaraan;
    protected $_modelPinjaman;
    protected $_modelSPB;
    protected $_modelCabang;
    public $id_user;
    public $id_cabang;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelPinjaman = Mydb::getModelPinjaman();
        $this->_modelCabang = Mydb::getModelCabang();
        $this->_modelSPB = Mydb::getModelSPB();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->id_user = $_SESSION['dataLogin']['id_user'];
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
        foreach ($data as $key => $val) {
            $no_spb = $val['no_kontrak'];
            $where = $this->_modelSPB->getAdapter()->quoteInto('no_kontrak = ?', $no_spb);
            $spb = $this->_modelSPB->fetchRow($where);
            $data[$key]['spb'] = $spb->no_spb;
        }
        require APP_MODUL . '/pinjaman/view/dataPinjaman.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function add($nopos = null) {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }

        $nik_costumer = $this->_modelCostumer->getNoKontrak();
        $no_polisi = $this->_modelKendaraan->getNoPolisi();
        if (!empty($nopos)) {
            $data = $this->_modelKendaraan->getKenCostum($nopos);
            $where = $this->_modelPinjaman->getAdapter()->quoteInto('nik_costumer =?', $data['nik_costumer']);
            $cekData = $this->_modelPinjaman->fetchRow($where);
            $lastid = $this->_modelPinjaman->getLastId();
            $status = (!empty($cekData) ? '/MD/' : '/MF/');
            $id_cabang = $_SESSION['dataLogin']['id_cabang'] . $status;
            $no_kontrak = generateNoKontrak($id_cabang, $lastid);
        }

        require UD . 'header.html';
        require APP_MODUL . '/pinjaman/form/form-add-pinjaman.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        $form = $this->getPost();
        unset($form['nama']);
        try {
            $this->_modelPinjaman->insert($form);
            /* Start Update status kendaraan */
            $where = $this->_modelKendaraan->getAdapter()->quoteInto('no_polisi = ?', $form['no_polisi']);
            $data = array('status' => 'kredit');
            $this->_modelKendaraan->update($data, $where);
            /* End Update Status Kendaraan */
        } catch (Exception $ex) {
            require UD . 'header.html';
            $error = $ex->getMessage();
            $nik_costumer = $this->_modelCostumer->getNoKontrak();
            require APP_MODUL . '/pinjaman/form/form-add-pinjaman.phtml';
            require UD . 'footer.html';
        }
    }

    public function cetakSPB($id) {
        if (($_SESSION['level'] != 'superadmin') && ($_SESSION['level'] != 'admin')) {
            $this->redirect('error/index/notAllowed');
        }
        if (empty($id)) {
            $this->redirect('error');
        }
        $where = $this->_modelPinjaman->getAdapterSelect()->quoteInto('id_pinjaman =?', $id);
        $data = $this->_modelPinjaman->fetchRow($where)->toArray();
        if (empty($data)) {
            $this->redirect('error');
        }
        unset($data['id_pinjaman']);
        unset($data['nilai_pinjaman']);
        unset($data['lama_angsuran']);
        unset($data['angsuran_perbulan']);
        try {
            $this->_modelSPB->insert($data);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

    }
    
    public function all() {
        if (($_SESSION['level'] != 'superadmin')) {
            $this->redirect('error/index/notAllowed');
        }
        require UD . 'headerDataTables.phtml';
        $where = $this->_modelCabang->getAdapter()->quoteInto('id_cabang = ? ', $this->id_cabang);
        $cabang = $this->_modelCabang->fetchRow($where);
        if (!$cabang) {
            $this->redirect('error');
        }
        $data = $this->_modelPinjaman->getDataPinjamanAllCabang();
        foreach ($data as $key => $val) {
            $no_spb = $val['no_kontrak'];
            $where = $this->_modelSPB->getAdapter()->quoteInto('no_kontrak = ?', $no_spb);
            $spb = $this->_modelSPB->fetchRow($where);
            $data[$key]['spb'] = $spb->no_spb;
        }
        require APP_MODUL . '/pinjaman/view/dataPinjamanAll.phtml';
        require UD . 'footerDataTables.phtml';
    }

}
