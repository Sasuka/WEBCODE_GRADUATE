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
        $this->data['listLevel'] = $this->admin_model->getListLevel();
    }

    public function index($type = '2')
    {
        $input = array();
        if($type == '2')
            $where = array('nhanvien.MA_CHUCVU !=' => 1);
        elseif ($type == '1'){
            $where = array('nhanvien.MA_CHUCVU' => 1);
        }
        $this->data['type'] = $type;
        $this->data['list'] =  $this->admin_model->listEmployee($where);
        $this->data['temp'] = 'admin/admin/index/'.$type;
        $this->load->view('admin/main', $this->data);
    }

    public function create()
    {


    }

    //kiem tra so dien thoai da dang ky chua
    public function check_phone_exists()
    {
        $phone = $this->input->post('phone');
        $where = array('SDT' => $phone);
        //kiem tra table column phone
        if ($this->admin_model->check_exists($where, 'nhanvien')) {
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
        if ($this->admin_model->check_exists($where, 'nhanvien')) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Email này đã đăng ký');
            return false;
        } else
            return true;
    }

    /***kiem tra so dien thoai da dang ky chua de update***/
    public function check_phone_update()
    {
        $phone = $this->input->post('phone', true);
        $where = array('SDT =' => $phone, 'MA_NHANVIEN !=' => $this->id);
        //kiem tra table column phone
        if ($this->admin_model->check_exists($where, 'nhanvien')) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Số điện thoại này thành viên khác đã đk rồi');
            return false;
        } else
            return true;
    }

    //kiem tra so dien thoai da dang ky chua de update
    public function check_email_update()
    {
        $email = $this->input->post('email');
        $where = array('EMAIL =' => $email, 'MA_NHANVIEN !=' => $this->id);
        //kiem tra check_exists trong MY_MODEL
        if ($this->admin_model->check_exist($where)) {
            //return error
            $this->form_validation->set_message(__FUNCTION__, 'Email này đã đăng ký');
            return false;
        } else
            return true;
    }
    //kiem tra so dien thoai co ai dang ky chua

    //==================== THÊM QUAN TRỊ VIÊN =======================//
    public function add($type = '1')
    {

        $this->load->library('form_validation');
        $this->load->helper('form');

        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $this->form_validation->set_rules('fname', 'Họ', 'min_length[2]');
            $this->form_validation->set_rules('lname', 'Tên', 'min_length[2]');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'min_length[2]');
            $this->form_validation->set_rules('re-pass', 'Nhập lại mật khẩu', 'matches[password]');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'min_length[9]|callback_check_phone_exists');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|callback_check_email_exists');
            if ($this->form_validation->run()) {
                $ho = $this->input->post('fname', true);
                $ten = $this->input->post('lname', true);
                $matkhau = $this->input->post('password', true);
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
                    $this->session->set_flashdata('message', 'Thêm quản trị viên thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Thêm quản trị viên thất bại');
                    echo 'Them thất bại';
                }
                //chuyen toi trang quan trị viên
                if ($chucvu == 1) {
                    redirect(admin_url('admin'));
                } else {

                    redirect(admin_url('admin/employee/2'));

                }
            }
        }
        $this->data['type'] = $type;
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
    }

    //==================== EDIT QUAN TRỊ VIÊN =======================//
    public function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        //lay id cua quan trị viên cần chỉnh sửa
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        //lấy thong tin của quản trị viên
        $where = array('MA_NHANVIEN' => $this->id);
        $info = $this->admin_model->getListJoinLRB('chucvu', 'MA_CHUCVU', $where);
        if (sizeof($info) == 0) {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên này!');
            redirect(admin_url('admin'));
        }
        $this->data['level'] = $this->admin_model->getListLevel();
        $this->data['info'] = $info;

        if ($this->input->post()) {

            $this->form_validation->set_rules('fname', 'Họ', 'required|min_length[2]');
            $this->form_validation->set_rules('lname', 'Tên', 'required|min_length[2]');

            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[9]|callback_check_phone_update');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_update');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('birthday', 'Ngày sinh', 'required');
            $this->form_validation->set_rules('gender', 'Giới tính', 'required');
            $this->form_validation->set_rules('level', 'Chức vụ', 'required');
            //kiem tra neu co nhap mat khau
            $password = $this->input->post('password');
            if ($password) {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[2]');
                $this->form_validation->set_rules('re-pass', 'Nhập lại mật khẩu', 'matches[password]');
            }

            if ($this->form_validation->run()) {

//              //thuc thi khi ham kiem tra xong dieu kien
//                $this->id = $this->input->post('id');
                $ho = $this->input->post('fname',true);
                $ten = $this->input->post('lname');
                $sdt = $this->input->post('phone');
                $email = $this->input->post('email');
                $diachi = $this->input->post('address');
                $ngaysinh = $this->input->post('birthday');
                $ngaysinh = date('Y-m-d', strtotime($ngaysinh));//ep kieu them vao database
                $gioitinh = $this->input->post('gender');
                $chucvu = $this->input->post('level');
                $trangthai = $this->input->post('status');

                $dt = array(
                    'HO' => $ho,
                    'TEN' => $ten,
                    'SDT' => $sdt,
                    'EMAIL' => $email,
                    'DIACHI' => $diachi,
                    'NGAYSINH' => $ngaysinh,
                    'GIOITINH' => $gioitinh,
                    'MA_CHUCVU' => $chucvu,
                    'TRANGTHAI' => $trangthai
                );
                //    pre($dt);
                //neu co  nhap mat khau thi cap nhat lai mat khau
                if ($password) {
                    $dt['MATKHAU'] = md5(md5($password));
                }
                $where = array('MA_NHANVIEN' => $this->id);
                if ($this->admin_model->_update($dt, $where))
                    $this->session->set_flashdata('message', 'Update thành công!');
                else {
                    $this->session->set_flashdata('message', 'Update thất bại');

                }
                // pre($info);
                if ($info[0]['TEN_CHUCVU'] == 'Admin') {
                    redirect(admin_url('admin/employee/1'));
                } else {
                    redirect(admin_url('admin/employee/2'));
                }
            }
        }

        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main', $this->data);
    }

    //==================== XOA QUAN TRỊ VIÊN =======================//
    public function delete()
    {
        $this->id = $this->uri->segment(4);
        $this->id = intval($this->id);
        $where = array('MA_NHANVIEN' => $this->id);

        //lay thong tin cua quan tri kiem tra xem co ton tai hay khong
        $info = $this->admin_model->get_info_rule($where, $filed = 'MA_NHANVIEN,MA_CHUCVU');
        // pre($info);
        if (sizeof($info) == 0) {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên này!');
            if ($info['MA_CHUCVU'] == '1') {
                redirect(admin_url('admin'));
            } else {
                redirect(admin_url('admin/employee'));
            }
        }
        //thuc hien xoa
        $data = array('TRANGTHAI' => '0');//hang nay ngung kinh doanh
        if ($this->admin_model->update_rule($where, $data)) {
            $this->session->set_flashdata('message', 'Delete success!');
        } else {
            $this->session->set_flashdata('message', 'Delete Fail!');
        }
        // pre($info);
        if ($info['MA_CHUCVU'] == '1') {
            redirect(admin_url('admin/employee/1'));
        } else {
            redirect(admin_url('admin/employee/2'));
        }
    }

    //================= SHOW DANH SACH NHAN VIEN ================//
    public function employee($type = '1')
    {
        //thuc hien load danh sach nhan vien dau tien
        if ($type == '1')
            $where = array('nhanvien.MA_CHUCVU =' => 1);
        else
            $where = array('nhanvien.MA_CHUCVU !=' => 1);
        $this->data['list'] = $this->admin_model->listEmployee($where);
       // pre($this->data['listEmployee']);
        //lay noi dung cua messager
        $this->data['type'] = $type;
        $this->data['message'] = $this->session->flashdata('message');

        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/main', $this->data);
    }

    public function test($select = '*',$typeId='',$compare = true){
        echo $select." asa ".$typeId." name ".$compare;
    }


}
