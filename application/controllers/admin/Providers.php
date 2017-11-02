<?php

/**
 * Created by PhpStorm.
 * User: tient
 * Date: 01/11/2017
 * Time: 12:56
 */
Class Providers extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('providers_model');
    }

    /*
   * Thực hiện kiểm tra tên nhà cung cấp này đã tồn tại hay chưa
   * */
    function check_provider_exists()
    {
        $providerName = $this->input->post('providerName', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $providerName = strtoupper($providerName);
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
     * Kiểm tra số điện thoại nhà cung cấp đã tồn tại hay chưa
     * */
    function check_phone_exists()
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

    /*
     * Kiểm tra mail này đã đăng ký hay chưa.
     * */
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
     * Thực hiện kiểm tra tên nhà cung cấp có bị trùng sau khi chỉnh sửa hay không
     * */
    function check_provider_update()
    {
        $providerName = $this->input->post('providerName', true);
        /*Viết hoa tên thương hiêu trươc khi check */
        $providerName = strtoupper($providerName);
        $where = array('TEN_NHA_CUNGCAP' => $providerName, 'MA_NHA_CUNGCAP !=' => $this->id);
        if ($this->providers_model->check_exist($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Tên nhà cung cấp này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
    * Thực hiện kiểm tra phone có bị trùng sau khi chỉnh sửa hay không
    * */
    function check_phone_update()
    {
        $phone = $this->input->post('phone', true);
        /*Viết hoa tên thương hiêu trươc khi check */

        $where = array('SDT' => $phone, 'MA_NHA_CUNGCAP !=' => $this->id);
        if ($this->providers_model->check_exist($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Số điện thoại này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
       * Thực hiện kiểm tra email có bị trùng sau khi chỉnh sửa hay không
       * */
    function check_email_update()
    {
        $email = $this->input->post('email', true);
        /*Viết hoa tên thương hiêu trươc khi check */

        $where = array('EMAIL' => $email, 'MA_NHA_CUNGCAP !=' => $this->id);
        if ($this->providers_model->check_exist($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Email này đã tồn tại');
            return false;
        } else
            return true;
    }

    /*
    * Lấy ra danh sách các nhà cung cấp
    * */
    function index()
    {
        $input = array();
        $input['order'] = array('TRANGTHAI', 'DESC');
        $list = $this->providers_model->getList($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/providers/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
    * Thêm mới nhà cung cấp.
    *
    * */
    function add()
    {
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            /*kiểm tra data khi post len*/
            $this->form_validation->set_rules('providerName', 'Tên nhà cung cấp', 'min_length[2]|callback_check_provider_exists');
            $this->form_validation->set_rules('website', 'Webiste nhà cung cấp', '');
            $this->form_validation->set_rules('phone', 'Số điện thoại nhà cung cấp', 'min_length[12]|callback_check_phone_exists');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|callback_check_email_exists');
            if ($this->form_validation->run()) {
                $providerName = strtoupper($this->input->post('providerName', true));
                $website = $this->input->post('website', true);
                $phone = $this->input->post('phone', true);
                $email = $this->input->post('email', true);
                $address = $this->input->post('address', true);

                $dt = array(
                    'TEN_NHA_CUNGCAP' => $providerName,
                    'WEBSITE' => $website,
                    'DIACHI_NHA_CUNGCAP' => $address,
                    'SDT' => $phone,
                    'EMAIL' => $email
                );
                /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

                if ($this->providers_model->add($dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Thêm thành công!');
                    redirect(admin_url('providers'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/providers/add';
        $this->load->view('admin/main', $this->data);
    }

    /*
    * Cập nhật nhà cung cấp
    * Được phép cập nhật Trạng thái,tên, SDT, email,địa chỉ
     * Chỉ được phép cập nhật không tên chưa tồn tại và chưa chứa loại.
    * */
    function edit()
    {
        /*load ra form validate dữ liệu */
        $this->load->library('form_validation');
        $this->load->helper('form');
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_NHA_CUNGCAP' => $this->id);

        $info = $this->providers_model->get_info_rule($where);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy !');
            redirect(admin_url('providers'));
        }
        $this->data['info'] = $info;

        if ($this->input->post()) {
            /*kiểm tra data khi post len*/
            $this->form_validation->set_rules('providerName', 'Tên nhà cung cấp', 'min_length[2]|callback_check_provider_update');
            $this->form_validation->set_rules('website', 'Webiste nhà cung cấp', '');
            $this->form_validation->set_rules('phone', 'Số điện thoại nhà cung cấp', 'min_length[12]|callback_check_phone_update');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|callback_check_email_update');

            if ($this->form_validation->run()) {
                $providerName = $this->input->post('providerName', true);
                $website = $this->input->post('website', true);
                $phone = $this->input->post('phone', true);
                $email = $this->input->post('email', true);
                $address = $this->input->post('address', true);
                $status = $this->input->post('status', true);
                $dt = array(
                    'TEN_NHA_CUNGCAP' => strtoupper($providerName),
                    'WEBSITE' => strtolower($website),
                    'DIACHI_NHA_CUNGCAP' => $address,
                    'SDT' => $phone,
                    'EMAIL' => $email,
                    'TRANGTHAI' => $status
                );

                if ($this->providers_model->update_rule($where, $dt)) {
                    //tao noi dung thong bao
                    $this->session->set_flashdata('message', 'Cập nhật thành công!');
                    redirect(admin_url('providers'));
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thất bại');
                }
            }
        }

        $this->data['temp'] = 'admin/providers/edit';
        $this->load->view('admin/main', $this->data);
    }

    /*
       * Xóa cung cấp
     * Update status =2 về 0 là hết hoạt động
     * Nếu status =1 thí xóa khỏi db( chưa lập phiếu nhập, chưa gán loại sản phẩm)
       * */
    function delete()
    {
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_NHA_CUNGCAP' => $this->id);

        $info = $this->providers_model->get_info_rule($where);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy thương hiệu này!');
            redirect(admin_url('providers'));
        }
        if ($info['TRANGTHAI'] == '2') {
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
        } elseif ($info['TRANGTHAI'] == '1') {
            if ($this->providers_model->del_rule($where)) {
                //tao noi dung thong bao
                $this->session->set_flashdata('message', 'Xóa thành công! ');
                redirect(admin_url('providers'));
            } else {
                $this->session->set_flashdata('message', 'Xóa thất bại! ');
            }
        }
    }

}