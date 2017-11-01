<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 01/11/2017
 * Time: 12:56
 */
Class Providers extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('providers_model');
    }

    /*
   * Thực hiện kiểm tra nhà cung cấp này đã tồn tại hay chưa
   * */
    function check_provider_exists(){
        $providerName = $this->input->post('providerName', true);
        /*Viết hoa tên thương hiêu trươc khi check */

        $where = array('TEN_NHA_CUNGCAP' => $providerName);
        //kiem tra check_exists trong MY_MODEL
        if ($this->providers_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên nhà cung cấp này đã tồn tại');
            return false;
        } else
            return true;
    }
    /*
     * Thực hiện kiểm tra tên nhà cung cấp có bị trùng sau khi chỉnh sửa hay không
     * */
    function check_provider_update(){
        $providerName = $this->input->post('providerName', true);
        /*Viết hoa tên thương hiêu trươc khi check */

//        $this->id = $this->uri->segment('4');
//        $this->id = intval($this->id);
        $where = array('TEN_NHA_CUNGCAP' => $providerName,'MA_NHA_CUNGCAP'=>$this->id);
        if ($this->providers_model->check_exist($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Tên nhà cung cấp này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
    * Lấy ra danh sách các nhà cung cấp
    * */
    function index(){
        $input = array();
        $input['order'] = array('TRANGTHAI','DESC');
        $list = $this->providers_model->getList($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/providers/index';
        $this->load->view('admin/main', $this->data);
    }
    /*
    * Thêm mới nhà cung cấp.
    *
    * */
    function add(){
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');

        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('branh', 'Thương hiệu', 'min_length[2]|callback_check_branh_exists');
            if ($this->form_validation->run()) {
                $branh = $this->input->post('branh', true);
                $dt = array(
                    'TEN_THUONGHIEU' => $branh
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->branh_model->add($dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Thêm thương hiệu thành công!');
                    redirect(admin_url('branh'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm thương hiệu thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/providers/add';
        $this->load->view('admin/main', $this->data);
    }

}