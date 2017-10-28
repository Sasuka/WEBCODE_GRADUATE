<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 28/10/2017
 * Time: 15:29
 */
Class Login extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->load->view('admin/login/index');
    }
}