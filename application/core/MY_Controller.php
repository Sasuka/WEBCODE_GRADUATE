<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 24/10/2017
 * Time: 5:40
 */
Class MY_Controller extends CI_Controller{
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
//                $this->load->helper('admin');
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
    private function _check_login(){

    }
}