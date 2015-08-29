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
    protected $_modelPinjaman;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->_modelPinjaman = Mydb::getModelPinjaman();
    }

    public function index() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'admin') ) {
            $this->redirect( 'error/index/notAllowed' );
        }

        require UD . 'headerDataTables.phtml';
        $cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
        $data = $this->_modelCostumer->getAllCostumerByCabang( $cabang, null );
        $cabang = $_SESSION[ 'dataLogin' ][ 'cabang' ];
        require APP_MODUL . '/costumer/view/dataCostumer.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function all() {
        if ( ($_SESSION[ 'level' ] != 'superadmin' ) ) {
            $this->redirect( 'error/index/notAllowed' );
        }

        require UD . 'headerDataTables.phtml';
        $data = $this->_modelCostumer->getAllCostumer();
        require APP_MODUL . '/costumer/view/dataCostumerAllCabang.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function add() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'admin') ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'admin') ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        $form = $this->getPost();
        $form[ 'id_user' ] = $_SESSION[ 'dataLogin' ][ 'id_user' ];
        $form[ 'id_cabang' ] = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
        try {
            $this->_modelCostumer->insert( $form );
            $this->redirect( 'costumer' );
        } catch ( Exception $ex ) {
            require UD . 'header.html';
            $error = $ex->getMessage();
            require APP_MODUL . '/costumer/form/form-add-costumer.phtml';
            require UD . 'footer.html';
        }
    }

    public function detail( $id ) {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'admin') ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        if ( !isset( $id ) ) {
            $this->redirect( 'error' );
        }
        $data = $this->_modelCostumer->getCostumer( $id );
        $cekPenjamin = $this->_modelCostumer->getPenjaminCostumer( $id );
        $whereKendaraan = $this->_modelKendaraan->getAdapter()->quoteInto( 'nik_costumer = ?', $id );
        $cekKendaraan = $this->_modelKendaraan->fetchRow( $whereKendaraan );
        $wherePinjaman = $this->_modelPinjaman->getAdapter()->quoteInto( 'nik_costumer = ?', $id );
        $cekPinjaman = $this->_modelPinjaman->fetchRow( $wherePinjaman );

        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-detail-costumer.phtml';
        require UD . 'footer.html';
    }

    public function delete( $id ) {
        if ( $_SESSION[ 'level' ] != 'superadmin' ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        if ( !isset( $id ) ) {
            $this->redirect( 'error' );
        }
        $where = $this->_modelCostumer->getAdapter()->quoteInto( 'nik_costumer = ?', $id );
        try {
            $this->_modelCostumer->delete( $where );
            $this->redirect( 'costumer' );
        } catch ( Exception $ex ) {
            echo $ex->getMessage();
        }
    }

    public function edit( $id ) {
        if ( $_SESSION[ 'level' ] != 'superadmin' ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        if ( !isset( $id ) ) {
            $this->redirect( 'error' );
        }
        $where = $this->_modelCostumer->getAdapter()->quoteInto( 'nik_costumer = ?', $id );
        $data = $this->_modelCostumer->fetchRow( $where );

        if ( empty( $data ) ) {
            $this->redirect( 'error' );
        }
        $config = Mydb::getConfig();
        $agama = $config->agama;
        require UD . 'header.html';
        require APP_MODUL . '/costumer/form/form-edit-costumer.phtml';
        require UD . 'footer.html';
    }

    public function cariCostumer() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'admin') && ($_SESSION[ 'level' ] != 'pimpinan') ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        if ( $_SESSION[ 'level' ] === 'pimpinan' ) {
            require UD . 'headerDataTables.phtml';
            $idcabang = (($_SESSION[ 'level' ] === 'pimpinan')||($_SESSION[ 'level' ] === 'admin')) ? $_SESSION[ 'dataLogin' ][ 'id_cabang' ] : false;
            $cabang = ($_SESSION[ 'level' ] === 'pimpinan') ? $_SESSION[ 'dataLogin' ][ 'cabang' ] : false;
            $data = $this->_modelCostumer->getCetakDataCostumer( $idcabang, FALSE );
            require APP_MODUL . '/costumer/view/caridataCostumer.phtml';
            require UD . 'footerDataTables.phtml';
        } else {
            require UD . 'header.html';
            $nik_costumer = $this->_modelCostumer->getNikCostumer();
            $no_kontrak = $this->_modelCostumer->getNoKontrak( FALSE, true );
            require APP_MODUL . '/costumer/form/form-cetak-costumer.phtml';
            require UD . 'footer.html';
        }
    }

    public function cetakCostumer() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'admin') && ($_SESSION[ 'level' ] != 'pimpinan') ) {
            $this->redirect( 'error/index/notAllowed' );
        }

        $form = $this->getPost();
        $fields = array();
        foreach ( $form as $k => $v ) {
            if ( !empty( $v ) ) {
                $fields[ $k ] = $v;
                if ( $k === 'awal' || $k === 'akhir' ) {
                    $fields[][ 'priode' ][ $k ] = date( 'Y-m-d', strtotime( $v ) );
                }
                if ( $k === 'awal' || $k === 'akhir' ) {
                    unset( $fields[ 'awal' ] );
                    unset( $fields[ 'akhir' ] );
                }
            }
        }
        $request = $this->getRequest();
        $params = (!empty( $request[ 'params' ] )) ? array_shift( $request[ 'params' ] ) : null;
        if ( !empty( $params ) ) {
            $fiedlsCetak = !empty( $_SESSION[ 'fields' ] ) ? $_SESSION[ 'fields' ] : null;
            $idcabang = ($_SESSION[ 'level' ] === 'admin') ? $_SESSION[ 'dataLogin' ][ 'id_cabang' ] : false;
            $dataCostumer = $this->_modelCostumer->getCetakDataCostumerAllFields( $idcabang, $fiedlsCetak );
//            pr($dataCostumer);
            $this->cetakcsv($dataCostumer);
            unset( $_SESSION[ 'fields' ] );
        } else {
            require UD . 'header.html';
            $idcabang = (($_SESSION[ 'level' ] === 'pimpinan') || ($_SESSION[ 'level' ] === 'admin')) ? $_SESSION[ 'dataLogin' ][ 'id_cabang' ] : false;
            $cabang = ($_SESSION[ 'level' ] === 'pimpinan') ? $_SESSION[ 'dataLogin' ][ 'cabang' ] : false;
            $data = $this->_modelCostumer->getCetakDataCostumer( $idcabang, $fields );
            if ( empty( $data ) ) {
                $this->redirect( 'error' );
            }
            $_SESSION[ 'fields' ] = $fields;
            require APP_MODUL . '/costumer/view/cetakCostumer.phtml';
            require UD . 'footer.html';
        }
    }

    public function saveedit() {
        if ( $_SESSION[ 'level' ] != 'superadmin' ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        $form = $this->getPost();
        $where = $this->_modelCostumer->getAdapter()->quoteInto( 'id_costumer = ?', $form[ 'id_costumer' ] );
        try {
            $this->_modelCostumer->update( $form, $where );
            $this->redirect( 'costumer' );
        } catch ( Exception $ex ) {
            $config = Mydb::getConfig();
            $agama = $config->agama;
            require UD . 'header.html';
            $error = $ex->getMessage();
            require APP_MODUL . '/costumer/form/form-edit-costumer.phtml';
            require UD . 'footer.html';
        }
    }
    
    protected function cetakcsv($data){
        $dataCostumer = $data;
        $headerFields = array_shift($data);
        $line = array();
        $dir = APP_DIR.'/download';
         if(!is_dir( $dir )){
             mkdir($dir, 7777);
         }

        $filenames = '/DataCostumer-'.date('d-m-Y H:i:s').'.csv';
        $files = $dir.$filenames;
        $file = fopen($files,"w");

        $header = '';
        $value = '';
        foreach ($headerFields as $k=>$v){
             $header .=strtoupper($k).',';
        }
        fwrite($file, "$header\n");
            $value = array();
            foreach ($dataCostumer as $key=>$row){
                $value = $row['nik_costumer'].',';
                $value .= $row['nama_costumer'].',';
                $value .= $row['alamat'].',';
                $value .= $row['tempat_lahir'].',';
                $value .= $row['tanggal_lahir'].',';
                $value .= $row['nama_ibu'].',';
                $value .= $row['jenis_kelamin'].',';
                $value .= $row['agama'].',';
                $value .= $row['pekerjaan'].',';
                $value .= isFloatNum($row['hp']).',';
                $value .= $row['telpon'].',';
                $value .= $row['npwp'].',';
                $value .= $row['penghasilan_perbulan'].',';
                $value .= $row['jumlah_tanggungan'].',';
                $value .= $row['nik_penjamin'].',';
                $value .= $row['nama_penjamin'].',';
                $value .= $row['no_polisi'].',';
                $value .= $row['merk'].',';
                $value .= $row['no_kontrak'].',';
                $value .= isFloatNum($row['nilai_pinjaman']).',';
                $value .= isFloatNum($row['angsuran_perbulan']).',';
                $value .= $row['lama_angsuran'].',';
                $value .= $row['total_ang'].',';
                $value .= $row['cabang'].',';
                fputcsv($file, explode(',',$value));

            }

        fclose($file);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$filenames}");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Content-Length: '.filesize($files));
        echo file_get_contents($files);
    }

}
