<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Kendaraan
 */
class Mydb_Db_Kendaraan extends Mydb_Db_Abstract {

    protected $_name = 'kendaraan';
    protected $_primary = 'no_polisi';

    public function getAllKendaraanByCabang($id_user, $id_cabang) {
        $select = $this->select();
        $select->from(array('ken' => 'kendaraan'), array('*'));
        $select->setIntegrityCheck(false);
        $select->join(array('cos' => 'costumer'), 'cos.nik_costumer=ken.nik_costumer', array('id_cabang'));
        $select->join(array('us' => 'user'), 'us.id_user = cos.id_user', array('id_user'));
        $select->join(array('cb' => 'cabang'), 'cos.id_cabang = cb.id_cabang', array('cabang'));
        $select->where('us.id_user = ?', $id_user);
        $select->where('cb.id_cabang = ?', $id_cabang);

        return $this->getAdapterSelect()->fetchAll($select);
    }

    public function getAllKendaraan() {
        $select = $this->select();
        $select->from(array('ken' => 'kendaraan'), array('*'));
        $select->setIntegrityCheck(false);
        $select->join(array('cos' => 'costumer'), 'cos.nik_costumer=ken.nik_costumer', array('id_cabang'));
        $select->join(array('us' => 'user'), 'us.id_user = cos.id_user', array('id_user'));
        $select->join(array('cb' => 'cabang'), 'cos.id_cabang = cb.id_cabang', array('cabang'));
        return $this->getAdapterSelect()->fetchAll($select);
    }
    
    public function getNoPolisi($id_user = null){
        $select = $this->select();
        $select->from(array('ken' => 'kendaraan'),array('no_polisi','nik_costumer'));
        $select->setIntegrityCheck(false);
        $select->join(array('cos'=>'costumer'),'cos.nik_costumer = ken.nik_costumer',array());
        $select->join(array('pen'=>'penjamin'),'cos.nik_costumer = pen.nik_costumer',array());
       
        /*Jika Level Bukan SuperAdmin*/
        if(!empty($id_user)){
            $select->join(array('us'=>'user'),'cos.id_user = us.id_user',array());
            $select->join(array('cb'=>'cabang'),'cb.id_cabang = us.id_cabang');
            $select->where('us.id_user = ?',$id_user);
        }
        /*End */
        $select->where("ken.status != 'kredit'");
        return $this->getAdapterSelect()->fetchAll($select);
    }
    
    public function getKenCostum($no_polisi){
        $select = $this->select();
        $select->from(array('ken' => 'kendaraan'), array());
        $select->setIntegrityCheck(false);
        $select->join(array('cos'=>'costumer'),'cos.nik_costumer = ken.nik_costumer',array());
        $select->columns(array('nik_costumer'),'cos');
        $select->columns(array('nama'),'cos');
        $select->where('ken.no_polisi = ?',$no_polisi);
        return $this->getAdapterSelect()->fetchRow($select);
                
    }
}
