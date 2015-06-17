<?php

class Mydb_Db_Abstract extends Mydb_Db_Table_Abstract {

    public function init() {
        $adapter = Mydb::getAdapter('default');
        $adapterSelect = Mydb::getAdapter('default','select');
        $this->setDefaultAdapter($adapter);
        $this->setAdapterSelect($adapterSelect)->setAdapterUpdate($adapter);
    }
}
