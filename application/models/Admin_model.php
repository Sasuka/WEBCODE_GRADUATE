<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/10/2017
 * Time: 0:42
 */

class Admin_model extends MY_Model
{
    public $table = 'nhanvien';
    public $table1 = 'chucvu';


    public function __construct()
    {
        parent::__construct();
    }

    /*============= Lấy tất cả các chức vụ==============*/
    public function getListLevel()
    {
        return $this->db->get($this->table1)->result_array();
    }
    /*============== Show chức vụ của tương ứng ===========*/
    //============== LIST NHAN VIEN THEO CHUC VU====================//
    public function listEmployee($where = array())
    {
        $this->db->select('*');
        $this->db->from('nhanvien');
        $this->db->join('chucvu', "nhanvien.MA_CHUCVU = chucvu.MA_CHUCVU");
        $this->db->where($where);
        $this->db->order_by('TRANGTHAI','DESC');
        return $this->db->get()->result_array();
    }


}