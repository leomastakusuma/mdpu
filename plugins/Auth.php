<?php
/**
 * 
 */


class Auth
{
    

    public static function handleLogin()
    {
        @session_start();
        $logged = $_SESSION['logged'];
        $level  = $_SESSION['level'];
        if(($logged == false) ||($level =='adminx')) {
            session_destroy();
            header('location:'.URL.'login');
            exit;
        } 

        Auth::TimeLimit($_SESSION);
        
    }
    
    protected static function TimeLimit($data){
       $time = $data['dataLogin']['login_time']; 
       $Config = Mydb::getConfig();
       $maksTime = $Config->time->maksLogin;
       $endTime = strtotime($maksTime, strtotime($time));

       if(time() > $endTime ){
           $modelUserLogin = Mydb::getModelUserLogin();         
           $where = array();
           $where = $modelUserLogin->getAdapter()->quoteInto('id_user = ?', $data['dataLogin']['id_user']);
           $where = $modelUserLogin->getAdapter()->quoteInto('status = ?',1 );

           try{
               $data = array(
                   'status'=>0,
                   'last_login'=>$data['dataLogin']['login_time'],
               );
               $modelUserLogin->update($data, $where);
               if($modelUserLogin){
                   
                    @session_destroy();
               }
           } catch (Exception $ex) {
               echo $ex->getMessage();
           }
       }
    }
  
    
}