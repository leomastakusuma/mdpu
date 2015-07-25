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

    
    public function getLastTotalDenda($no_kontrak){
        $select = $this->select();
        $select->from($this->_name,array('sisa_denda'));
        $select->where('no_kontrak = ?',$no_kontrak);
        $select->order('id_piutang desc');
        return $this->getAdapterSelect()->fetchRow($select);
    }
    
    
}
