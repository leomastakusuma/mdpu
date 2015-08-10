<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_KartuPiutang
 */
class Mydb_Db_KartuPiutang extends Mydb_Db_Abstract {

    protected $_name = 'kartu_piutang';
    protected $_primary = 'id_piutang';

    public function getLastTotalDenda( $no_kontrak ) {
        $select = $this->select();
        $select->from( $this->_name, array( 'sisa_denda' ) );
        $select->where( 'no_kontrak = ?', $no_kontrak );
        $select->order( 'id_piutang desc' );
        return $this->getAdapterSelect()->fetchRow( $select );
    }
    
    /**
     * 
     * @param type $no_kontrak
     * @return type array of total debit 
     */
    public function getSumTotalAngsuran( $no_kontrak ) {
        $select = $this->select();
        #$select->from( array( 'kp' => 'kartu_piutang' ), array( 'kp.pembayaran' ) );
        $select->from( array( 'kp' => 'kartu_piutang' ), array(new Zend_Db_Expr("SUM(REPLACE(FORMAT(kp.pembayaran,3),'.','')) AS  total_pembayaran")) );
        $select->where( 'kp.no_kontrak = ?', $no_kontrak );
        return $this->getAdapterSelect()->fetchRow( $select );
    }


    public function getKartuPiutang( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'kp' => 'kartu_piutang' ), array( '*' ) );
        $select->setIntegrityCheck( false );
        $select->join( array( 'pinj' => 'pinjaman' ), 'pinj.no_kontrak = kp.no_kontrak', array( 'lama_angsuran','tanggal_jatuh_tempo','nilai_pinjaman','tanggal' ) );
        $select->join( array( 'cos' => 'costumer' ), 'cos.nik_costumer = pinj.nik_costumer', array( '*' ) );
        $select->join( array( 'penj' => 'penjamin' ), 'cos.nik_costumer = penj.nik_costumer', array() );
        $select->join( array( 'kend' => 'kendaraan' ), 'cos.nik_costumer = kend.nik_costumer', array( '*' ) );
        $select->columns(array('nmpenjamin'=>'nama'),'penj');
        $select->columns(array('alamatbpkb'=>'alamat'),'kend');
        $select->where( 'kp.no_kontrak = ?', $no_kontrak );
        return $this->getAdapterSelect()->fetchAll( $select );
    }

}
