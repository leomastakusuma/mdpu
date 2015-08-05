<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Costumer
 */

class Mydb_Db_Costumer extends Mydb_Db_Abstract{
    
    protected $_name = 'costumer';
    protected $_primary = 'nik_costumer';
    
    public function getAllCostumerByCabang($cabang = null,$id=null){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->columns(array('nik_costumer'),'cos');
        $select->columns(array('nama'),'cos');
        $select->columns(array('alamat'),'cos');
        $select->columns(array('jenis_kelamin'),'cos');
        $select->columns(array('tempat_lahir'),'cos');
        $select->columns(array('tanggal_lahir'),'cos');
        $select->columns(array('nama_ibu'),'cos');
        $select->columns(array('agama'),'cos');
        $select->columns(array('status'),'cos');
        $select->columns(array('pekerjaan'),'cos');
        $select->columns(array('alamat_tempat_kerja'),'cos');
        $select->columns(array('hp'),'cos');
        $select->columns(array('telpon'),'cos');      
        
        $select->join(array('us'=>'user'), 'cos.id_user=us.id_user',array('realname'));
        $select->join(array('cb'=>'cabang'), 'us.id_cabang = cb.id_cabang',array());
        if(!empty($id)){
            $select->where('cos.id_user = ?',$id);
        }if(!empty($cabang)){
            $select->where('cos.id_cabang = ?',$cabang);
        }
               
        return $this->getAdapter()->fetchAll($select);
       
    }
    public function getAllCostumer(){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->columns(array('id_costumer'),'cos');
        $select->columns(array('nik_costumer'),'cos');
        $select->columns(array('nama'),'cos');
        $select->columns(array('alamat'),'cos');
        $select->columns(array('jenis_kelamin'),'cos');
        $select->columns(array('tempat_lahir'),'cos');
        $select->columns(array('tanggal_lahir'),'cos');
        $select->columns(array('nama_ibu'),'cos');
        $select->columns(array('agama'),'cos');
        $select->columns(array('status'),'cos');
        $select->columns(array('pekerjaan'),'cos');
        $select->columns(array('alamat_tempat_kerja'),'cos');
        $select->columns(array('hp'),'cos');
        $select->columns(array('telpon'),'cos');      
        
        $select->join(array('us'=>'user'), 'cos.id_user=us.id_user',array('realname'));
        $select->join(array('cb'=>'cabang'), 'cb.id_cabang = cos.id_cabang',array('cabang'));
        
        return $this->getAdapter()->fetchAll($select);
       
    }
    
    public function getCostumer($id){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->columns(array('nik_costumer'),'cos');
        $select->columns(array('nama'),'cos');
        $select->columns(array('alamat'),'cos');
        $select->columns(array('jenis_kelamin'),'cos');
        $select->columns(array('tempat_lahir'),'cos');
        $select->columns(array('tanggal_lahir'),'cos');
        $select->columns(array('nama_ibu'),'cos');
        $select->columns(array('agama'),'cos');
        $select->columns(array('status'),'cos');
        $select->columns(array('pekerjaan'),'cos');
        $select->columns(array('alamat_tempat_kerja'),'cos');
        $select->columns(array('hp'),'cos');
        $select->columns(array('telpon'),'cos');      
        
        $select->join(array('us'=>'user'), 'cos.id_user=us.id_user',array('realname'));
        $select->join(array('cb'=>'cabang'), 'us.id_cabang = cb.id_cabang',array('cabang'));
        
        $select->where('cos.nik_costumer = ?',$id);
        return $this->getAdapter()->fetchRow($select);
    }
    /**
     * 
     * @param type $nik_costumer
     */
    public function getPenjaminCostumer($nik_costumer){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->join(array('penj'=>'penjamin'),'penj.nik_costumer = cos.nik_costumer',array('*'));
        $select->where('cos.nik_costumer = ?',$nik_costumer);
        return $this->getAdapterSelect()->fetchAll($select);
        
        
    }
    
   /* public function getNoKontrak(){
        $select = $this->select();
        $select->from($this->_name,array('nik_costumer'));
        return $this->getAdapterSelect()->fetchAll($select);
    }
    */
    
    public function getNoKontrak(){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->join(array('pinj'=>'pinjaman'), 'pinj.nik_costumer =  cos.nik_costumer',array());
        $select->join(array('kend'=>'kendaraan'),'kend.no_polisi = pinj.no_polisi',array());
        $select->columns(array('no_kontrak'),'pinj');
        $select->columns(array('lama_angsuran'),'pinj');
        return $this->getAdapterSelect()->fetchAll($select);
    }
    
    public function getDetailPembayaran($no_kontrak){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->join(array('pinj'=>'pinjaman'), 'pinj.nik_costumer =  cos.nik_costumer',array());
        $select->join(array('kend'=>'kendaraan'),'kend.no_polisi = pinj.no_polisi',array());
        $select->join(array('cab'=>'cabang'),'cab.id_cabang = cos.id_cabang',array('cabang'));
        $select->columns(array('no_kontrak'),'pinj');
        $select->columns(array('nama'),'cos');
        $select->columns(array('no_polisi'),'kend');
        $select->columns(array('angsuran_perbulan'),'pinj');
        $select->columns(array('tanggal_jatuh_tempo'),'pinj');
        $select->where('pinj.no_kontrak = ?',$no_kontrak);
        $select->group('pinj.no_kontrak');
        return $this->getAdapterSelect()->fetchRow($select);
    }
    
    public function getCabangCostumer($no_kontrak){
        $select = $this->select();
        $select->from(array('cos'=>$this->_name),array());
        $select->setIntegrityCheck(false);
        $select->join(array('pinj'=>'pinjaman'), 'pinj.nik_costumer =  cos.nik_costumer',array());
        $select->join(array('cab'=>'cabang'),'cos.id_cabang = cab.id_cabang');
        $select->columns(array('id_cabang'),'cab');
        $select->columns(array('cabang'),'cab');
        $select->where('pinj.no_kontrak = ?',$no_kontrak);
        return $this->getAdapterSelect()->fetchRow($select);
    }

}
