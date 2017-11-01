<!-- head -->
<?php $this->load->view('admin/branh/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <?php
    //  var_dump($this->session->flashdata('message'));
    if ($this->session->flashdata('message') != '') {
        $this->data['message'] = $this->session->flashdata('message');
        $this->load->view('admin/messager', $this->data);
    }
    ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><div class="checker" id="uniform-titleCheck"><span><input id="titleCheck"
                                                                                              name="titleCheck"
                                                                                              style="opacity: 0;"
                                                                                              type="checkbox"></span></div></span>
            <h6>Danh sách thương hiệu</h6>
            <div class="num f12">Tổng số: <b><?php echo count($list); ?></b></div>
        </div>

        <form action="http://localhost/webphp/index.php/admin/user.html" method="get" class="form" name="filter">
            <table class="sTable mTable myTable withCheck" id="checkAll" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <td style="width:10px;"><img src="<?php echo public_url('admin/') ?>images/icons/tableArrows.png">
                    </td>
                    <td style="width:80px;">Mã số</td>
                    <td>Tên thương hiệu</td>
                    <td>Số lượng</td>
                    <td style="width:100px;">Hành động</td>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <td colspan="7">
                        <div class="list_action itemActions">
                            <a href="#submit" id="submit" class="button blueB" url="user/del_all.html">
                                <span style="color:white;">Xóa hết</span>
                            </a>
                        </div>

                        <div class="pagination">
                        </div>
                    </td>
                </tr>
                </tfoot>

                <tbody>
                <!-- Filter -->

                <?php //pre($list, false);
                foreach ($list as $row) {
                    ?>
                    <tr>
                        <td>
                            <div class="checker" id="uniform-undefined"><span>
                        <input name="id[]" value="<?php echo $row['MA_THUONGHIEU']; ?>" style="opacity: 0;"
                               type="checkbox"></span></div>
                        </td>
                        <td><span class="tipS"
                                  original-title="Là duy nhất">
                                <?php echo $row['MA_THUONGHIEU']; ?></span>
                        </td>
                        <td><span class="tipS" original-title=""><?php echo $row['TEN_THUONGHIEU']; ?></span></td>
                        <td><span class="tipS" original-title=""></span></td>
                        <td class="option">
                            <a href="<?php echo admin_url('branh/edit/' . $row['MA_THUONGHIEU']); ?>" class="tipS "
                               original-title="Chỉnh sửa">
                                <img src="<?php echo public_url('admin/') ?>images/icons/color/edit.png">
                            </a>

                            <?php if ($row['TRANGTHAI'] == '1') { ?>
                                <a href="<?php echo admin_url('branh/delete/' . $row['MA_THUONGHIEU']); ?>"
                                   class="tipS verify_action"
                                   original-title="Xóa">
                                    <img src="<?php echo public_url('admin/') ?>images/icons/color/delete.png">
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="clear mt30"></div>