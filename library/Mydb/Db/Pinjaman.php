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
        $query->orwhere('cb.id_cabang = ?',$id_cabang);
        return $this->getAdapter()->fetchAll($query);
    }
    
     /**
     * 
     * @param type $id_user
     * @param type $id_cabang
     */
    public function getDataPinjamanAllCabang(){
        $query = $this->select();
        $query->from(array('pin'=>'pinjaman'),array('*'));
        $query->setIntegrityCheck(FALSE);
        $query->join(array('cos'=>'costumer'), 'pin.nik_costumer = cos.nik_costumer',array('nama'));
        $query->join(array('us'=>'user'), 'cos.id_user = us.id_user',array());
        $query->join(array('cb'=>'cabang'), 'us.id_cabang = cb.id_cabang',array('cabang'));
        return $this->getAdapter()->fetchAll($query);
    }
    
    public function getLastId(){
        $query = $this->select();
        $query->from($this->_name,array('id_pinjaman'));
        $query->order('id_pinjaman desc');
        return $this->getAdapter()->fetchOne($query);
    }
    
    public function cetakSPB($id_pinjaman){
        $query = $this->select();
        $query->from(array('pin'=>'pinjaman'),array('*'));
        $query->setIntegrityCheck(FALSE);
        $query->join(array('cos'=>'costumer'), 'pin.nik_costumer = cos.nik_costumer',array());
        $query->join(array('us'=>'user'), 'cos.id_user = us.id_user',array());
        $query->join(array('ken'=>'kendaraan'),'ken.no_polisi = pin.no_polisi',array());
        $query->columns(array('no_kontrak'),'pin');
        $query->columns(array('nama'),'cos');
        $query->columns(array('no_polisi'),'ken');
        $query->columns(array('merk'),'ken');
        $query->columns(array('tahun_pembuatan'),'ken');
        $query->columns(array('warna'),'ken');
        $query->columns(array('nama_bpkb'),'ken');      
        $query->columns(array('nilai_pinjaman'),'pin');
        $query->columns(array('angsuran_perbulan'),'pin');
        $query->columns(array('lama_angsuran'),'pin');
        $query->columns(array('tanggal_jatuh_tempo'),'pin');
        
        $query->where('pin.id_pinjaman = ?',$id_pinjaman);
        
        return $this->getAdapter()->fetchRow($query);
        
    }
    
}