<?php

/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/9/2017
 * Time: 22:13
 * Trang Home giao diện người dùng.
 */
Class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');

    }

    //lay ma chuc vu
    public function index()
    {

        $this->data['temp'] = 'site/home/index';
        $this->load->view('site/layout',$this->data);
    }

    function view()
    {
        $this->load->view('site/home/view');
    }
}