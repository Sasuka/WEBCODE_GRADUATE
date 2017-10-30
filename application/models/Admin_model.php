<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 29/10/2017
 * Time: 0:42
 */

class Admin_model extends MY_Model
{
    public $table ='nhanvien';
    protected  $tLevel = 'chucvu';

    public function __construct()
    {
        parent::__construct();
    }
    /*============= Lấy tất cả các chức vụ==============*/
    public function getListLevel()
    {
        return $this->db->get($this->tLevel)->result_array();
    }

}