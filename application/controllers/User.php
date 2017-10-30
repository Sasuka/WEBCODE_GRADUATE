<?php

class  User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
    }
    public function index(){
        echo 'User site';
    }
    //kiem tra so dien thoai da dang ky chua
    public function check_phone_exists()
    {
        $phone = $this->input->post('phone');
        $where = array('SDT' => $phone, 'MATKHAU !=' => '');
        //kiem tra table column phone
        if ($this->customer_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Số điện thoại này đã đăng ký');
            return false;
        } else
            return true;
    }

    //kiem tra so dien thoai da dang ky chua
    public function check_email_exists()
    {
        $email = $this->input->post('email');
        $where = array('EMAIL' => $email, 'MATKHAU !=' => '');
        //kiem tra check_exists trong MY_MODEL
        if ($this->customer_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Email này đã đăng ký');
            return false;
        } else
            return true;
    }

    /************REGISTER**************/
    public function register()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        echo "TaiLT6ssss";
        if ($this->input->post()) {
            //
            echo "TaiLT6 post";
            $ho = $this->input->post('fname', true);
            $ten = $this->input->post('lname', true);
            $matkhau = $this->input->post('password', true);
            $sdt = $this->input->post('phone', true);
            $email = $this->input->post('email', true);
            $address = $this->input->post('address', true);
            $gender = $this->input->post('gender', true);
            $birthday = $this->input->post('birthday', true);
            $dt = array(
                'HO' => $ho,
                'TEN' => $ten,
                'MATKHAU' => md5(md5($matkhau)),
                'SDT' => $sdt,
                'EMAIL' => $email,
                'DIACHI' => $address,
                'GIOITINH' => $gender,
                'NGAYSINH' => $birthday
            );
//            //    pre($dt);
//            //thuc hien kiem tra do co phai khach vang lai khong thong qua so dt hoac email
//            $condition = array('SDT' => $sdt, 'MATKHAU ' => '');
//            $checkClient = $this->customer_model->get_info_rule($condition);//  CLIENT DA DANG KY SDT
//
//            $condition1 = array('EMAIL' => $email, 'MATKHAU ' => '');
//            $checkClient1 = $this->customer_model->get_info_rule($condition1);//CLIENT DA DANG KY EMAIL
//            // pre($checkClient1);
//
//            $condition2 = array('EMAIL' => $email, 'SDT' => $sdt, 'MATKHAU ' => '');
//            $checkClient2 = $this->customer_model->get_info_rule($condition1);//CLIENT DA DANG KY EMAIL HOAC SDT
//
//            if (!empty($checkClient) || !empty($checkClient1) || !empty($checkClient2)) {
//                if (!empty($checkClient)) {
//                    //co nghia la khach vang lai dk thuc hien update dua theo so dien thoai hoac email
//                    $where = array('SDT' => $sdt);
//                    $dt = array(
//                        'HO' => $ho,
//                        'TEN' => $ten,
//                        'MATKHAU' => md5(md5($matkhau)),
//                        //     'SDT' => $sdt,
//                        'EMAIL' => $email,
//                        'DIACHI' => $address,
//                    );
//                    //  pre($checkClient);
//
//                } else if (!empty($checkClient1)) {
//                    //neu ton tai email
//                    $where = array('EMAIL' => $email);
//                    $dt = array(
//                        'HO' => $ho,
//                        'TEN' => $ten,
//                        'MATKHAU' => md5(md5($matkhau)),
//                        'SDT' => $sdt,
////                            'EMAIL' => $email,
//                        'DIACHI' => $address,
//                    );
//                    //   pre($checkClient1);
//
//                }else{
//                    //neu ton tai email va sdt
//                    $dt = array(
//                        'HO' => $ho,
//                        'TEN' => $ten,
//                        'MATKHAU' => md5(md5($matkhau)),
////                            'SDT' => $sdt,
////                            'EMAIL' => $email,
//                        'DIACHI' => $address,
//                    );
//                    $where = array('EMAIL' => $email,'SDT'=>$sdt);
//
//                }
            //   pre($dt);
//                if ($this->customer_model->update_rule($where, $dt)) {
//                    $this->session->set_flashdata('message', 'Đăng ký thành công!');
//                } else {
//                    $this->session->set_flashdata('message', 'Đăng ký thất bại');
//                }
//            } else {
            //dk moi
            if ($this->customer_model->add($dt)) {
                //tao noi dung thong bao
                $this->session->set_flashdata('message', 'Đăng ký thành công!');
            } else {
                $this->session->set_flashdata('message', 'Đăng ký thất bại');
            }
//            }
            redirect(site_url());
        }

        $this->data['temp'] = 'site/account/register';
        $this->load->view('site/layout', $this->data);

    }
    public function create($data = array())
    {
        $data['HO'] = 'Le Thanh';
        $data['TEN'] = 'Tuan';
        $data['SDT'] = '1234567890';
        $data['EMAIL'] = 'tta@f.com';
        $data['DIACHI'] = '2094 Ngyễn Đình Chiển.';
        $data['MATKHAU'] = md5(md5('password'));
        $data['NGAYSINH'] = '20/11/1988';
        $data['GIOITINH'] = '0';
        if ($this->customer_model->create($data)){
            echo 'Thêm thành công';
        }else{
            echo 'Thêm thất bại';
        }
    }
    public function update(){
        $where['MA_KHACHHANG'] = '2';
        $data['HO'] = 'Le TT';
        $data['TEN'] = 'Tai';
        $data['SDT'] = '1232352890';
        $data['EMAIL'] = 'tta@f.com';
        $data['DIACHI'] = '2094 Ngyễn Đình Chiển.';
        $data['MATKHAU'] = md5(md5('password'));
        $data['NGAYSINH'] = '20/11/1988';
        $data['GIOITINH'] = '0';
        if ($this->customer_model->update_rule($where,$data)){
            echo 'Cập nhật thành công';
        }else{
            echo 'Cập nhật thất bại';
        }
    }
    public function delete(){
        $where['MA_KHACHHANG'] = '2';
        if ($this->customer_model->del_rule($where)){
            echo 'Delete thành công';
        }else{
            echo 'Delete thất bại';
        }
    }
    public function get_info(){
        $where['MA_KHACHHANG'] = '3';

        $info = $this->customer_model->get_info_rule($where);
        echo '<pre>';
        print_r($info);
    }
    public function get_list(){
        $input = array();
        $input['select'] = 'TEN';
//        $input['where'] = array('TEN'=>'Tai');
        $input['order'] = array('TEN','desc');
     //   $input['like'] = array('TEN','T');
        $list = $this->customer_model->getList($input);
        pre($list);
    }
}