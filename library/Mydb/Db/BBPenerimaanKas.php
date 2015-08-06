<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_BBPenerimaanKas
 */
class Mydb_Db_BBPenerimaanKas extends Mydb_Db_Abstract {

    protected $_name = 'bb_penerimaan_kas';
    protected $_primary = 'id_kas';
    
    /**
     * 
     * @param type $awal
     * @param type $akhir
     * @return type Array;
     */
    public function getPenerimaanKas($awal,$akhir){
       $select = $this->select();
       $select->from(array('bbpk'=>$this->_name),array('*'));
       $select->setIntegrityCheck(false);
       $select->join(array('pin'=>'pinjaman'),'pin.no_kontrak = bbpk.no_kontrak ',array());
       $select->join(array('cos'=>'costumer'),'cos.nik_costumer= pin.nik_costumer ',array('nama'));
       $select->where('bbpk.tgl_bayar >= ?',$awal);
       $select->where('bbpk.tgl_bayar <= ?',$akhir);
       return $this->getAdapterSelect()->fetchAll( $select);
    }
    
}
