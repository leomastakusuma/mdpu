<?php

/**
 * MDPU Finance
 * @category   Modules
 * @package    Login
 * @subpackage Controller
 * @filesource Indexcontroller.php
 */
class indexcontroller extends Controller {

    protected $_modelUser;
    protected $_modelUserLogin;

    public function __construct() {
        Session::init();
        $this->_modelUser = Mydb::getModelUser();
        $this->_modelUserLogin = Mydb::getModelUserLogin();
    }

    public function index() {
        include APP_MODUL . '/login/form/login.html';
    }

    public function login() {   
        $form = $this->getPost();

        if (empty($form['username']) || empty(sha1($form['password']))) {
            $message = 'USERNAME OR Password is Empty ';
            include APP_MODUL . '/login/form/login.html';
        } else {
            /* Start For Check Eksis User */
            $login = $this->_modelUser->login($form['username'], sha1($form['password']));

            if (empty($login)) {
                $message = 'USER NOT FOUND !!!';
                include APP_MODUL . '/login/form/login.html';
            } else {
                /* For Check User Login or Not */
                $cekStatus = $this->_modelUser->ceklogin($login['id_user']);
                if (!empty($cekStatus['status'] == 1)) {
                    $message = 'USER IS Login On IP ' . $cekStatus['ip_login'] . '<br/> Time ' . $cekStatus['last_login'];
                    include APP_MODUL . '/login/form/login.html';
                }

                if (empty($cekStatus)) {
                    $data = array(
                        'id_user' => $login['id_user'],
                        'last_login' => new Zend_Db_Expr('NOW()'),
                        'login_time' => new Zend_Db_Expr('NOW()'),
                        'ip_login' => $_SERVER['REMOTE_ADDR'],
                        'status' => 1
                    );
                    try {
                        $this->_modelUserLogin->insert($data);
                        
                        if (count($login > 0)) {
                            Session::set('logged', true);
                            Session::set('level', $login['level']);
                            Session::set('dataLogin', $cekStatus);
                            $this->redirect('home');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                    }
                }
                if (isset($cekStatus['status']) && $cekStatus['status'] == 0) {
                    $where = $this->_modelUserLogin->getAdapterUpdate()->quoteInto('id_user = ?', $cekStatus['id_user']);
                    $data = array(
                        'status' => 1,
                        'login_time' => new Zend_Db_Expr('NOW()'),
                        'ip_login' => $_SERVER['REMOTE_ADDR'],
                        'last_login' => $cekStatus['login_time'],
                    );

                    try {
                        $this->_modelUserLogin->update($data, $where);
                        $cekStatus = $this->_modelUser->ceklogin($login['id_user']);
                        Session::set('logged', true);
                        Session::set('level', $login['level']);
                        Session::set('dataLogin', $cekStatus);
                        $this->redirect('home');
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                    }
                }

                /* End Check User */
            }
        }
    }

    public function logout() {
        if (!empty($_SESSION))
            $data = $_SESSION;
        $where = $this->_modelUserLogin->getAdapterUpdate()->quoteInto('id_user =?', $data['dataLogin']['id_user']);
        try {
            $this->_modelUserLogin->update(array('status' => 0), $where);
            Session::destroy();
            $this->redirect('login');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
