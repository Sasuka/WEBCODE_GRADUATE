<?php

/**
 * Created by PhpStorm.
 * User: tient
 * Date: 02/11/2017
 * Time: 17:16
 */
Class Categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('categories_model','branh_model','providers_model'));
    }

    /*
    * Thực hiện kiểm tra tên thương hiệu này đã tồn tại hay chưa
    * */
    function check_categories_exists()
    {
        $categories = $this->input->post('categories', true);
        /*Viết hoa tên thương hiêu trươc khi check */

        $where = array('TEN_LOAI_SANPHAM' => $categories);
        //kiem tra check_exists trong MY_MODEL
        if ($this->categories_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên loại sản phẩm này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
     * Lấy ra danh sách loại sản phẩm.
     * */
    function index()
    {
        $input = array();
        $input['order'] = array('TRANGTHAI', 'DESC');
        $list = $this->categories_model->getListThreeJoin('nha_cungcap', 'MA_NHA_CUNGCAP', 'thuonghieu', 'MA_THUONGHIEU', '');
        //  pre($list);
        $this->data['list'] = $list;

        $this->data['temp'] = 'admin/categories/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Thêm mới thương hiệu sản phẩm
     *
     * */
    function add()
    {
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');

        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('categories', 'Loại sản phẩm', 'min_length[2]|callback_check_categories_exists');
            if ($this->form_validation->run()) {
                $categories = $this->input->post('categories', true);
                $providers = $this->input->post('providers', true);
                $brand = $this->input->post('brand', true);
                $dt = array(
                    'TEN_LOAI_SANPHAM' => $categories,
                    'MA_NHA_CUNGCAP' => $providers,
                    'MA_THUONGHIEU' => $brand
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->categories_model->add($dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Thêm loại sản phẩm thành công!');
                    redirect(admin_url('categories'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm loại sản phẩm thất bại');
                }
            }
        }
        $this->data['providers'] = $this->providers_model->getList();
        $this->data['brand'] = $this->branh_model->getList();
        $this->data['temp'] = 'admin/categories/add';
        $this->load->view('admin/main', $this->data);
    }
}