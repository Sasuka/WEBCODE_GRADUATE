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
        $this->load->model('admin_model');
    }
    public function index(){
//        pre('xcvbn');
        $username = $this->session->userdata('username');
        $password = $this->session->userdata('password');
        $input = array('EMAIL'=>$username,'MATKHAU'=>$password);
        $info = $this->admin_model->getListJoinLRB('chucvu','MA_CHUCVU',$input);
       // pre($info[0]);
        $level = $this->admin_model->get_rule($info['MA_CHUCVU']);
        $this->session->set_userdata('level',$level[0]['TEN_CHUCVU']);
        $this->session->set_userdata('account',$info[0]);
        $this->data['temp'] = 'admin/home/index';//khung tieu de cua admin duoc giu lai
        $this->load->view('admin/main', $this->data);
    }
}