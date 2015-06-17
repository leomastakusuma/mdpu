<?php

class Belajarmodels extends Models {

	protected $_table ='anggota';


	public function save ($nama,$alamat,$telpon){
		$data = array(':nama'        => $nama,
                      ':alamat'            => $alamat,
                      ':telpon'          => $telpon  
                      );

        $sql  = "INSERT INTO {$this->table}";
        $sql .= " (nama , alamat, telpon)";
        $sql .= " VALUES ( :nama, :alamat, :telpon )";
        $query = $this->db->prepare($sql);
        $query->execute($data);      
		// $data = array(':');
	}

} 