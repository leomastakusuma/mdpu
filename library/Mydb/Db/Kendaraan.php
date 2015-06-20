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

}
