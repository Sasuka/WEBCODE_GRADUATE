<!-- head -->
<?php $this->load->view('admin/madein/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <?php
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
            <h6>Danh sách xuất xứ</h6>
            <div class="num f12">Tổng số: <b><?php echo count($list); ?></b></div>
        </div>

        <form action="http://localhost/webphp/index.php/admin/user.html" method="get" class="form" name="filter">
            <table class="sTable mTable myTable withCheck" id="checkAll" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <td style="width:10px;"><img src="<?php echo public_url('admin/') ?>images/icons/tableArrows.png">
                    </td>
                    <td style="width:80px;">Mã số</td>
                    <td>Tên Xuất Xứ</td>
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

                <?php
                $i = 0;
                foreach ($list as $row) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <div class="checker" id="uniform-undefined"><span>
                        <input name="id[]" value="<?php echo $row['MA_XUATXU']; ?>" style="opacity: 0;"
                               type="checkbox"></span></div>
                        </td>
                        <td><span class="tipS"
                                  original-title="<?php echo $row['MA_XUATXU']; ?>">
                                <?php echo $i; ?></span>
                        </td>
                        <td><span class="tipS" original-title=""><?php echo $row['TEN_XUATXU']; ?></span></td>
                        <td class="option">
                            <a href="<?php echo admin_url('madein/edit/' . $row['MA_XUATXU']); ?>" class="tipS "
                               original-title="Chỉnh sửa">
                                <img src="<?php echo public_url('admin/') ?>images/icons/color/edit.png">
                            </a>

                                <a href="<?php echo admin_url('madein/delete/' . $row['MA_XUATXU']); ?>"
                                   class="tipS verify_action"
                                   original-title="Xóa">
                                    <img src="<?php echo public_url('admin/') ?>images/icons/color/delete.png">
                                </a>
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