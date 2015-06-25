<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller {

    /**
     * @var null Database Connection
     * @value 'aaa';
     */
    public $db = null;
    public $array;
    protected $_request = null;
    protected $view;

    public function redirect($value) {
        header('Location: ' . URL . $value, true, 302);
    }

    public function views($controller, $action, $data) {
        if (!empty($data)) {
            $this->array = $data;
        }
//        $titlee  = '<title>$title</title>';
        require 'application/views/' . $controller . '/' . $action . '.html';
//        $this->load->view =$data;
    }

    protected function getRequest() {
        $param = $_GET['url'];
        $param = explode('/', $param);

        if (is_dir(APP_MODUL . DS . $param[0])) {
            $params['modules'] = (!empty($param[0]) ? $param[0] : 'index');
            $params['controller'] = (!empty($param[1]) ? $param[1] : 'index');
            $params['action'] = (!empty($param[2]) ? $param[2] : 'index');
            foreach ($param as $idx => $value) {
                if ($idx > 2) {
                    $params['params'][] = $value;
                }
            }
        }

        return $params;
    }

    protected function getPost() {
        $post = $_POST;
        return $post;
    }

    /**
     * 
     * @param type $params
     * @return type Array
     */
    protected function pr($params) {
        echo '<pre>';
        print_r($params);
        echo '</pre>';
        return $params;
    }

    protected function json_Format($param = array()) {
        $param = json_encode($param);
        return $param;
    }

    protected function title($title = null) {
        if (!empty($title)) {
            echo '<title>' . $title . '</title>';
        } else {
            echo '<title>Framework V-01</title>';
        }
    }

    protected function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    protected function generateNoKontrak($cabang,$length = 5) {
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = $cabang;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString .='-'.date('d');
        return $randomString;
    }

}
