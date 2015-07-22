<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Pembayaran
 * @subpackage Controller
 * @filesource IndexController
 */
class IndexController extends Controller {

    protected $_modelCostumer;
    protected $_modelKendaraan;
    protected $_modelPinjaman;
    protected $_modelSPB;
    protected $_modelCabang;
    protected $_modelUser;
    protected $_modelPembayaran;
    protected $_modelKartuPiutang;
    public $id_user;
    public $id_cabang;

    public function __construct() {
        Auth::handleLogin();
        $this->_modelCostumer = Mydb::getModelCostumer();
        $this->_modelPinjaman = Mydb::getModelPinjaman();
        $this->_modelCabang = Mydb::getModelCabang();
        $this->_modelSPB = Mydb::getModelSPB();
        $this->_modelUser = Mydb::getModelUser();
        $this->_modelKendaraan = Mydb::getModelKendaraan();
        $this->_modelPembayaran = Mydb::getModelPembayaran();
        $this->_modelKartuPiutang = Mydb::getModelKartuPiutang();
        $this->id_user = $_SESSION[ 'dataLogin' ][ 'id_user' ];
        $this->id_cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
    }

    public function index() {
        if ( ($_SESSION[ 'level' ] != 'kasir' ) ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        require UD . 'headerDataTables.phtml';
        $where = $this->_modelCabang->getAdapter()->quoteInto( 'id_cabang = ? ', $this->id_cabang );
        $cabang = $this->_modelCabang->fetchRow( $where );
        if ( !$cabang ) {
            $this->redirect( 'error' );
        }
        $this->id_cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
        $data = $this->_modelPembayaran->getDataAnsuran( $this->id_cabang );

        require APP_MODUL . '/pembayaran/view/dataPembayaran.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function add( $nopos = null ) {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'kasir') ) {
            $this->redirect( 'error/index/notAllowed' );
        }

        $no_kontrak = $this->_modelCostumer->getNoKontrak();
        $params = $this->getRequest();
        if ( !empty( $params[ 'params' ] ) ) {
            $nokontrak = array_shift( $params[ 'params' ] );
            $data = $this->_modelCostumer->getDetailPembayaran( $nokontrak );
            $angsuran = $this->_modelPembayaran->getAngsuranKe( $nokontrak );
            $lastAngsuran = $this->_modelPembayaran->getLastAngsuran( 0, $nokontrak );
            $lastAngsuran = date( 'm', strtotime( $lastAngsuran[ 'tanggal_pembayaran' ] ) );
            $last = $this->_modelPembayaran->getLastId() + 1;
            $data[ 'no_kwitansi' ] = generateKwintansi( $last );
            $data[ 'angsuran_ke' ] = !empty( $angsuran[ 'angsuran_ke' ] ) ? $angsuran[ 'angsuran_ke' ] + 1 : $angsuran[ 'angsuran_ke' ] + 2;
            /* Start Cek Tanggal Terakhir Bayar */
            if ( !empty( $lastAngsuran ) ) {
                /* Start Cek Bulan Kemarin */
                if ( date( 'm' ) > $lastAngsuran ) {
                    if ( date( 'd' ) > $data[ 'tanggal_jatuh_tempo' ] ) {
                        $totaldate = date( 'd' ) - $data[ 'tanggal_jatuh_tempo' ];
                        $data[ 'denda' ] = $totaldate * 10000;
                        $data[ 'potongan' ] = "00";

                        $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ] + ($totaldate * 10000);
                    } else {
                        $data[ 'denda' ] = '00';
                        $data[ 'potongan' ] = "00";
                        $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ];
                    }
                }if ( date( 'm' ) <= $lastAngsuran ) {
                    $data['bayarTerakhir'] = $lastAngsuran;
                    $data[ 'denda' ] = '00';
                    $data[ 'potongan' ] = 20000;
                    $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ] - 20000;
                }
            }
            /* End Cek Tanggal Pembayaran */
            /* Start Cek Belum Pernah Bayar */
            #Cek Kena denda
            elseif ( date( 'd' ) > $data[ 'tanggal_jatuh_tempo' ] ) {
                $totaldate = date( 'd' ) - $data[ 'tanggal_jatuh_tempo' ];
                $data[ 'denda' ] = $totaldate * 10000;
                $data[ 'potongan' ] = "00";

                $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ] + ($totaldate * 10000);
            }
            #Cek Tidak Kena Denda
            else {
                $data[ 'denda' ] = '00';
                $data[ 'potongan' ] = "00";
                $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ];
            }
            /* End Cek Belum Pernah Bayar */
        }

        require UD . 'header.html';
        require APP_MODUL . '/pembayaran/form/form-pembayaran.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'kasir') ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        $form = $this->getPost();
        $form[ 'tanggal_pembayaran' ] = date( 'Y-m-d' );

        $dataCetak[ 'no_kwitansi' ] = $form[ 'no_kwitansi' ];
        $dataCetak[ 'no_kontrak' ] = $form[ 'no_kontrak' ];
        $dataCetak[ 'nama' ] = $form[ 'nama' ];
        $dataCetak[ 'no_polisi' ] = $form[ 'no_polisi' ];
        $dataCetak[ 'jumlah_angsuran' ] = $form[ 'angsuran_perbulan' ];
        $dataCetak[ 'angsuran_ke' ] = $form[ 'angsuran_ke' ];
        $dataCetak[ 'denda' ] = $form[ 'denda' ];
        unset( $form[ 'nama' ] );
        unset( $form[ 'no_polisi' ] );


        try {
            $this->_modelPembayaran->insert( $form );
            require UD . 'header.html';
            $id_cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
            $kasirname = $this->_modelUser->getKasirName( $id_cabang );
            $data[ 'realname' ] = $kasirname[ 'realname' ];
            require APP_MODUL . '/pembayaran/view/kwitansi.phtml';
            require UD . 'footer.html';
        } catch ( Exception $ex ) {
            echo $ex->getMessage();
        }
    }

    public function all() {
        if ( ($_SESSION[ 'level' ] != 'superadmin' ) ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        require UD . 'headerDataTables.phtml';
        $where = $this->_modelCabang->getAdapter()->quoteInto( 'id_cabang = ? ', $this->id_cabang );
        $cabang = $this->_modelCabang->fetchRow( $where );
        if ( !$cabang ) {
            $this->redirect( 'error' );
        }
        $data = $this->_modelPinjaman->getDataPinjamanAllCabang();
        foreach ( $data as $key => $val ) {
            $no_spb = $val[ 'no_kontrak' ];
            $where = $this->_modelSPB->getAdapter()->quoteInto( 'no_kontrak = ?', $no_spb );
            $spb = $this->_modelSPB->fetchRow( $where );
            $data[ $key ][ 'spb' ] = $spb->no_spb;
        }
        require APP_MODUL . '/pinjaman/view/dataPinjamanAll.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function delete( $id_pinjaman ) {
        echo $id_pinjaman;
    }

    public function edit( $id_pinjaman ) {
        echo $id_pinjaman;
    }

    public function detail( $id_pinjaman ) {
        require UD . 'headerDataTables.phtml';
        $where = $this->_modelCabang->getAdapter()->quoteInto( 'id_cabang = ? ', $this->id_cabang );
        $cabang = $this->_modelCabang->fetchRow( $where );
        if ( !$cabang ) {
            $this->redirect( 'error' );
        }
        $this->id_cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
        $data = $this->_modelPembayaran->getDetailAngsuran( $id_pinjaman );
        $detailCostumer = $this->_modelPembayaran->getLastAngsuran( $id_pinjaman, 0 );
        $detailCostumer[ 'sisa_angsuran' ] = $detailCostumer[ 'lama_angsuran' ] - $detailCostumer[ 'angsuran_ke' ];
        $detailCostumer[ 'sisa_pinjaman' ] = $detailCostumer[ 'nilai_pinjaman' ] - ($detailCostumer[ 'angsuran_ke' ] * $detailCostumer[ 'angsuran_perbulan' ]);
        require APP_MODUL . '/pembayaran/view/dataDetailPembayaran.phtml';
        require UD . 'footerDataTables.phtml';
    }

    public function cetakKwitansi() {
        $params = $this->getRequest();
        $no_kwitansi = array_shift( $params[ 'params' ] );
        if ( empty( $no_kwitansi ) ) {
            $this->redirect( 'error/index/error' );
        }
        $dataCetak = $this->_modelPembayaran->cetakKW( $no_kwitansi );
        $id_cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
        $kasirname = $this->_modelUser->getKasirName( $id_cabang );
        $data[ 'realname' ] = $kasirname[ 'realname' ];
        require APP_MODUL . '/pembayaran/view/Cetakkwitansi.phtml';
    }

}
