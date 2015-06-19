<?php

class Index extends Controller{
    public function index(){     
        Auth::handleLogin();
        $this->redirect('home');
    }
}
 