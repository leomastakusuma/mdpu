<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Penjamin
 */

class Mydb_Db_Penjamin extends Mydb_Db_Abstract{
    
    protected $_name = 'penjamin';
    protected $_primary = 'nik_penjamin';
    
    public function getPenjaminByCabang($id_user,$id_cabang){
        $select = $this->select();
        $select->from(array('pe'=>'penjamin'),array('*'));
        $select->setIntegrityCheck(FALSE);
        $select->join(array('cos'=>'costumer'), 'pe.nik_costumer = cos.nik_costumer',array('id_cabang','id_user'));
        $select->join(array('us'=>'user'), 'us.id_user = cos.id_user',array());
        $select->join(array('cb'=>'cabang'),'cb.id_cabang = cos.id_cabang',array('cabang'));
        $select->where('us.id_user= ?',$id_user);
        $select->where('cb.id_cabang = ?',$id_cabang);
        return $this->getAdapterSelect()->fetchAll($select);
        
    }
    
}
