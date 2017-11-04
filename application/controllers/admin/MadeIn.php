<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 04/11/2017
 * Time: 13:50
 */
Class MadeIn extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('madein_model');
    }
    /*
   * Thực hiện kiểm tra tên này đã tồn tại hay chưa
   * */
    function check_madein_exists(){
        $madein = $this->input->post('madein', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $madein = ucwords($madein);
        $where = array('TEN_XUATXU' => $madein);
        //kiem tra check_exists trong MY_MODEL
        if ($this->madein_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
     * Lấy ra danh sách các xuất xứ
     * */
    function index(){
        $input = array();
        $list = $this->madein_model->getList();
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/madein/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
    * Thêm mới thương hiệu sản phẩm
    *
    * */
    function add(){
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');

        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('madein', 'Tên xuất xứ', 'min_length[2]|callback_check_madein_exists');
            if ($this->form_validation->run()) {
                $madein = $this->input->post('madein', true);
                $dt = array(
                    'TEN_XUATXU' => ucwords($madein)
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->madein_model->add($dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Thêm thành công!');
                    redirect(admin_url('madein'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/madein/add';
        $this->load->view('admin/main', $this->data);
    }

}