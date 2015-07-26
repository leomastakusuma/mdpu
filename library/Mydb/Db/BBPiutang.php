<?php

/**
 * MDPU Finance
 * 
 * 
 * @category   Mydb
 * @package    Mydb_Db
 * @subpackage Mydb_Db_BBPiutang
 */
class Mydb_Db_BBPiutang extends Mydb_Db_Abstract {

    protected $_name = 'bb_piutang';
    protected $_primary = 'id_piutang';

    public function getSumTotalSaldo( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'bbp' => 'bb_piutang' ), array( 'bbp.saldo' ) );
        $select->where( 'bbp.no_kontrak = ?', $no_kontrak );
        $select->order( 'bbp.id_piutang desc' );
        return $this->getAdapterSelect()->fetchRow( $select );
    }

    public function getSaldoLastYearMonth( $no_kontrak ) {
        $select = $this->select();
        $select->from( array( 'bbp' => 'bb_piutang' ), array('*') );
        $select->where( 'bbp.no_kontrak = ?', $no_kontrak );
        return $this->getAdapterSelect()->fetchAll( $select );
    }

}
