<?php

final class Mydb
{
    /**
     * Registry collection
     *
     * @var array
     */
    static private $_registry                   = array();

    /**
     * Register a new variable
     *
     * @param string $key
     * @param mixed $value
     * @param bool $graceful
     */
    public static function register($key, $value, $graceful = false)
    {
        if (isset(self::$_registry[$key])) {
            if ($graceful) {
                return;
            }
            throw new Exception('App registry key "'.$key.'" already exists');
        }
        self::$_registry[$key] = $value;
    }

    /**
     * Unregister a variable from register by key
     *
     * @param string $key
     */
    public static function unregister($key)
    {
        if (isset(self::$_registry[$key])) {
            if (is_object(self::$_registry[$key]) && (method_exists(self::$_registry[$key], '__destruct'))) {
                self::$_registry[$key]->__destruct();
            }
            unset(self::$_registry[$key]);
        }
    }

    /**
     * Retrieve a value from registry by a key
     *
     * @param string $key
     * @return mixed
     */
    public static function registry($key)
    {
        if (isset(self::$_registry[$key])) {
            return self::$_registry[$key];
        }
        return null;
    }

    protected static $_appData = null;

    
    public static function getBaseDir ($type)
    {
        if (self::$_appData === null) {
            if (defined('APPLICATION_DATA_PATH') && is_dir(APPLICATION_DATA_PATH)) {
                self::$_appData = APPLICATION_DATA_PATH;
            } elseif(is_dir( APP_DIR . DS . '..' . DS . '..' . DS . 'data')) {
                self::$_appData = APP_DIR . DS . '..' . DS . '..' . DS . 'data';
            }else {
                self::$_appData = APP_DIR . DS . '..' . DS . 'data';
            }
        }
        switch ($type) {
            case 'query':
                return self::$_appData . DS . 'var' . DS . 'query' . DS;
                break;
            case 'log':
                return self::$_appData . DS . 'var' . DS . 'log';
                break;
            default:
                return self::$_appData . DS . 'var';
        }
    }
    
    
    public static function getBaseDirx ($type)
    {
        if (self::$_appData === null) {
            if (defined('APPLICATION_DATA') && is_dir(APPLICATION_DATA)) {
                self::$_appData = APPLICATION_DATA;
            } else {
                self::$_appData = APP_DIR . DS . '..' . DS . 'data';
            }
        }
        switch ($type) {
        	case 'query':
        	    return self::$_appData . DS . 'var' . DS . 'query' . DS;
        	    break;
        	case 'log':
        	    return self::$_appData . DS . 'var' . DS . 'log';
        	    break;
        	default:
        	    return self::$_appData . DS . 'var';
        }
    }

    public static function getConfig() {
        if (self::registry('getConfig') === null) {
            global $Config;
            self::register('getConfig', Zend_Json::decode(Zend_Json::encode($Config),Zend_Json::TYPE_OBJECT));
        }
        return self::registry('getConfig');
    }
    /**
     *
     * @param mix $message
     * @param string $level
     * @param string $file
     * @param string $forceLog
     * @param string $base
     * @param string $timeFormat
     */
    public static function log($message, $level = null, $file = '', $forceLog = false, $base = 'log', $timeFormat = true)
    {
        //global $Config;
        $Config = self::getConfig();
        try {
            $logActive = !empty($Config->logs->active) ? true : false;
            $writerModel = !empty($Config->logs->writer_model) ? $Config->logs->writer_model : false;;

            if (empty($file)) {
                $file = !empty($Config->logs->file) ? $Config->logs->file : 'system.log';
            }
        } catch (Exception $e) {
            $writerModel = false;
            $logActive = true;
        }

        if (!$logActive && !$forceLog) {
            return;
        }

        static $loggers = array();

        $level  = is_null($level) ? Zend_Log::DEBUG : $level;
        $file = empty($file) ? 'system.log' : $file;

        //$file = $file;

        try {
            if (!isset($loggers[$file])) {

                $logFile = self::getBaseDir($base) . DS . date('Y' . DS . 'm' . DS . 'd' . DS . 'H')  . DS . $file;

                if (!is_dir(self::getBaseDir($base) . DS . date('Y' . DS . 'm' . DS . 'd' . DS . 'H'))) {
                    @mkdir(self::getBaseDir($base) . DS . date('Y' . DS . 'm' . DS . 'd' . DS . 'H'), 0777,true);
                    @chmod(self::getBaseDir($base) . DS . date('Y'), 0777);
                    @chmod(self::getBaseDir($base) . DS . date('Y' . DS . 'm'), 0777);
                    @chmod(self::getBaseDir($base) . DS . date('Y' . DS . 'm' . DS . 'd'), 0777);
                    @chmod(self::getBaseDir($base) . DS . date('Y' . DS . 'm' . DS . 'd' . DS . 'H'), 0777);
                }

                if (!file_exists($logFile)) {
                    @file_put_contents($logFile, '');
                    @chmod($logFile, 0777);
                }

                if ($timeFormat) {
                    $format = '%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL;
                } else {
                    $format = '%message%' . PHP_EOL;
                }
                $formatter = new Zend_Log_Formatter_Simple($format);
                if (!$writerModel) {
                    $writer = new Zend_Log_Writer_Stream($logFile);
                }
                else {
                    $writer = new $writerModel($logFile);
                }
                $writer->setFormatter($formatter);
                $loggers[$file] = new Zend_Log($writer);
            }

            if (is_array($message) || is_object($message)) {
                $message = print_r($message, true);
            }
            if (!empty(self::$_logSearch)) {
                $message = str_replace(self::$_logSearch, self::$_logReplace, $message);
            }
            $loggers[$file]->log($message, $level);
        }
        catch (Exception $e) {
        }
    }

    protected static function _getDbConfig() {
        $Config = self::getConfig();
        if (self::registry('dbConfig') == null) {
            if (empty($Config->database)) {
                return null;
            }
            $dbConfig = $Config->database;
            $dbConfig = Zend_Json::decode(Zend_Json::encode($dbConfig),Zend_Json::TYPE_ARRAY);
            self::register('dbConfig', $dbConfig);
        }
        return self::registry('dbConfig');
    }

    public static function defaultAdapter() {
        if (!self::registry('dbDefaultAdapter')) {
            $dbConfig = self::_getDbConfig();
            self::registry('dbDefaultAdapter',1);
            $config = $dbConfig['default']['default'];
            $db = Zend_Db::factory($config['adapter'], $config['params']);
            Zend_Db_Table_Abstract::setDefaultAdapter($db);
        }
    }
    public static function getAdapter($connector = 'default',$connection='') {
        $dbConfig = self::_getDbConfig();
        self::log('connect to adapter : ' . $connector. '  for connection : ' . $connection);
        self::defaultAdapter();
        if (empty($dbConfig[$connector])) {
            return Zend_Db_Table::getDefaultAdapter();
        }
        if (!empty($connection) && !in_array($connection, array('select','update'))) {
            $connection = '';
        }
        $key = 'adapter_' . $connector . (!empty($connection) ? '_' . $connection : '');
        if (self::registry($key) !== null) {
            return self::registry($key);
        }
        if (empty($connection)) {
            $keyConfig = 'database/' . $connector;
            $config = $dbConfig[$connector]['default'];
            $adapter = Zend_Db::factory($config['adapter'],$config['params']);
            self::register($key, $adapter, true);
            return self::registry($key);
        } else {
            $keyConfig = 'database/' . $connector . '/' . $connection;

            if (empty($dbConfig[$connector][$connection])) {
                return self::getAdapter($connector,'');
            } else {
                $config = $dbConfig[$connector][$connection];
                $adapter = Zend_Db::factory($config['adapter'],$config['params']);
                self::register($key, $adapter, true);
                return self::registry($key);
            }
        }
        return Zend_Db_Table::getDefaultAdapter();
    }

     /**
     * Get the client's IP addres
     *
     * @param  boolean $checkProxy
     * @return string
     */
    public static function getClientIp($checkProxy = true)
    {
        if ($checkProxy && self::getServer('HTTP_CLIENT_IP') != null) {
            $ip = self::getServer('HTTP_CLIENT_IP');
        } else if ($checkProxy && self::getServer('HTTP_X_FORWARDED_FOR') != null) {
            $ip = self::getServer('HTTP_X_FORWARDED_FOR');
            if (self::getServer('HTTP_X_FORWARDED_FOR') != null) {
                $ip .= ', ' . self::getServer('HTTP_X_FORWARDED_IP','');
            }
        } else {
            $ip = self::getServer('REMOTE_ADDR');
        }

        return $ip;
    }

    /**
     * Retrieve a member of the $_SERVER superglobal
     *
     * If no $key is passed, returns the entire $_SERVER array.
     *
     * @param string $key
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public static function getServer($key = null, $default = null)
    {
        if (null === $key) {
            return $_SERVER;
        }

        return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
    }

    /**
     * model untuk memanggil Mydb_Db_User yang digunakan untuk memanage table Users
     * @return Mydb_Db_User
     */
    public static function getModelUser() {
        $key = 'Mydb_Db_User';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_User());
        }
        return self::registry($key);
    }
    
    
    /**
     * @access  model untuk memanggil Mydb_Db_Cabang yang digunakan untuk memanage table Cabang
     * @return Mydb_Db_Cabang
     */
    public static function getModelCabang() {
        $key = 'Mydb_Db_Cabang';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Cabang());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil Mydb_Db_UserLogin yang digunakan untuk memanage table UserLogin
     * @return Mydb_Db_UserLogin
     */
    public static function getModelUserLogin() {
        $key = 'Mydb_Db_UserLogin';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_UserLogin());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil Mydb_Db_Kendaraan yang digunakan untuk memanage table Kendaraan
     * @return Mydb_Db_Kendaraan
     */
    public static function getModelKendaraan() {
        $key = 'Mydb_Db_Kendaraan';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Kendaraan());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil Mydb_Db_Costumer yang digunakan untuk memanage table Costumer
     * @return Mydb_Db_Costumer
     */
    public static function getModelCostumer() {
        $key = 'Mydb_Db_Costumer';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Costumer());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil Mydb_Db_Penjamin yang digunakan untuk memanage table Penjamin
     * @return Mydb_Db_Penjamin
     */
    public static function getModelPenjamin() {
        $key = 'Mydb_Db_Penjamin';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Penjamin());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil Mydb_Db_Pinjaman yang digunakan untuk memanage table Pinjaman
     * @return Mydb_Db_Pinjaman
     */
    public static function getModelPinjaman() {
        $key = 'Mydb_Db_Penjamin';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Pinjaman());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil getModelSPB yang digunakan untuk memanage table SPB
     * @return Mydb_Db_Spb
     */
    public static function getModelSpb() {
        $key = 'Mydb_Db_Spb';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Spb());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil getModelPembayaran yang digunakan untuk memanage table Pembayaran
     * @return Mydb_Db_Pembayaran
     */
    public static function getModelPembayaran() {
        $key = 'Mydb_Db_Pembayaran';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_Pembayaran());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil getModelKartuPiutang yang digunakan untuk memanage table Kartu Piutang
     * @return Mydb_Db_KartuPiutang
     */
    public static function getModelKartuPiutang() {
        $key = 'Mydb_Db_KartuPiutang';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_KartuPiutang());
        }
        return self::registry($key);
    }
    /**
     * @access  model untuk memanggil getModelBBPenerimaanKas yang digunakan untuk memanage table Kartu Piutang
     * @return Mydb_Db_BBPenerimaanKas
     */
    public static function getModelBBPenerimaanKas() {
        $key = 'Mydb_Db_BBPenerimaanKas';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_BBPenerimaanKas());
        }
        return self::registry($key);
    }
    
    /**
     * @access  model untuk memanggil getModelBBPiutang yang digunakan untuk memanage table Kartu Piutang
     * @return Mydb_Db_BBPiutang
     */
    public static function getModelBBPiutang() {
        $key = 'Mydb_Db_BBPiutang';
        if (self::registry($key) === null) {
            self::register($key, new Mydb_Db_BBPiutang());
        }
        return self::registry($key);
    }
}