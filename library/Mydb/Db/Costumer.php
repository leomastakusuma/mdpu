<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_Costumer
 */
class Mydb_Db_Costumer extends Mydb_Db_Abstract {

    protected $_name = 'costumer';
    protected $_primary = 'nik_costumer';

    public function getAllCostumerByCabang( $cabang = null, $id = null ) {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->columns( array( 'nik_costumer' ), 'cos' );
        $select->columns( array( 'nama' ), 'cos' );
        $select->columns( array( 'alamat' ), 'cos' );
        $select->columns( array( 'jenis_kelamin' ), 'cos' );
        $select->columns( array( 'tempat_lahir' ), 'cos' );
        $select->columns( array( 'tanggal_lahir' ), 'cos' );
        $select->columns( array( 'nama_ibu' ), 'cos' );
        $select->columns( array( 'agama' ), 'cos' );
        $select->columns( array( 'status' ), 'cos' );
        $select->columns( array( 'pekerjaan' ), 'cos' );
        $select->columns( array( 'alamat_tempat_kerja' ), 'cos' );
        $select->columns( array( 'hp' ), 'cos' );
        $select->columns( array( 'telpon' ), 'cos' );

        $select->join( array( 'us' => 'user' ), 'cos.id_user=us.id_user', array( 'realname' ) );
        $select->join( array( 'cb' => 'cabang' ), 'us.id_cabang = cb.id_cabang', array() );
        if ( !empty( $id ) ) {
            $select->where( 'cos.id_user = ?', $id );
        }if ( !empty( $cabang ) ) {
            $select->where( 'cos.id_cabang = ?', $cabang );
        }

        return $this->getAdapter()->fetchAll( $select );
    }

    public function getCetakKostumer() {
        $select = $this->select();
        $select->from( $this->_name, array( '*' ) );
        return $this->getAdapter()->fetchAll( $select );
    }

    public function getAllCostumer() {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->columns( array( 'id_costumer' ), 'cos' );
        $select->columns( array( 'nik_costumer' ), 'cos' );
        $select->columns( array( 'nama' ), 'cos' );
        $select->columns( array( 'alamat' ), 'cos' );
        $select->columns( array( 'jenis_kelamin' ), 'cos' );
        $select->columns( array( 'tempat_lahir' ), 'cos' );
        $select->columns( array( 'tanggal_lahir' ), 'cos' );
        $select->columns( array( 'nama_ibu' ), 'cos' );
        $select->columns( array( 'agama' ), 'cos' );
        $select->columns( array( 'status' ), 'cos' );
        $select->columns( array( 'pekerjaan' ), 'cos' );
        $select->columns( array( 'alamat_tempat_kerja' ), 'cos' );
        $select->columns( array( 'hp' ), 'cos' );
        $select->columns( array( 'telpon' ), 'cos' );

        $select->join( array( 'us' => 'user' ), 'cos.id_user=us.id_user', array( 'realname' ) );
        $select->join( array( 'cb' => 'cabang' ), 'cb.id_cabang = cos.id_cabang', array( 'cabang' ) );

        return $this->getAdapter()->fetchAll( $select );
    }

    public function getCostumer( $id ) {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->columns( array( 'nik_costumer' ), 'cos' );
        $select->columns( array( 'nama' ), 'cos' );
        $select->columns( array( 'alamat' ), 'cos' );
        $select->columns( array( 'jenis_kelamin' ), 'cos' );
        $select->columns( array( 'tempat_lahir' ), 'cos' );
        $select->columns( array( 'tanggal_lahir' ), 'cos' );
        $select->columns( array( 'nama_ibu' ), 'cos' );
        $select->columns( array( 'agama' ), 'cos' );
        $select->columns( array( 'status' ), 'cos' );
        $select->columns( array( 'pekerjaan' ), 'cos' );
        $select->columns( array( 'alamat_tempat_kerja' ), 'cos' );
        $select->columns( array( 'hp' ), 'cos' );
        $select->columns( array( 'telpon' ), 'cos' );
        $select->columns( array( 'npwp' ), 'cos' );
        $select->columns( array( 'kota' ), 'cos' );
        $select->columns( array( 'provinsi' ), 'cos' );
        $select->columns( array( 'kode_pos' ), 'cos' );
        $select->columns( array( 'penghasilan_perbulan' ), 'cos' );
        $select->columns( array( 'jumlah_tanggungan' ), 'cos' );
        $select->join( array( 'us' => 'user' ), 'cos.id_user=us.id_user', array( 'realname' ) );
        $select->join( array( 'cb' => 'cabang' ), 'us.id_cabang = cb.id_cabang', array( 'cabang' ) );

        $select->where( 'cos.nik_costumer = ?', $id );
        return $this->getAdapter()->fetchRow( $select );
    }

    /**
     * 
     * @param type $nik_costumer
     */
    public function getPenjaminCostumer( $nik_costumer ) {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->join( array( 'penj' => 'penjamin' ), 'penj.nik_costumer = cos.nik_costumer', array( '*' ) );
        $select->where( 'cos.nik_costumer = ?', $nik_costumer );
        return $this->getAdapterSelect()->fetchAll( $select );
    }

    /* public function getNoKontrak(){
      $select = $this->select();
      $select->from($this->_name,array('nik_costumer'));
      return $this->getAdapterSelect()->fetchAll($select);
      }
     */
    /**
     * 
     * @param type $laporan as status laporan
     * @param type $cetakCostumer c
     * @param type $cabang as kondisi jika sebagai pimpinan maka tambah kondisi id_cabang
     * @return type
     */
    public function getNoKontrak( $laporan = false,$cetakCostumer = false ,$cabang = false ) {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->join( array( 'pinj' => 'pinjaman' ), 'pinj.nik_costumer =  cos.nik_costumer', array() );
        $select->joinLeft( array( 'kend' => 'kendaraan' ), 'kend.no_polisi = pinj.no_polisi', array() );
        if ( $laporan ) {
            $select->join( array( 'pem' => 'pembayaran' ), 'pinj.no_kontrak = pem.no_kontrak', array() );
        }if($cetakCostumer){
            $select->joinLeft( array( 'penj' => 'penjamin' ), 'penj.nik_costumer =  cos.nik_costumer', array() );
            $select->joinLeft( array( 'bb_kas' => 'bb_penerimaan_kas' ), 'bb_kas.no_kontrak = pinj.no_kontrak', array() );
            $select->columns( array( 'no_kontrak' ), 'pinj' );
        }else{
          $select->columns( array( 'no_kontrak' ), 'pinj' );
          $select->columns( array( 'lama_angsuran' ), 'pinj' );  
        }
        if($cabang){
            $select->join( array( 'cab' => 'cabang' ), 'cab.id_cabang =  cos.id_cabang', array() );
            $select->where('cos.id_cabang = ?',$cabang);
        }
        $select->group( 'pinj.no_kontrak' );
        return $this->getAdapterSelect()->fetchAll( $select );
    }
    
  
    public function getNikCostumer(){
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->joinLeft( array( 'penj' => 'penjamin' ), 'penj.nik_costumer =  cos.nik_costumer', array() );
        $select->joinLeft( array( 'pinj' => 'pinjaman' ), 'pinj.nik_costumer =  cos.nik_costumer', array() );
        $select->joinLeft( array( 'kend' => 'kendaraan' ), 'kend.no_polisi = pinj.no_polisi', array() );
        $select->joinLeft( array( 'bb_kas' => 'bb_penerimaan_kas' ), 'bb_kas.no_kontrak = pinj.no_kontrak', array() );
        $select->columns( array( 'nik_costumer' ), 'cos' );
        $select->group('cos.nik_costumer');
        return $this->getAdapterSelect()->fetchAll($select);
        
    }


    
    public function getDetailPembayaran( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->join( array( 'pinj' => 'pinjaman' ), 'pinj.nik_costumer =  cos.nik_costumer', array() );
        $select->join( array( 'kend' => 'kendaraan' ), 'kend.no_polisi = pinj.no_polisi', array() );
        $select->join( array( 'cab' => 'cabang' ), 'cab.id_cabang = cos.id_cabang', array( 'cabang' ) );
        $select->columns( array( 'no_kontrak' ), 'pinj' );
        $select->columns( array( 'nama' ), 'cos' );
        $select->columns( array( 'no_polisi' ), 'kend' );
        $select->columns( array( 'angsuran_perbulan' ), 'pinj' );
        $select->columns( array( 'tanggal_jatuh_tempo' ), 'pinj' );
        $select->where( 'pinj.no_kontrak = ?', $no_kontrak );
        $select->group( 'pinj.no_kontrak' );
        return $this->getAdapterSelect()->fetchRow( $select );
    }

    public function getCabangCostumer( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'cos' => $this->_name ), array() );
        $select->setIntegrityCheck( false );
        $select->join( array( 'pinj' => 'pinjaman' ), 'pinj.nik_costumer =  cos.nik_costumer', array() );
        $select->join( array( 'cab' => 'cabang' ), 'cos.id_cabang = cab.id_cabang' );
        $select->columns( array( 'id_cabang' ), 'cab' );
        $select->columns( array( 'cabang' ), 'cab' );
        $select->where( 'pinj.no_kontrak = ?', $no_kontrak );
        return $this->getAdapterSelect()->fetchRow( $select );
    }

    public function getCetakDataCostumer( $cabang = false, $fields = array() ) {
        $select = $this->select();
        $select->from( array( 'cos' => 'costumer' ), array() );
        $select->setIntegrityCheck( false );
        $select->joinLeft( array( 'penj' => 'penjamin' ), 'penj.nik_costumer = cos.nik_costumer', array() );
        $select->join( array( 'ken' => 'kendaraan' ), 'ken.nik_costumer = cos.nik_costumer', array() );
        $select->join( array( 'pinj' => 'pinjaman' ), 'pinj.nik_costumer = cos.nik_costumer', array() );
        $select->joinLeft( array( 'cab' => 'cabang' ), 'cab.id_cabang=cos.id_cabang', array() );
        $select->columns( array( 'nik_costumer' ), 'cos' );
        $select->columns( array( 'nama_costumer'=>'nama' ), 'cos' );
        $select->columns( array( 'alamat' ), 'cos' );
        $select->columns( array( 'nik_penjamin' ), 'penj' );
        $select->columns( array( 'nama_penjamin'=>'nama' ), 'penj' );
        $select->columns( array( 'no_polisi' ), 'ken' );
        $select->columns( array( 'merk' ), 'ken' );
        $select->columns( array( 'no_kontrak' ), 'pinj' );
        $select->columns( array( 'nilai_pinjaman' ), 'pinj' );
        $select->columns( array( 'angsuran_perbulan' ), 'pinj' );
        $select->columns( array( 'lama_angsuran' ), 'pinj' );
        $select->joinLeft( array( 'bb_kas' => 'bb_penerimaan_kas' ), 'bb_kas.no_kontrak =pinj.no_kontrak', array( new Zend_Db_Expr( 'count(bb_kas.no_kontrak) as total_ang' ) ) );
        $select->columns( array( 'cabang' ), 'cab' );

        /* Kondisi Inputan */
        if ( !empty( $fields ) ) {
            foreach ( $fields as $key => $row ) {
                if ( !empty( $row ) ) {
                    if ( !empty( $row[ 'priode' ] ) ) {
                        foreach ( $row[ 'priode' ] as $k => $v ) {
                            if ( !empty( $k === 'awal' ) ) {
                                $select->where( 'pinj.tanggal >= ? ', $v );
                            }if ( !empty( $k === 'akhir' ) ) {
                                $select->where( 'pinj.tanggal <= ? ', $v );
                            }
                        }
                    }if ( !empty( $key === 'nik_costumer' ) && !empty( $row ) ) {
                        $select->where( 'cos.nik_costumer = ? ', $row );
                    }if ( !empty( $key === 'no_kontrak' ) && !empty( $row ) ) {
                        $select->where( 'pinj.no_kontrak= ? ', $row );
                    }if ( !empty( $key === 'nilai_pinjaman_min' ) ) {
                        $select->where( 'pinj.nilai_pinjaman >= ?', $row );
                    }if ( !empty( $key === 'nilai_pinjaman_max' ) ) {
                        $select->where( 'pinj.nilai_pinjaman <= ?', $row );
                    }if ( !empty( $key === 'jumlah_ang' ) ) {
                        $select->where( 'pinj.lama_angsuran = ?', $row );
                    }
                }
            }
        }

        if ( $cabang ) {
            $select->where( 'cos.id_cabang = ?',$cabang );
        }

        /* End Kondisi */
        $select->order( 'cos.nik_costumer' );
        $select->group( 'cos.nik_costumer' );
        return $this->getAdapterSelect()->fetchAll( $select );


    }

}
