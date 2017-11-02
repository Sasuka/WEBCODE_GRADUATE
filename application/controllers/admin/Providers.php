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
    function check_providers_exists(){
        $providerName = $this->input->post('providerName', true);
        /*Viết hoa tên thương hiêu trươc khi check */

        $where = array('TEN_NHA_CUNGCAP' => strtoupper($providerName));
        //kiem tra check_exists trong MY_MODEL
        if ($this->providers_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Tên nhà cung cấp này đã tồn tại');
            return false;
        } else
            return true;
    }
    //kiem tra so dien thoai da dang ky chua
    public function check_phone_exists()
    {
        $phone = $this->input->post('phone');
        $where = array('SDT' => $phone);
        //kiem tra table column phone
        if ($this->providers_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Số điện thoại này đã đăng ký');
            return false;
        } else
            return true;
    }

    //kiem tra email da dang ky chua
    public function check_email_exists()
    {
        $email = $this->input->post('email', true);
        $where = array('EMAIL' => $email);
        //kiem tra check_exists trong MY_MODEL
        if ($this->providers_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Email này đã đăng ký');
            return false;
        } else
            return true;
    }
    /*
     *  Kiểm tra tên loại sản phẩm đã tồn tại hay chưa để update
     *
     * */
    function check_providers_update(){
        $providerName = $this->input->post('providerName', true);
        /*Viết hoa tên thương hiêu trươc khi check */
//        $this->id = $this->uri->segment('4');
//        $this->id = intval($this->id);
        $where = array('TEN_NHA_CUNGCAP' => mb_strtoupper($providerName, 'UTF-8'), 'MA_NHA_CUNGCAP !=' => $this->id);
        if ($this->providers_model->check_exist($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Field này đã tồn tại');
            return false;
        } else
            return true;
    }

    /***kiem tra so dien thoai da dang ky chua de update***/
    public function check_phone_update()
    {
        $phone = $this->input->post('phone', true);
        $where = array('SDT =' => $phone, 'MA_NHA_CUNGCAP !=' => $this->id);
        //kiem tra table column phone
        if ($this->providers_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Số điện thoại này đã đk rồi');
            return false;
        } else
            return true;
    }

    //kiem tra so dien thoai da dang ky chua de update
    public function check_email_update()
    {
        $email = $this->input->post('email');
        $where = array('EMAIL =' => $email, 'MA_NHA_CUNGCAP !=' => $this->id);
        //kiem tra check_exists trong MY_MODEL
        if ($this->providers_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Email này đã đăng ký');
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
            $this->form_validation->set_rules('providerName', 'Tên nhà cung cấp', 'min_length[2]|callback_check_providers_exists');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'min_length[2]|callback_check_phone_exists');
            $this->form_validation->set_rules('email', 'Email', 'min_length[2]|callback_check_email_exists');
            if ($this->form_validation->run()) {
                $providerName = $this->input->post('providerName', true);
                $website = $this->input->post('website', true);
                $phone = $this->input->post('phone', true);
                $email = $this->input->post('email', true);
                $address = $this->input->post('address', true);
                $dt = array(
                    'TEN_NHA_CUNGCAP' => mb_strtoupper($providerName, 'UTF-8'),
                    'WEBSITE' =>$website,
                    'SDT' =>$phone,
                    'EMAIL' =>$email,
                    'DIACHI_NHA_CUNGCAP' => $address,
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->providers_model->add($dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Thêm nhà cung cấp thành công!');
                    redirect(admin_url('providers'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm nhà cung cấp thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/providers/add';
        $this->load->view('admin/main', $this->data);
    }
    /*
    * Cập nhật nhà cung cấp
    *
    * */
    function edit(){
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_NHA_CUNGCAP' => $this->id);

        $info = $this->providers_model->get_info_rule($where);
        if (!$info){
            $this->session->set_flashdata('message', 'Không tìm thấy !');
            redirect(admin_url('providers'));
        }
        $this->data['info'] = $info;



        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('providerName', 'Tên nhà cung cấp', 'min_length[2]|callback_check_providers_update');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'min_length[2]|callback_check_phone_update');
            $this->form_validation->set_rules('email', 'Email', 'min_length[2]|callback_check_email_update');
            if ($this->form_validation->run()) {
                $providerName = $this->input->post('providerName', true);
                $website = $this->input->post('website', true);
                $phone = $this->input->post('phone', true);
                $email = $this->input->post('email', true);
                $address = $this->input->post('address', true);

                $dt = array(
                    'TEN_NHA_CUNGCAP' =>  mb_strtoupper($providerName, 'UTF-8'),
                    'WEBSITE' =>$website,
                    'SDT' =>$phone,
                    'EMAIL' =>$email,
                    'DIACHI_NHA_CUNGCAP' => $address,

                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->providers_model->_update($dt, $where)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Update thành công!');
                    redirect(admin_url('providers'));
                } else {
                    $this->session->set_flashdata('message', 'Update thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/providers/edit';
        $this->load->view('admin/main', $this->data);
    }
    /*
    * Xóa nhà cung cấp
    * */
    function delete(){
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_NHA_CUNGCAP' => $this->id);

        $info = $this->providers_model->get_info_rule($where);
        if (!$info){
            $this->session->set_flashdata('message', 'Không tìm thấy !');
            redirect(admin_url('providers'));
        }
        if ($info['TRANGTHAI'] == '1'){
            // chưa cung cấp loại or nhập hàng
            if($this->providers_model->del_rule($where)){
                $this->session->set_flashdata('message', 'Xóa thành công! ');
                redirect(admin_url('providers'));
            }else{
                $this->session->set_flashdata('message', 'Xóa thất bại! ');
            }
        }elseif ($info['TRANGTHAI'] == '2') {
            /*Xóa bằng cách cập nhật lại trạng thái*/
            $dt = array(
                'TRANGTHAI' => 0
            );
            if ($this->providers_model->update_rule($where, $dt)) {
                //tao noi dung thong bao
                $this->session->set_flashdata('message', 'Xóa thành công! ');
                redirect(admin_url('providers'));
            } else {
                $this->session->set_flashdata('message', 'Xóa thất bại! ');
            }
        }
    }


}