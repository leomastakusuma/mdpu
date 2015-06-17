<?php

class Mydb_Db_Profiler_Log extends Zend_Db_Profiler
{

    protected $_logName = 'query';

    protected $_log;
    /**
     * counter of the total elapsed time
     * 
     * @var double
     */
    protected $_totalElapsedTime;

    public function __construct ($enabled = false)
    {
        parent::__construct($enabled);
        //$this->_log = new Zend_Log();
        //$writer = new Zend_Log_Writer_Stream( APPLICATION_PATH . '/../data/var/query/queries.log' );
        //$this->_log->addWriter($writer);
    }

    /**
     * Intercept the query end and log the profiling data.
     *
     * @param integer $queryId            
     * @throws Zend_Db_Profiler_Exception
     * @return void
     */
    public function queryEnd ($queryId)
    {
        $state = parent::queryEnd($queryId);
        
        if (! $this->getEnabled() || $state == self::IGNORED) {
            return;
        }
        
        // get profile of the current query
        $profile = $this->getQueryProfile($queryId);
        
        // update totalElapsedTime counter
        $this->_totalElapsedTime += $profile->getElapsedSecs();
        
        // create the message to be logged
        $time = round($profile->getElapsedSecs(), 5);
        $message = "\r\nElapsed Secs: " . $time .
                 "\r\n";
        $message .= "Query: " . $profile->getQuery() . "\r\n";
        $message .= "Params: " . Zend_Json::encode($profile->getQueryParams()) . "\r\n";
        
        
        // log the message as INFO message
        //$this->_log->info($message);
        if ($time >= 20) {
            $level = Zend_Log::CRIT;
            $logName = $this->_logName . '.crit.log';
        } elseif ($time >= 10) {
            $level = Zend_Log::ERR;
            $logName = $this->_logName . '.err.log';
        } elseif ($time >= 5) {
            $level = Zend_Log::WARN;
            $logName = $this->_logName . '.warn.log';
        } else {
            $level = Zend_Log::INFO;
            $logName = $this->_logName . '.log';
        }
        Mydb::log($message,Zend_Log::INFO,$logName, false , 'query');
    }
}
