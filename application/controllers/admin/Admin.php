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
        $this->load->model('admin_model');
    }
    public function index(){
        $input = array();
        $total = $this->admin_model->get_total();
        $this->data['total'] = $total;
        $list = $this->admin_model->getList($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/main',$this->data);
    }
    public function create(){


    }
    /*
     * Thêm quản trị viên
     * */
    public function add(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        /*kiểm tra data khi post len*/
        if ($this->input->post()){
            $this->form_validation->set_rules('lname','Tên',' min_length[2]');
            $this->form_validation->set_rules('fname','Họ','min_length[2]');
            $this->form_validation->set_rules('password','Mật khẩu','min_length[2]');
            $this->form_validation->set_rules('re_pass','Nhập lại mật khẩu','matches[password]');


            if ($this->form_validation->run()){
                $ho = $this->input->post('fname',true);
                $ten = $this->input ->post('lname',true);
                $pass = $this->input->post('password',true);


            }

        }

        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);

    }






}
