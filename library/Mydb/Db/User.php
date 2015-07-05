<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_User
 */
class Mydb_Db_User extends Mydb_Db_Abstract {

    protected $_name = 'user';
    protected $_primary = 'id_user';

    /**
     * @param type $name Description
     */
    public function getAllUser() {
        $select = $this->select();
        $select->from($this->_name, array('*'));
        $select->setIntegrityCheck(false);
        $select->join(array('cb'=>'cabang'), 'cb.id_cabang =user.id_cabang ');
        $select->columns(array('cabang'),'cb');
        $select->where('level != ?', 'superadmin');
        $select->order('id_user desc');
        return $this->getAdapterSelect()->fetchAll($select);
    }
    
    public function login($username, $password){
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from($this->_name,array('*'));
        $select->join('cabang', 'cabang.id_cabang = '.$this->_name.'.id_cabang',array('*'));
        $select->where($this->_name.'.username = ?',$username );
        $select->where($this->_name.'.password = ?',$password );
        return $this->getAdapterSelect()->fetchRow($select);
    }
    
    public function ceklogin($iduser){
        $select = $this->select();
        $select->from($this->_name,array('*'));
        $select->setIntegrityCheck(FALSE);
        $select->join('user_login', 'user_login.id_user = '.$this->_name.'.id_user',array('*'));
        $select->join('cabang','cabang.id_cabang = '.$this->_name.'.id_cabang',array('*') );
        $select->where($this->_name.'.id_user = ?',$iduser);
        return $this->getAdapterSelect()->fetchRow($select);
    }
    
    public function profile($id){
        $select = $this->select();
        $select->from($this->_name,array('*'));
        $select->setIntegrityCheck(false);
        $select->join('cabang', 'cabang.id_cabang = '.$this->_name.'.id_cabang');
        $select->where($this->_name.'.id_user = ?',$id);
        return $this->getAdapterSelect()->fetchRow($select);
    }
    
    public function getKasirName($id_cabang){
        $select = $this->select();
        $select->from($this->_name,array('realname'));
        $select->where("level = 'kasir'");
        $select->where($this->_name.'.id_cabang = ?',$id_cabang);
        return $this->getAdapter()->fetchRow($select);
    }
}
