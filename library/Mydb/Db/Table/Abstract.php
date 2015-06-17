<?php

class Mydb_Db_Table_Abstract extends Zend_Db_Table_Abstract {
    
    /**
     * Zend_Db_Adapter_Abstract object for Select.
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_dbSelect = null;

    /**
     * Zend_Db_Adapter_Abstract object for Update.
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_dbUpdate = null;

    /**
     * Gets the Zend_Db_Adapter_Abstract for this particular Zend_Db_Table object for Select.
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public function getAdapterSelect() {
        if ($this->_dbSelect === null) {
            $this->_dbSelect = $this->_db;
        }
        return $this->_dbSelect;
    }
    /**
     * Gets the Zend_Db_Adapter_Abstract for this particular Zend_Db_Table object for Update.
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public function getAdapterUpdate() {
                
        if ($this->_dbUpdate === null) {
            $this->_dbUpdate = $this->_db;
        }
        return $this->_dbUpdate;
    }

    /**
     * Sets the default Zend_Db_Adapter_Abstract for all Zend_Db_Table objects for Update.
     *
     * @param  mixed $db Either an Adapter object, or a string naming a Registry key
     * @return MyIndo_Db_Table_Abstract
     */
    public function setAdapterSelect($db) {
        $this->_dbSelect = $this->_setupAdapter($db);
        return $this;
    }

    /**
     * Sets the default Zend_Db_Adapter_Abstract for all Zend_Db_Table objects for Update.
     *
     * @param  mixed $db Either an Adapter object, or a string naming a Registry key
     * @return MyIndo_Db_Table_Abstract
     */
    public function setAdapterUpdate($db) {
        $this->_dbUpdate = $this->_setupAdapter($db);
        $this->_setAdapter($db);
        return $this;
    }
    public function init() {
    }

    /**
     * 
     * @var integer
     */
    protected $_id = null;
    /**
     * 
     * @param integer $id
     */
    protected function _setId($id) {
    	$this->_id = $id;
    }
    /**
     * 
     * @param integer $id
     */
    protected function setId($id) {
    	$this->_setId($id);
    }

    /**
     * 
     * @return integer
     */
    protected function _getId() {
    	return $this->_id;
    }

    /**
     * 
     * @return integer
     */
    public function getId() {
    	return $this->_getId();
    }

    /**
     * 
     * @var string
     */
    protected $_idFieldName = NULL;
    /**
     * 
     * @param string $name
     * @return MyIndo_Db_Table_Abstract
     */
    public function setIdFieldName($name)
    {
        $this->_idFieldName = $name;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getIdFieldName()
    {
    	if ($this->_idFieldName === null ) {
    		if (is_array($this->_primary) && count($this->_primary) == 1 && isset($this->_primary[1])) {
    		    $this->_idFieldName = $this->_primary[1];
    		} else {
    		    $this->_idFieldName = 'id';
    		}
    	}
        return $this->_idFieldName;
    }

    protected function _getCountId() {
    	if (is_array($this->_primary) && count($this->_primary) == 1 && isset($this->_primary[1])) {
    		return $this->_primary[1];
    	}
    	return '*';
    }

    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _select(Zend_Db_Table_Select $select) {
    	return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectList(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectListDataTable(Zend_Db_Table_Select $select) {
    	return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectJoinListJqGrid(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectJoinList(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectJoinFooterJqGrid(Zend_Db_Table_Select $select) {
        return $this->_selectJoinListJqGrid($select);
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectColumnsListJqGrid(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectColumnsList(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectColumnsCountJqGrid(Zend_Db_Table_Select $select) {
    	$select->columns(array('count'=>'count('.$this->_getCountId().')'),'t');
        return $select;
    }
    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectColumnsFooterJqGrid(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectFrom(Zend_Db_Table_Select $select) {
        $select->from(array( 't' => $this->_name));
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectFromList(Zend_Db_Table_Select $select) {
        $select->from(array( 't' => $this->_name));
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectWhereList(Zend_Db_Table_Select $select) {
        return $select;
    }
    
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectFromListDataTable(Zend_Db_Table_Select $select) {
        $select->from(array( 't' => $this->_name));
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectFromListJqGrid(Zend_Db_Table_Select $select) {
        $select->from(array( 't' => $this->_name));
        $select->setIntegrityCheck(false);
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectFromCountJqGrid(Zend_Db_Table_Select $select) {
        $select->from(array( 't' => $this->_name), array());
        $select->setIntegrityCheck(false);
        return $select;
    }
    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectFromFooterJqGrid(Zend_Db_Table_Select $select) {
        $select->from(array( 't' => $this->_name), array());
        $select->setIntegrityCheck(false);
        return $select;
    }
    
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectGroup(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectGroupList(Zend_Db_Table_Select $select) {
        return $select;
    }
    
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectOrderList(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectGroupDataTable(Zend_Db_Table_Select $select) {
        return $select;
    }
    
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectGroupJqGrid(Zend_Db_Table_Select $select) {
        return $select;
    }
    /**
     *
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    protected function _selectOrderJqGrid(Zend_Db_Table_Select $select) {
    	//$select->order(array('id desc'));
        return $select;
    }
    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @param mixed $where
     * @return Zend_Db_Table_Select
     */
    protected function _selectWhere(Zend_Db_Table_Select $select, $where) {
    	if (is_string($where)) {
    		$select->where($where);
    	} elseif (is_array($where)) {
    		foreach($where as $k=>$v) {
    			if (is_int($k)) {
    				$select->where($v);
    			} elseif (is_string($k)) {
    				$select->where($k,$v);
    			}
    		}
    	}
        return $select;
    }
    
    /**
     * 
     * @param Zend_Db_Table_Select $select
     * @param mixed $where
     * @return Zend_Db_Table_Select
     */
    protected function _selectWhereJqGrid(Zend_Db_Table_Select $select, $where) {
    	return $this->_selectWhere($select, $where);
    }
    
    
    public function getCountDataTable($where = array()) {
        $select = $this->select();
        $select->from(array( 't' => $this->_name), array());
        $select->setIntegrityCheck(false);
        $select->columns(array('count'=>'count('.$this->_getCountId().')'),'t');
        if ($where) {
        	if (is_array($where)) {
        		foreach($where as $k=>$v) {
        			$select->where($v);
        		}
        	} else {
        		$select->where($where);
        	}
        }
        $select = $this->_selectGroupDataTable($select);
        $row = $this->getAdapterSelect()->fetchRow($select);
        return $row['count'];
    }
    public function getListDataTable($where = array(), $limit = 100, $offset=0, $order = array()) {
    	$select = $this->select();
    	$select = $this->_selectFromListDataTable($select);
    	$select->setIntegrityCheck(false);
        $select = $this->_selectListDataTable($select);
        if ($where) {
        	if (is_array($where)) {
        	    foreach($where as $k=>$v) {
        	        $select->where($v);
        	    }
        	} else {
        	    $select->where($where);
        	}
        }
        if ($limit && $limit > 0) {
        	$select->limit($limit,$offset);
        }
        if ($order) {
            $select->order($order);
        }
    	$select = $this->_selectGroupDataTable($select);
        return $this->getAdapterSelect()->fetchAll($select);
    }

    public function getListJqGrid($where = array(), $limit = 100, $offset=0, $order = array()) {
    	$bind = array();
        $select = $this->select();
        $select = $this->_selectFromListJqGrid($select);
        $select = $this->_selectJoinListJqGrid($select);
        $select = $this->_selectColumnsListJqGrid($select);
        if (!empty($where['where']) && !empty($where['where'])) {
        	$bind = array_merge($bind,$where['bind']);
        	$where = $where['where'];
        	$select = $this->_selectWhere($select,$where);
        } else {
        	$select = $this->_selectWhere($select,$where);
        }
        if ($limit && $limit > 0) {
            $select->limit($limit,$offset);
        }
        if ($order) {
            $select->order($order);
        }
        $select = $this->_selectGroupJqGrid($select);
        $select = $this->_selectOrderJqGrid($select);
        return $this->getAdapterSelect()->fetchAll($select, $bind);
    }
    
    public function getCountJqGrid($where = array()) {
    	$bind = array();
        $select = $this->select();
        $select = $this->_selectFromCountJqGrid($select);
        $select = $this->_selectJoinListJqGrid($select);
        $select = $this->_selectColumnsCountJqGrid($select);
        if (!empty($where['where']) && !empty($where['where'])) {
            $bind = array_merge($bind,$where['bind']);
            $where = $where['where'];
            $select = $this->_selectWhereJqGrid($select,$where);
        } else {
            $select = $this->_selectWhereJqGrid($select,$where);
        }
        $row = $this->getAdapterSelect()->fetchRow($select, $bind);
        return $row['count'];
    }
    
    public function getFooterJqGrid($where = array()) {
    	$bind = array();
    	$select = $this->select();
    	$select = $this->_selectFromFooterJqGrid($select);
    	$select = $this->_selectJoinFooterJqGrid($select);
    	$select = $this->_selectColumnsFooterJqGrid($select);
    	if (!empty($where['where']) && !empty($where['where'])) {
    	    $bind = array_merge($bind,$where['bind']);
    	    $where = $where['where'];
    	    $select = $this->_selectWhereJqGrid($select,$where);
    	} else {
    	    $select = $this->_selectWhereJqGrid($select,$where);
    	}
//     	print_r($select->__toString());die;
    	return $this->getAdapterSelect()->fetchRow($select, $bind);
    }
    
    public function getList($where = array(), $limit = 100, $offset=0, $order = array()) {

    	$bind = array();
    	$select = $this->select();
    	$select = $this->_selectFromList($select);
    	$select = $this->_selectJoinList($select);
    	$select = $this->_selectColumnsList($select);
    	if (!empty($where['where']) && !empty($where['where'])) {
    	    $bind = array_merge($bind,$where['bind']);
    	    $where = $where['where'];
    	    $select = $this->_selectWhere($select,$where);
    	} else {
    	    $select = $this->_selectWhere($select,$where);
    	}
    	if ($limit && $limit > 0) {
    	    $select->limit($limit,$offset);
    	}
    	$select = $this->_selectGroupList($select);
    	if ($order) {
    	    $select->order($order);
    	}
    	$select = $this->_selectOrderList($select);
    	return $this->getAdapterSelect()->fetchAll($select, $bind);
    	/*
        $select = $this->select();
        $select = $this->_selectFromList($select);
        $select->setIntegrityCheck(false);
        $select = $this->_selectList($select);
        $select = $this->_selectWhereList($select);
        if ($where) {
            if (is_array($where)) {
                foreach($where as $k=>$v) {
                    $select->where($v);
                }
            } else {
                $select->where($where);
            }
        }
        if ($limit && $limit > 0) {
            $select->limit($limit,$offset);
        }
        $select = $this->_selectOrderList($select);
        if ($order) {
            $select->order($order);
        }
        $select = $this->_selectGroupList($select);
        return $this->getAdapterSelect()->fetchAll($select);
        */
    }

    public function findById($id) {
    	if (empty($id)) {
    		return null;
    	}
    	$select = $this->select()->where('id = ? ' , $id);
    	return $this->getAdapterSelect()->fetchRow($select);
    }
    public function findByUsername($username) {
        if (empty($username)) {
            return null;
        }
        $select = $this->select()->where('username = ? ' , $username);
        return $this->getAdapterSelect()->fetchRow($select);
    }
    
    public function getDataById($id, $where = array(), $limit = 100, $offset = 0) {
    	$this->_setId($id);
    	$select = $this->select();
    	$select = $this->_selectFrom($select);
    	$select->setIntegrityCheck(false);
    	if ($id !== false) {
    		$select->where($this->getIdFieldName() . ' = ? ' , $id);
    	}
    	$select->limit($limit,$offset);
    	if ($where) {
    	    if (is_array($where)) {
    	        foreach($where as $k=>$v) {
    	            $select->where($v);
    	        }
    	    } else {
    	        $select->where($where);
    	    }
    	}
    	return $this->getAdapterSelect()->fetchRow($select);
    }
    
    public function getData($where = array()) {
    	$id = false;
    	if (empty($where)) {
    		return null;
    	}
    	return $this->getDataById(false , $where);
    }
}