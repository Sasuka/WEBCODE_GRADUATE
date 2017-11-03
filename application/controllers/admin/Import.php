<?php


Class Import extends MY_Controller
{
    protected $tb = 'nha_cungcap';
    protected $tb1 = 'phieunhap';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('import_model', 'providers_model'));
    }

    /*
    * Lấy ra danh sách các phiếu nhập
    * */
    function index()
    {
        $input = array();
        $input['order'] = array('TRANGTHAI', 'DESC');
        $select = 'MA_PHIEUNHAP,NGAYLAP_PHIEUNHAP,TONG_THANHTIEN,TIEN_TRATRUOC,NGAY_PHAITRA,HO,TEN,TEN_NHA_CUNGCAP,' . $this->tb . '.MA_NHA_CUNGCAP,' . $this->tb1 . '.TRANGTHAI,' . $this->tb1 . '.MA_NHANVIEN';
        $order = 'MA_PHIEUNHAP';
        $list = $this->import_model->getListThreeJoin('nhanvien', 'MA_NHANVIEN', 'nha_cungcap', 'MA_NHA_CUNGCAP', '', $select, $order);
//        if ($this->input->post()) {
//            $providers = $this->input->post('providers', true);
//            $cost = $this->input->post('cost', true);
//            $promissDate = $this->input->post('promissDate', true);
//            $employeCode = $this->input->post('employeCode', true);
//            $dt = array(
//                'MA_NHA_CUNGCAP' => $providers,
//                'MA_NHANVIEN' => $employeCode,
//                'TIEN_TRATRUOC' => $cost,
//                'NGAY_PHAITRA' => $promissDate
//            );
//
//
//        }

      //  pre($list);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/import/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Thêm mới nhà cung câp
     *
     * */
    function add()
    {
        /*load ra form validate dữ liệu */
        $input = array();
        $this->load->library('form_validation');
        $this->load->helper('form');

        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $providers = $this->input->post('providers', true);
            $cost = $this->input->post('cost', true);
            $promissDate = $this->input->post('promissDate', true);
            $employeCode = $this->input->post('employeCode', true);
            $dt = array(
                'MA_NHA_CUNGCAP' => $providers,
                'MA_NHANVIEN' => $employeCode,
                'TIEN_TRATRUOC' => $cost,
                'NGAY_PHAITRA' =>  date('Y-m-d', strtotime($promissDate))
            );
            /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

            if ($this->import_model->add($dt)) {
                //tao noi dung thong bao
                $this->session->set_flashdata('message', 'Thêm thành công!');
                redirect(admin_url('import'));
            } else {
                $this->session->set_flashdata('message', 'Thêm thất bại');
            }

        }
        $input['where'] = array('TRANGTHAI !=' =>0);
        $this->data['providers'] = $this->providers_model->getList($input);
       // pre($this->data['providers']);
        $this->data['temp'] = 'admin/import/add';
        $this->load->view('admin/main', $this->data);
    }
    /*
    *Cập nhật nhà cung câp
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
        $where = array('MA_PHIEUNHAP' => $this->id);

        $info = $this->import_model->get_info_rule($where);
        if (!$info){
            $this->session->set_flashdata('message', 'Không tìm thấy này!');
            redirect(admin_url('import'));
        }
        $this->data['info'] = $info;
        /*kiểm tra data khi post len*/
        if ($this->input->post()) {
            $providers = $this->input->post('providers', true);
            $cost = $this->input->post('cost', true);
            $promissDate = $this->input->post('promissDate', true);
            $employeCode = $this->input->post('employeCode', true);
            $dt = array(
                'MA_NHA_CUNGCAP' => $providers,
                'MA_NHANVIEN' => $employeCode,
                'TIEN_TRATRUOC' => $cost,
                'NGAY_PHAITRA' =>  date('Y-m-d', strtotime($promissDate))
            );
            /*kiểm tra thương hiệu này đã tồn tại hay chưa*/

            if ($this->import_model->update_rule($where, $dt)) {
                //tao noi dung thong bao
                $this->session->set_flashdata('message', 'Update thành công!');
                redirect(admin_url('import'));
            } else {
                $this->session->set_flashdata('message', 'Update thất bại');
            }

        }

        $this->data['providers'] = $this->providers_model->getList();
        $this->data['temp'] = 'admin/import/edit';
        $this->load->view('admin/main', $this->data);
    }

    /*
  * Xóa phiếu nhập
  * */
    function delete(){
        /*Lấy thông tin theo id*/
        $this->id = $this->uri->segment('4');
        $this->id = intval($this->id);
        $where = array('MA_PHIEUNHAP' => $this->id);

        $info = $this->import_model->get_info_rule($where);
        if (!$info){
            $this->session->set_flashdata('message', 'Không tìm thấy !');
            redirect(admin_url('import'));
        }
        if ($info['TRANGTHAI'] == '1'){
            // chưa cung cấp loại or nhập hàng
            if($this->import_model->del_rule($where)){
                $this->session->set_flashdata('message', 'Xóa thành công! ');
                redirect(admin_url('import'));
            }else{
                $this->session->set_flashdata('message', 'Xóa thất bại! ');
            }
        }elseif ($info['TRANGTHAI'] == '2') {
            /*Xóa bằng cách cập nhật lại trạng thái*/
            $dt = array(
                'TRANGTHAI' => 0
            );
            if ($this->import_model->update_rule($where, $dt)) {
                //tao noi dung thong bao
                $this->session->set_flashdata('message', 'Xóa thành công! ');
                redirect(admin_url('import'));
            } else {
                $this->session->set_flashdata('message', 'Xóa thất bại! ');
            }
        }
    }
}