<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/10/2017
 * Time: 0:45
 */

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    public function index(){
        $input = array();
        $total = $this->admin_model->get_total();
        $this->data['total'] = $total;
        $list = $this->admin_model->getList($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/main',$this->data);
    }
    public function create(){


    }
    /*
     * Thêm quản trị viên
     * */
    public function add(){
        $this->data['listLevel'] = $this->admin_model->getListLevel();
        $this->load->library('form_validation');
        $this->load->helper('form');
        /*kiểm tra data khi post len*/
        if ($this->input->post()){
            $this->form_validation->set_rules('fname','Họ','min_length[2]');
            $this->form_validation->set_rules('lname','Tên',' min_length[2]');
            $this->form_validation->set_rules('password','Mật khẩu','min_length[2]');
            $this->form_validation->set_rules('re-pass','Nhập lại mật khẩu','matches[password]');


            if ($this->form_validation->run()){
                $ho = $this->input->post('fname',true);
                $ten = $this->input ->post('lname',true);
                $matkhau = $this->input->post('password',true);
                $sdt = $this->input->post('phone', true);
                $email = $this->input->post('email', true);
                $diachi = $this->input->post('address', true);
                $ngaysinh = $this->input->post('birthday', true);
                $ngaysinh = date('Y-m-d', strtotime($ngaysinh));//ep kieu them vao database
                $gioitinh = $this->input->post('gender');
                $chucvu = $this->input->post('level');

                $dt = array(
                    'HO' => $ho,
                    'TEN' => $ten,
                    'MATKHAU' => md5(md5($matkhau)),
//                    'MATKHAU' => $matkhau,
                    'SDT' => $sdt,
                    'EMAIL' => $email,
                    'DIACHI' => $diachi,
                    'NGAYSINH' => $ngaysinh,
                    'GIOITINH' => $gioitinh,
                    'MA_CHUCVU' => $chucvu
                );

                if ($_FILES['image']['name'] != '') {

                    $hinhanh = 'avatar/' . $_FILES['image']['name'];
                    $dt['HINHANH'] = $hinhanh;
                }

                if ($this->admin_model->add($dt)) {
                    //tao noi dung thong bao
                    echo 'Thêm thành công';
                    $this->session->set_flashdata('message', 'Thêm quản trị viên thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Thêm quản trị viên thất bại');
                    echo 'Them thất bại';
                }


            }

        }

        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);

    }






}
