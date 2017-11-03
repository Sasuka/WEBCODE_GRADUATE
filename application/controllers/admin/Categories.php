<?php

/**
 * Created by PhpStorm.
 * User: tient
 * Date: 02/11/2017
 * Time: 17:16
 */
Class Categories extends MY_Controller
{
    protected $tb = 'loai_sanpham';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('categories_model', 'branh_model', 'providers_model'));
    }

    /*
    * Thực hiện kiểm tra tên thương hiệu này đã tồn tại hay chưa
    * */
    function check_categories_exists()
    {
        $categories = $this->input->post('categories', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $categories = mb_strtoupper($categories, 'UTF-8');
        $where = array('TEN_LOAI_SANPHAM' => $categories);
        //kiem tra check_exists trong MY_MODEL
        if ($this->categories_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên loại sản phẩm này đã tồn tại');
            return false;
        } else
            return true;
    }

    function check_categories_update()
    {
        $categories = $this->input->post('categories', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $categories = mb_strtoupper($categories, 'UTF-8');
        $where = array('TEN_LOAI_SANPHAM' => $categories, 'MA_LOAI_SANPHAM!=' => $this->id);
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
        $select = 'MA_LOAI_SANPHAM,TEN_LOAI_SANPHAM,TEN_NHA_CUNGCAP,TEN_THUONGHIEU,' . $this->tb . '.TRANGTHAI,' . $this->tb . '.MA_NHA_CUNGCAP,' . $this->tb . '.MA_THUONGHIEU';
        $input['order'] = array('TRANGTHAI', 'DESC');
        $list = $this->categories_model->getListThreeJoin('nha_cungcap', 'MA_NHA_CUNGCAP', 'thuonghieu', 'MA_THUONGHIEU', '', $select);
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
                    'TEN_LOAI_SANPHAM' => mb_strtoupper($categories, 'UTF-8'),
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

    /*
    * Cập nhật thương hiệu sản phẩm
    *
    * */
    function edit()
    {
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');

        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_LOAI_SANPHAM' => $this->id);

        $info = $this->categories_model->get_info_rule($where);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy này!');
            redirect(admin_url('categories'));
        }
        $this->data['info'] = $info;


        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('categories', 'Loại sản phẩm', 'min_length[2]|callback_check_categories_update');
            if ($this->form_validation->run()) {
                $categories = $this->input->post('categories', true);
                $providers = $this->input->post('providers', true);
                $brand = $this->input->post('brand', true);
                $dt = array(
                    'TEN_LOAI_SANPHAM' => mb_strtoupper($categories, 'UTF-8'),
                    'MA_NHA_CUNGCAP' => $providers,
                    'MA_THUONGHIEU' => $brand
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->categories_model->update_rule($where, $dt)) {
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
        $this->data['temp'] = 'admin/categories/edit';
        $this->load->view('admin/main', $this->data);
    }

    /*
    * Xóa thương hiệu
    * */
    function delete()
    {
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_LOAI_SANPHAM' => $this->id);

        $info = $this->categories_model->get_info_rule($where);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy này!');
            redirect(admin_url('categories'));
        }
        /*Xóa bằng cách cập nhật lại trạng thái*/
        $dt = array(
            'TRANGTHAI' => 0
        );
        if ($this->categories_model->update_rule($where, $dt)) {
            //tao noi dung thong bao
            $this->session->set_flashdata('message', 'Xóa thành công! ');
            //  pre($this->categories_model->getList());
            redirect(admin_url('categories'));
        } else {
            $this->session->set_flashdata('message', 'Xóa thất bại! ');
        }
    }
}