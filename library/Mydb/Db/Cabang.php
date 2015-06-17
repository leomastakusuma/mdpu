<?php
/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Cabang
 */


class Mydb_Db_Cabang extends Mydb_Db_Abstract {
    protected $_name = 'cabang';
    protected $_primary = 'id_cabang';
    
    
    
    public function getAllCabang(){
        $select = $this->select();
        $select->from($this->_name,array('*'));
        $select->order('id_cabang desc');
        return $this->getAdapterSelect()->fetchAll($select);
                
    }
    
    public function getCabang(){
        $select = $this->select();
        $select->from($this->_name,array());
        $select->columns('id_cabang');
        $select->columns('provinsi');
        $select->columns('kota');
        $select->order('id_cabang desc');
        return $this->getAdapterSelect()->fetchAll($select);
    }
}