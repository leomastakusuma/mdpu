<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_BBPiutang
 */
class Mydb_Db_BBPiutang extends Mydb_Db_Abstract {

    protected $_name = 'bb_piutang';
    protected $_primary = 'id_piutang';

    public function getSumTotalSaldo( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'bbp' => 'bb_piutang' ), array( 'bbp.saldo' ) );
        $select->where( 'bbp.no_kontrak = ?', $no_kontrak );
        $select->order( 'bbp.id_piutang desc' );
        return $this->getAdapterSelect()->fetchRow( $select );
    }

    public function getSaldoLastYearMonth( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'bbp' => 'bb_piutang' ), array('*') );
        $select->where( 'bbp.no_kontrak = ?', $no_kontrak );
        return $this->getAdapterSelect()->fetchAll( $select );
    }
    /**
     * 
     * @param type $awal
     * @param type $akhir
     * @param type $cabang as kondisi pimpinan
     * @return type
     */
    public function getBBPiutang($awal,$akhir, $cabang = false){
       $select = $this->select();
       $select->from(array('bbp'=>$this->_name),array('*'));
       if($cabang){
          $select->join(array('pinj'=>'pinjaman'),'pinj.no_kontrak = bbp.no_kontrak',array());
          $select->join(array('cos'=>'costumer'),'cos.nik_costumer = pinj.nik_costumer',array());
          $select->join(array('cab'=>'cabang'),'cab.id_cabang= cos.id_cabang',array());
          $select->where('cos.id_cabang = ? ',$cabang);
       }
       $select->where('bbp.tanggal >= ?',$awal);
       $select->where('bbp.tanggal <= ?',$akhir);
       return $this->getAdapterSelect()->fetchAll( $select);
    
    }
}