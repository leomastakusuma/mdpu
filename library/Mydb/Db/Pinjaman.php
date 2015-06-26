<?php
/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Pinjaman
 */

class Mydb_Db_Pinjaman extends Mydb_Db_Abstract{
    
    protected $_name = 'pinjaman';
    protected $_primary = 'no_kontrak';
    
    /**
     * 
     * @param type $id_user
     * @param type $id_cabang
     */
    public function getDataPinjamanByCabang($id_user,$id_cabang){
        $query = $this->select();
        $query->from(array('pin'=>'pinjaman'),array('*'));
        $query->setIntegrityCheck(FALSE);
        $query->join(array('cos'=>'costumer'), 'pin.nik_costumer = cos.nik_costumer',array('nama'));
        $query->join(array('us'=>'user'), 'cos.id_user = us.id_user',array());
        $query->join(array('cb'=>'cabang'), 'us.id_cabang = cb.id_cabang',array());
        $query->where('us.id_user = ?',$id_user);
        $query->where('cb.id_cabang = ?',$id_cabang);
        return $this->getAdapter()->fetchAll($query);
    }
    
}