<?php
//co id phieu nhap thuc hien kiem tra
$account = $this->session->userdata('account');

?>

<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>CHI TIÊT KHUYẾN MÃI</h5>
            <span>Quản lý  chi tiết khuyến mãi</span>
        </div>

        <div class="horControlB menu_action">
            <ul>
                    <li><a href="<?php echo admin_url('promotionsDetail/add/' . $id) ?>">
                            <img src="<?php echo public_url('admin') ?>/images/icons/control/16/add.png">
                            <span>Thêm mới</span>
                        </a></li>

                <li><a href="<?php echo admin_url('promotionsDetail/index/' . $id); ?>">
                        <img src="<?php echo public_url('admin') ?>/images/icons/control/16/list.png">
                        <span>Danh sách</span>
                    </a></li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>
</div>
