<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Pembayaran
 */
class Mydb_Db_Pembayaran extends Mydb_Db_Abstract {

    protected $_name = 'pembayaran';
    protected $_primary = 'id_pembayaran';

    public function getAngsuranKe($no_kontrak) {
        $select = $this->select();
        $select->from(array('pemb' => 'pembayaran'), array('angsuran_ke'));
        $select->where('no_kontrak = ? ', $no_kontrak);
        $select->order('id_pembayaran desc');
        return $this->getAdapter()->fetchRow($select);
    }

    public function getDataAnsuran($id_cabang) {
        $select = $this->select();
        $select->from(array('pemb' => 'pembayaran'), array());
        $select->setIntegrityCheck(false);
        $select->join(array('pinj' => 'pinjaman'), 'pinj.no_kontrak = pemb.no_kontrak', array());
        $select->join(array('cos' => 'costumer'), 'cos.nik_costumer =  pinj.nik_costumer', array());
        $select->join(array('cab' => 'cabang'), 'cos.id_cabang = cab.id_cabang', array());
        $select->join(array('kend' => 'kendaraan'), 'kend.no_polisi= pinj.no_polisi', array());

        $select->columns(array('nama'), 'cos');
        $select->columns(array('nik_costumer'), 'cos');

        $select->columns(array('id_pinjaman'), 'pinj');
        $select->columns(array('no_kontrak'), 'pinj');
        $select->columns(array('nilai_pinjaman'), 'pinj');
        $select->columns(array('lama_angsuran'), 'pinj');

        $select->columns(array('no_polisi'), 'kend');
        $select->where('cab.id_cabang = ?', $id_cabang);

        $select->order('pemb.angsuran_ke desc');
        $select->group('pemb.no_kontrak');

        return $this->getAdapter()->fetchAll($select);
    }

    public function getDetailAngsuran($id_pinjaman) {
        $select = $this->select();
       
        $select->from(array('pemb' => 'pembayaran'), array('*'));
        $select->setIntegrityCheck(false);
        $select->join(array('pinj' => 'pinjaman'), 'pinj.no_kontrak = pemb.no_kontrak', array());
        $select->join(array('kp' => 'kartu_piutang'), 'pinj.no_kontrak = kp.no_kontrak', array('*'));
        $select->where('pinj.id_pinjaman = ?', $id_pinjaman);
        $select->group(array("kp.no_kwitansi"));
        $select->order('kp.no_kwitansi desc');

        return $this->getAdapter()->fetchAll($select);
    }

    public function getLastAngsuran($id_pinjaman = null,$no_kontrak=null) {
        $select = $this->select();
        $select->from(array('pemb' => 'pembayaran'), array());
        $select->setIntegrityCheck(false);
        $select->join(array('pinj' => 'pinjaman'), 'pinj.no_kontrak = pemb.no_kontrak', array());
        $select->join(array('cos' => 'costumer'), 'pinj.nik_costumer = cos.nik_costumer', array());
        $select->columns(array('nama'), 'cos');
        $select->columns(array('nik_costumer'), 'cos');
        
        $select->columns(array('angsuran_ke'), 'pemb');
        $select->columns(array('tanggal_pembayaran'), 'pemb');
        $select->columns(array('no_kontrak'), 'pinj');
        $select->columns(array('nilai_pinjaman'), 'pinj');
        $select->columns(array('angsuran_perbulan'), 'pinj');
        $select->columns(array('lama_angsuran'), 'pinj');
        if(!empty($id_pinjaman)){
            $select->where('pinj.id_pinjaman = ?', $id_pinjaman);
        }else{
             $select->where('pemb.no_kontrak = ?', $no_kontrak);
        }
        
        $select->order('id_pembayaran desc');
        return $this->getAdapter()->fetchRow($select);
    }
    
    public function getLastId(){
        $query = $this->select();
        $query->from($this->_name,array('id_pembayaran'));
        $query->order('id_pembayaran desc');
        return $this->getAdapter()->fetchOne($query);
    }
    
    public function cetakKW($no_kwitansi){
        $select  = $this->select();
        $select->from(array('pemb' => 'pembayaran'), array());
        $select->setIntegrityCheck(false);
        $select->join(array('pinj' => 'pinjaman'), 'pinj.no_kontrak = pemb.no_kontrak', array());
        $select->join(array('kend' => 'kendaraan'), 'kend.no_polisi= pinj.no_polisi', array());
        $select->join(array('cos' => 'costumer'), 'pinj.nik_costumer = cos.nik_costumer', array());
        $select->columns(array('no_kwitansi'),'pemb');
        $select->columns(array('no_kontrak'),'pinj');
        $select->columns(array('nama'),'cos');
        $select->columns(array('no_polisi'),'kend');
        $select->columns(array('jumlah_angsuran'=>'angsuran_perbulan'),'pemb');
        $select->columns(array('angsuran_ke'),'pemb');
        $select->columns(array('denda'),'pemb');
        $select->columns(array('total_bayar'),'pemb');
        $select->columns(array('potongan'),'pemb');
        
        $select->where('pemb.no_kwitansi = ?',$no_kwitansi);
        return $this->getAdapter()->fetchRow($select);
    }
}
