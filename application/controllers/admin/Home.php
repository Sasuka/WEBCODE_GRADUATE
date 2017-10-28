<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 28/10/2017
 * Time: 22:18
 */
Class Home extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->data['temp'] ='admin/home/index';
        $this->load->view('admin/main', $this->data);
    }
}