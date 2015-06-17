<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage Management
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Service_WindowsAzure_Management_ServiceEntityAbstract
 */
require_once 'Zend/Service/WindowsAzure/Management/ServiceEntityAbstract.php';

/**
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage Management
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * 
 * @property string $Url             The address of the storage user-resource.
 * @property string $ServiceName     The name of the storage user-resource.
 * @property string $Description	 A description of the storage user-resource.
 * @property string $AffinityGroup   The affinity group with which this storage user-resource is associated.
 * @property string $Location        The geo-location of the storage user-resource in Windows Azure, if your storage user-resource is not associated with an affinity group.
 * @property string $Label           The label for the storage user-resource.
 */
class Zend_Service_WindowsAzure_Management_StorageServiceInstance
	extends Zend_Service_WindowsAzure_Management_ServiceEntityAbstract
{    
    /**
     * Constructor
     * 
     * @param string $url             The address of the storage user-resource.
     * @param string $serviceName     The name of the storage user-resource.
	 * @param string $description	  A description of the storage user-resource.
	 * @param string $affinityGroup   The affinity group with which this storage user-resource is associated.
	 * @param string $location        The geo-location of the storage user-resource in Windows Azure, if your storage user-resource is not associated with an affinity group.
	 * @param string $label           The label for the storage user-resource.
	 */
    public function __construct($url, $serviceName, $description = '', $affinityGroup = '', $location = '', $label = '') 
    {	        
        $this->_data = array(
            'url'              => $url,
            'servicename'      => $serviceName,
            'description'      => $description,
            'affinitygroup'    => $affinityGroup,
            'location'         => $location,
            'label'            => base64_decode($label)        
        );
    }
}
