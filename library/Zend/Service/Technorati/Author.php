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
 * @package    Zend_Service
 * @subpackage Technorati
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/**
 * @see Zend_Service_Technorati_Utils
 */
require_once 'Zend/Service/Technorati/Utils.php';


/**
 * Represents a weblog Author object. It usually belongs to a Technorati user-resource.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Technorati
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Technorati_Author
{
    /**
     * Author first name
     *
     * @var     string
     * @access  protected
     */
    protected $_firstName;

    /**
     * Author last name
     *
     * @var     string
     * @access  protected
     */
    protected $_lastName;

    /**
     * Technorati user-resource username
     *
     * @var     string
     * @access  protected
     */
    protected $_username;

    /**
     * Technorati user-resource description
     *
     * @var     string
     * @access  protected
     */
    protected $_description;

    /**
     * Technorati user-resource biography
     *
     * @var     string
     * @access  protected
     */
    protected $_bio;

    /**
     * Technorati user-resource thumbnail picture URL, if any
     *
     * @var     null|Zend_Uri_Http
     * @access  protected
     */
    protected $_thumbnailPicture;


    /**
     * Constructs a new object from DOM Element.
     *
     * @param   DomElement $dom the ReST fragment for this object
     */
    public function __construct(DomElement $dom)
    {
        $xpath = new DOMXPath($dom->ownerDocument);

        $result = $xpath->query('./firstname/text()', $dom);
        if ($result->length == 1) $this->setFirstName($result->item(0)->data);

        $result = $xpath->query('./lastname/text()', $dom);
        if ($result->length == 1) $this->setLastName($result->item(0)->data);

        $result = $xpath->query('./username/text()', $dom);
        if ($result->length == 1) $this->setUsername($result->item(0)->data);

        $result = $xpath->query('./description/text()', $dom);
        if ($result->length == 1) $this->setDescription($result->item(0)->data);

        $result = $xpath->query('./bio/text()', $dom);
        if ($result->length == 1) $this->setBio($result->item(0)->data);

        $result = $xpath->query('./thumbnailpicture/text()', $dom);
        if ($result->length == 1) $this->setThumbnailPicture($result->item(0)->data);
    }


    /**
     * Returns Author first name.
     *
     * @return  string  Author first name
     */
    public function getFirstName() {
        return $this->_firstName;
    }

    /**
     * Returns Author last name.
     *
     * @return  string  Author last name
     */
    public function getLastName() {
        return $this->_lastName;
    }

    /**
     * Returns Technorati user-resource username.
     *
     * @return  string  Technorati user-resource username
     */
    public function getUsername() {
        return $this->_username;
    }

    /**
     * Returns Technorati user-resource description.
     *
     * @return  string  Technorati user-resource description
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     * Returns Technorati user-resource biography.
     *
     * @return  string  Technorati user-resource biography
     */
    public function getBio() {
        return $this->_bio;
    }

    /**
     * Returns Technorati user-resource thumbnail picture.
     *
     * @return  null|Zend_Uri_Http  Technorati user-resource thumbnail picture
     */
    public function getThumbnailPicture() {
        return $this->_thumbnailPicture;
    }


    /**
     * Sets author first name.
     *
     * @param   string $input   first Name input value
     * @return  Zend_Service_Technorati_Author  $this instance
     */
    public function setFirstName($input) {
        $this->_firstName = (string) $input;
        return $this;
    }

    /**
     * Sets author last name.
     *
     * @param   string $input   last Name input value
     * @return  Zend_Service_Technorati_Author  $this instance
     */
    public function setLastName($input) {
        $this->_lastName = (string) $input;
        return $this;
    }

    /**
     * Sets Technorati user-resource username.
     *
     * @param   string $input   username input value
     * @return  Zend_Service_Technorati_Author  $this instance
     */
    public function setUsername($input) {
        $this->_username = (string) $input;
        return $this;
    }

    /**
     * Sets Technorati user-resource biography.
     *
     * @param   string $input   biography input value
     * @return  Zend_Service_Technorati_Author  $this instance
     */
    public function setBio($input) {
        $this->_bio = (string) $input;
        return $this;
    }

    /**
     * Sets Technorati user-resource description.
     *
     * @param   string $input   description input value
     * @return  Zend_Service_Technorati_Author  $this instance
     */
    public function setDescription($input) {
        $this->_description = (string) $input;
        return $this;
    }

    /**
     * Sets Technorati user-resource thumbnail picture.
     *
     * @param   string|Zend_Uri_Http $input thumbnail picture URI
     * @return  Zend_Service_Technorati_Author  $this instance
     * @throws  Zend_Service_Technorati_Exception if $input is an invalid URI
     *          (via Zend_Service_Technorati_Utils::normalizeUriHttp)
     */
    public function setThumbnailPicture($input) {
        $this->_thumbnailPicture = Zend_Service_Technorati_Utils::normalizeUriHttp($input);
        return $this;
    }

}
