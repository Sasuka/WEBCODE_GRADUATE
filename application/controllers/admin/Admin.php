<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/10/2017
 * Time: 0:45
 */

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function create(){
        $this->load->model('admin_model');
        $data = array();
        $data['fname'] = 'Le Thanh';
        $data['lname'] = 'Tuan';
        $data['phone'] = '1234567890';
        $data['emai'] = 'tta@f.com';
        $data['address'] = '2094 Ngyễn Đình Chiển.';
        $data['password'] = md5(md5('password'));
        $data['birthday'] = '20/11/1988';
        $data['gender'] = '0';

    }






}
