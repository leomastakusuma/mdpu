<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Laporan
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
    protected $_modelBBPenerimaanKas;
    protected $_modelBBPiutang;
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
        $this->_modelBBPenerimaanKas = Mydb::getModelBBPenerimaanKas();
        $this->_modelBBPiutang = Mydb::getModelBBPiutang();
        $this->id_user = $_SESSION[ 'dataLogin' ][ 'id_user' ];
        $this->id_cabang = $_SESSION[ 'dataLogin' ][ 'id_cabang' ];
    }

    public function index() {
        if ( ($_SESSION[ 'level' ] != 'akuntan' ) ) {
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
        if ( ($_SESSION[ 'level' ] != 'akuntan') && ($_SESSION[ 'level' ] != 'kasir') ) {
            $this->redirect( 'error/index/notAllowed' );
        }

        $no_kontrak = $this->_modelCostumer->getNoKontrak();
        $params = $this->getRequest();
        if ( !empty( $params[ 'params' ] ) ) {
            $nokontrak = array_shift( $params[ 'params' ] );
            $data = $this->_modelCostumer->getDetailPembayaran( $nokontrak );
            $angsuran = $this->_modelPembayaran->getAngsuranKe( $nokontrak );
            $lastAngsuran = $this->_modelPembayaran->getLastAngsuran( 0, $nokontrak );

            $last = $this->_modelPembayaran->getLastId() + 1;
            $data[ 'no_kwitansi' ] = generateKwintansi( $last );
            $data[ 'angsuran_ke' ] = !empty( $angsuran[ 'angsuran_ke' ] ) ? $angsuran[ 'angsuran_ke' ] + 1 : $angsuran[ 'angsuran_ke' ] + 1;

            /* Start Cek Tanggal Terakhir Bayar */
            if ( !empty( $lastAngsuran ) ) {
                $lastAngsuran = date( 'm', strtotime( $lastAngsuran[ 'tanggal_pembayaran' ] ) );
                if ( date( 'm' ) > $lastAngsuran ) {
                    if ( date( 'd' ) > $data[ 'tanggal_jatuh_tempo' ] ) {
                        $totaldate = date( 'd' ) - $data[ 'tanggal_jatuh_tempo' ];
                        $data[ 'denda' ] = $totaldate * ($data[ 'angsuran_perbulan' ] * 0.1);
                        $data[ 'potongan' ] = "00";
                        #$data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ] +  $data[ 'denda' ];
                        $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ];
                    } else {
                        $data[ 'denda' ] = '0,00';
                        $data[ 'potongan' ] = "0,00";
                        $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ];
                    }
                }if ( date( 'm' ) <= $lastAngsuran ) {
                    $data[ 'bayarTerakhir' ] = $lastAngsuran;
                    $data[ 'denda' ] = '0';
                    $data[ 'potongan' ] = 20000;
                    $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ] - 20000;
                }
            }
            /* End Cek Tanggal Pembayaran */

            /* Start Cek Belum Pernah Bayar */
            #Cek Kena denda
            elseif ( date( 'd' ) > $data[ 'tanggal_jatuh_tempo' ] ) {
                $totaldate = date( 'd' ) - $data[ 'tanggal_jatuh_tempo' ];
                $data[ 'denda' ] = $totaldate * ($data[ 'angsuran_perbulan' ] * 0.1);
                $data[ 'potongan' ] = "00";
                #$data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ] +  $data[ 'denda' ];
                $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ];
            }
            #Cek Tidak Kena Denda
            else {
                $data[ 'denda' ] = '00';
                $data[ 'potongan' ] = "00";
                $data[ 'total_bayar' ] = $data[ 'angsuran_perbulan' ];
            }
            /* End Cek Belum Pernah Bayar */

            /* Start Cek Denda Belum Dibayar */
            $GetLastDenda = $this->_modelKartuPiutang->getLastTotalDenda( $nokontrak );
            if ( !empty( $GetLastDenda[ 'sisa_denda' ] ) ) {
                $data[ 'denda_sebelumnya' ] = isFloatNum( $GetLastDenda[ 'sisa_denda' ] );
            } else {
                $data[ 'denda_sebelumnya' ] = rupiah( '0' );
            }
            $data[ 'denda_terhitung' ] = $data[ 'denda' ] + $data[ 'denda_sebelumnya' ];
            /* Cek Denda Belum Dibayar */
        }
        require UD . 'header.html';
        require APP_MODUL . '/laporan/form/form-kartupiutang.phtml';
        require UD . 'footer.html';
    }

    public function save() {
        if ( ($_SESSION[ 'level' ] != 'superadmin') && ($_SESSION[ 'level' ] != 'kasir') ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        $form = $this->getPost();
        $form[ 'denda' ] = $form[ 'jumlah_denda' ]; #untuk Denda Perbulan
        $form[ 'tanggal_pembayaran' ] = date( 'Y-m-d' );

        $dataCetak[ 'no_kwitansi' ] = $form[ 'no_kwitansi' ];
        $dataCetak[ 'no_kontrak' ] = $form[ 'no_kontrak' ];
        $dataCetak[ 'nama' ] = $form[ 'nama' ];
        $dataCetak[ 'no_polisi' ] = $form[ 'no_polisi' ];
        $dataCetak[ 'jumlah_angsuran' ] = $form[ 'angsuran_perbulan' ];
        $dataCetak[ 'angsuran_ke' ] = $form[ 'angsuran_ke' ];
        $dataCetak[ 'denda' ] = $form[ 'denda' ];

        if ( !empty( $form[ 'denda_sebelumnya' ] ) ) {
            $dataKp[ 'denda_terhitung' ] = isFloatNum( $form[ 'denda_sebelumnya' ] ) - $form[ 'denda' ];
        } else {
            
        }

        /* Field For Insert Into Kartu Piutang */
        $dataKP[ 'no_kontrak' ] = $form[ 'no_kontrak' ];
        $dataKP[ 'no_kwitansi' ] = $form[ 'no_kwitansi' ];
        $dataKP[ 'angsuran_ke' ] = $form[ 'angsuran_ke' ];
        $dataKP[ 'tagihan' ] = $form[ 'angsuran_perbulan' ];
        $dataKP[ 'pembayaran' ] = $form[ 'angsuran_perbulan' ];
        $dataKP[ 'potongan' ] = $form[ 'potongan' ];
        $dataKP[ 'telat' ] = $form[ 'telat_bayar' ];
        $dataKP[ 'denda_terhitung' ] = $form[ 'denda_total' ];

        $dataKP[ 'denda_dibayar' ] = rupiah( $form[ 'denda_dibayar' ] );
        $sisaDenda = isFloatNum( $form[ 'denda_total' ] ) - isFloatNum( $form[ 'denda_dibayar' ] );

        $dataKP[ 'sisa_denda' ] = rupiah( $sisaDenda );
        $dataKP[ 'tanggal_bayar_angsuran' ] = new Zend_Db_Expr( 'NOW()' );
        if ( !empty( $dataKP[ 'denda_dibayar' ] ) ) {
            $dataKP[ 'tanggal_bayar_denda' ] = new Zend_Db_Expr( 'NOW()' );
        }
        /* End Field */
        unset( $form[ 'nama' ] );
        unset( $form[ 'no_polisi' ] );
        unset( $form[ 'denda_sebelumnya' ] );
        unset( $form[ 'denda_total' ] );
        unset( $form[ 'bayar' ] );
        unset( $form[ 'kembalian' ] );
        unset( $form[ 'jumlah_denda' ] );
        unset( $form[ 'telat_bayar' ] );
        unset( $form[ 'denda_dibayar' ] );


        try {
            #Insert Into Table Pembayaran
            $this->_modelPembayaran->insert( $form );
            #Insert Into Table Kartu Piutang
            $this->_modelKartuPiutang->insert( $dataKP );

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
        if ( empty( $data ) ) {
            $this->redirect( 'error' );
        }
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

    public function KartuPiutang( $nopos = null ) {
        if ( $_SESSION[ 'level' ] != 'akuntan' ) {
            $this->redirect( 'error/index/notAllowed' );
        }

        $no_kontrak = $this->_modelCostumer->getNoKontrak();
        $params = $this->getRequest();
        if ( !empty( $params[ 'params' ] ) ) {
            $nokontrak = array_shift( $params[ 'params' ] );
            $data = $this->_modelCostumer->getDetailPembayaran( $nokontrak );
            $angsuran = $this->_modelPembayaran->getAngsuranKe( $nokontrak );
            $lastAngsuran = $this->_modelPembayaran->getLastAngsuran( 0, $nokontrak );

            $last = $this->_modelPembayaran->getLastId() + 1;
            $data[ 'no_kwitansi' ] = generateKwintansi( $last );
            $data[ 'angsuran_ke' ] = !empty( $angsuran[ 'angsuran_ke' ] ) ? $angsuran[ 'angsuran_ke' ] + 1 : $angsuran[ 'angsuran_ke' ] + 1;
        }
        require UD . 'header.html';
        require APP_MODUL . '/laporan/form/form-kartupiutang.phtml';
        require UD . 'footer.html';
    }

    public function cariKP() {
        $form = $this->getPost();
        if ( empty( $form[ 'no_kontrak' ] ) ) {
            $this->redirect( 'error' );
        }
        $no_kontrak = $form[ 'no_kontrak' ];
        $dataCetak = $this->_modelKartuPiutang->getKartuPiutang( $no_kontrak );
        require UD . 'header.html';
        require APP_MODUL . '/laporan/view/kartupiutang.phtml';
        require UD . 'footer.html';
    }

    public function cetaKP() {
        $params = $this->getRequest();
        if ( !empty( $params[ 'params' ] ) ) {
            $nokontrak = array_shift( $params[ 'params' ] );
            $dataCetak = $this->_modelKartuPiutang->getKartuPiutang( $nokontrak );
            require APP_MODUL . '/laporan/view/cetakkartupiutang.phtml';
        }
    }

    public function kas() {
        if ( $_SESSION[ 'level' ] != 'akuntan' ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        require UD . 'header.html';
        require APP_MODUL . '/laporan/form/form-penerimaan-kas.phtml';
        require UD . 'footer.html';
    }

    public function cariKas() {
        if ( $_SESSION[ 'level' ] != 'akuntan' ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        $form = $this->getPost();
        $awal = $form[ 'Tanggal' ];
        $akhir = $form[ 'Sampai' ];
        $dataCetak = $this->_modelBBPenerimaanKas->getPenerimaanKas( $awal, $akhir );
        if ( !empty( $dataCetak ) ) {
            require UD . 'header.html';
            require APP_MODUL . '/laporan/view/penerimaan-kas.phtml';
            require UD . 'footer.html';
        } else {
            $this->redirect( 'error' );
        }
    }

    public function cetakKas() {
        $params = $this->getRequest();
        $awal = $params['params'][0];
        $akhir = $params['params'][1];
        $dataCetak = $this->_modelBBPenerimaanKas->getPenerimaanKas( $awal, $akhir );
        require APP_MODUL . '/laporan/view/cetak-penerimaan-kas.phtml';
    }

    public function piutang() {
        if ( $_SESSION[ 'level' ] != 'akuntan' ) {
            $this->redirect( 'error/index/notAllowed' );
        }
        require UD . 'header.html';
        require APP_MODUL . '/laporan/form/form-bb-piutang.phtml';
        require UD . 'footer.html';
        
    }
    
    public function cariPiutang(){
        $form = $this->getPost();
        $awal = $form[ 'Tanggal' ];
        $akhir = $form[ 'Sampai' ];
        $dataCetak = $this->_modelBBPiutang->getBBPiutang( $awal, $akhir );
        if ( !empty( $dataCetak ) ) {
            require UD . 'header.html';
            require APP_MODUL . '/laporan/view/bb-piutang.phtml';
            require UD . 'footer.html';
        } else {
            $this->redirect( 'error' );
        }
    }
    
    public function cetakPiutang(){
        $params = $this->getRequest();
        $awal = $params['params'][0];
        $akhir = $params['params'][1];
        $dataCetak = $this->_modelBBPiutang->getBBPiutang( $awal, $akhir );
        require APP_MODUL . '/laporan/view/cetak-bb-piutang.phtml';
    }
}
