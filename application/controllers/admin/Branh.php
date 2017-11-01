<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 31/10/2017
 * Time: 23:01
 */

class Branh extends MY_Controller
{
    protected $id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('branh_model');
    }

    /*
     * Thực hiện kiểm tra tên thương hiệu này đã tồn tại hay chưa
     * */
    function check_branh_exists(){
        $branh = $this->input->post('branh', true);
        /*Viết hoa tên thương hiêu trươc khi check */

        $where = array('TEN_THUONGHIEU' => $branh);
        //kiem tra check_exists trong MY_MODEL
        if ($this->branh_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên thương hiệu này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
     * Thực hiện kiểm tra tên thương hiệu có bị trùng sau khi chỉnh sửa hay không
     * */
    function check_branh_update(){
        $branh = $this->input->post('branh', true);
        /*Viết hoa tên thương hiêu trươc khi check */
//        $this->id = $this->uri->segment('4');
//        $this->id = intval($this->id);
        $where = array('TEN_THUONGHIEU' => $branh, 'MA_THUONGHIEU !=' => $this->id);
        if ($this->branh_model->check_exist($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Tên thương hiệu này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
     * Lấy ra danh sách các thương hiệu sản phẩm
     * */
    function index(){
        $input = array();
        $input['order'] = array('TRANGTHAI','DESC');
        $list = $this->branh_model->getList($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/branh/index';
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

        $this->data['temp'] = 'admin/branh/add';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Cập nhật thương hiệu
     *
     * */
    function edit(){
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_THUONGHIEU' => $this->id);

        $info = $this->branh_model->get_info_rule($where);
        if (!$info){
            $this->session->set_flashdata('message', 'Không tìm thấy thương hiệu này!');
            redirect(admin_url('branh'));
        }
        $this->data['info'] = $info;



        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
           // pre($this->id);
            $this->form_validation->set_rules('branh', 'Thương hiệu', 'min_length[2]|callback_check_branh_update');

            if ($this->form_validation->run()) {
                $branh = $this->input->post('branh', true);
                $trangthai = $this->input->post('status',true);
                $dt = array(
                    'TEN_THUONGHIEU' => $branh,
                    'TRANGTHAI' => $trangthai
                );
                if ($this->branh_model->update_rule($where, $dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Cập nhật thành công!');
                    redirect(admin_url('branh'));
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/branh/edit';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Xóa thương hiệu
     * */
    function delete(){
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_THUONGHIEU' => $this->id);

        $info = $this->branh_model->get_info_rule($where);
        if (!$info){
            $this->session->set_flashdata('message', 'Không tìm thấy thương hiệu này!');
            redirect(admin_url('branh'));
        }
        /*Xóa bằng cách cập nhật lại trạng thái*/
        $dt = array(
            'TRANGTHAI' => 0
        );
        if ($this->branh_model->update_rule($where, $dt)) {
            //tao noi dung thong bao
            $this->session->set_flashdata('message', 'Xóa thành công! ');
            redirect(admin_url('branh'));
        } else {
            $this->session->set_flashdata('message', 'Xóa thất bại! ');
        }
    }

}