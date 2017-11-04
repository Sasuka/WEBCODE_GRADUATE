<?php

Class Warehouse extends MY_Controller
{
    protected $tb1 = 'nhanvien';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('warehouse_model');
    }

    /*
    * Thực hiện kiểm tra tên thương hiệu này đã tồn tại hay chưa
    * */
    function check_warehouse_exists(){
        $warehouse = $this->input->post('warehouse', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $warehouse = ucwords($warehouse);
        $where = array('TEN_KHO' => $warehouse);
        //kiem tra check_exists trong MY_MODEL
        if ($this->warehouse_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên kho này đã tồn tại');
            return false;
        } else
            return true;
    }
    /*
     *  Kiếm tra vị trí đã tồn tại hay chưa
     * */
    function check_place_exists(){
        $place = $this->input->post('place', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $place = ucfirst($place);
        $where = array('VITRI' => $place);
        //kiem tra check_exists trong MY_MODEL
        if ($this->warehouse_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Vị trí này đã tồn tại');
            return false;
        } else
            return true;
    }


    /*
     * Lấy ra danh sách các thương hiệu sản phẩm
     * */
    function index()
    {
        $input = array();
        $list = $this->warehouse_model->getListJoinLRB($this->tb1, 'MA_NHANVIEN',$where = array(), $lrb = 'left',$select = '*');
        $this->data['list'] = $list;
     //   pre($list);
        $this->data['temp'] = 'admin/warehouse/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Thêm mới kho
     *
     * */
    function add()
    {
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');

        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('warehouse', 'Tên Kho', 'min_length[2]|callback_check_warehouse_exists');
            $this->form_validation->set_rules('place', 'Tên Kho', 'min_length[2]|callback_check_place_exists');
            if ($this->form_validation->run()) {
                $warehouse = $this->input->post('warehouse', true);
                $place = $this->input->post('place', true);
                $id = $this->input->post('id', true);
                $dt = array(
                    'TEN_KHO' => ucwords($warehouse),
                    'VITRI' => ucwords($place),
                    'MA_NHANVIEN' => $id
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->warehouse_model->add($dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Thêm kho thành công!');
                    redirect(admin_url('warehouse'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm kho thất bại');
                }
            }
        }
        $this->data['temp'] = 'admin/warehouse/add';
        $this->load->view('admin/main', $this->data);
    }
}
