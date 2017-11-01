<?php

/**
 * Created by PhpStorm.
 * User: tient
 * Date: 24/10/2017
 * Time: 5:40
 */
Class MY_Controller extends CI_Controller
{
//transtion data to view
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        // $this->load->model(array('site_model', 'product_model', 'catelog_model'));
        $controler = $this->uri->segment(1);

        switch ($controler) {

            case 'admin': {
////                echo 'Bạn đang là admin';
                $this->load->helper('admin');
                $this->_check_login();
                break;
            }
//            case 'process': {
//                $this->load->helper('process');
//                break;
//            }
            default: {
                /* xử lý dữ liệu ở trang ngoài*/
//
//
//
//                $this->load->library('cart');
//                $this->data['total_rows'] = $this->cart->total_items();
            }

        }
    }
    /**Kiểm tra trạng thái đăng nhập của admin**/
    //   thuc hien kiem tra khi nguoi dung co tinh vao admin
    public function _check_login()
    {
        $controller = $this->uri->rsegment(1);
        $controller = strtolower($controller);

        //lay session
        $login = $this->session->userdata('admin');
        //khi chua dang nhap ma vao controller khac login thi cho quay lai cho dang nhap la bat buoc
        //giong nnhu vao nha thi phai mo cua chinh
        if (!$login && $controller != 'login') {
            redirect(admin_url('login'));
        }
        //neu ma da login roi ma dang nhap lai nua thi khong cho
        //giong nhu o trong nha roi thì khong duoc mo cua vao lai nha
        //cai nay la de phan quyen cho no khong dc tron lan cac quyen khac
        if (!empty($login) && $controller == 'login') {
            redirect(admin_url('home'));
        }
    }

    // thuc hien logout
    public function logout()
    {
        if ($this->session->userdata('admin')) {
//            $this->session->sess_destroy();
            $this->session->unset_userdata('admin');
        }
        redirect(admin_url('login'));
    }
}