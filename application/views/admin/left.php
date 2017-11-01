<?php
    $account = $this->session->userdata('account');

?>
<div id="leftSide" style="padding-top:30px;">
    <!-- Account panel -->
    <div class="sideProfile">
        <a href="#" title="" class="profileFace"><img src="<?php echo public_url('admin/') ?>images/user.png"
                                                      width="40"></a>
        <span>Xin chào: <strong><?php echo $account['TEN']; ?></strong></span>
        <span>Chức vụ :<?php echo $account['TEN_CHUCVU']; ?></span>
        <div class="clear"></div>
    </div>
    <div class="sidebarSep"></div>
    <!-- Left navigation -->
    <ul id="menu" class="nav">
        <li class="home">
            <a href="admin/home.html" class="active" id="current">
                <span>Bảng điều khiển</span>
                <strong></strong>
            </a>
        </li>
        <li class="tran">
            <a href="admin/tran.html" class="exp inactive">
                <span>Quản lý bán hàng</span>
                <strong>2</strong>
            </a>
            <ul class="sub" style="display: none;">
                <li>
                    <a href="admin/tran.html">
                        Giao dịch </a>
                </li>
                <li>
                    <a href="admin/product_order.html">
                        Đơn hàng sản phẩm </a>
                </li>
            </ul>
        </li>
        <li class="product">
            <a href="admin/product.html" class="exp inactive">
                <span>Sản phẩm</span>
                <strong>3</strong>
            </a>
            <ul class="sub" style="display: none;">
                <li>
                    <a href="<?php echo admin_url('Providers')?>">
                        Nhà cung cấp</a>
                </li>
                <li>
                    <a href="<?php echo admin_url('branh')?>">
                        Thương hiệu </a>
                </li>
                <li>
                    <a href="admin/cat.html">
                        Loại sản phẩm </a>
                </li>
                <li>
                    <a href="admin/comment.html">
                        Phản hồi </a>
                </li>
            </ul>
        </li>
        <li class="account">
            <a href="admin/account.html" class="exp inactive">
                <span>Tài khoản</span>
                <strong>3</strong>
            </a>
            <ul class="sub" style="display: none;">
                <?php if ($account['MA_CHUCVU'] == '1') { ?>
                <li>
                    <a href="admin/admin.html">
                        Các nhóm quyền </a>
                </li>

                    <li>
                        <a href="<?php echo admin_url('admin/employee/1'); ?>">
                            Danh sách quản trị </a>
                    </li>
                    <li>
                        <a href="<?php echo admin_url('admin/employee/2'); ?>">
                            Danh sách thành viên </a>
                    </li>
                <?php
                }
                ?>
                <li>
                    <a href="<?php echo admin_url('customer'); ?>">
                        Danh sách khách hàng </a>
                </li>

            </ul>
        </li>
        <li class="support">
            <a href="admin/support.html" class="exp inactive">
                <span>Hỗ trợ và liên hệ</span>
                <strong>2</strong>
            </a>
            <ul class="sub" style="display: none;">
                <li>
                    <a href="admin/support.html">
                        Hỗ trợ </a>
                </li>
                <li>
                    <a href="admin/contact.html">
                        Liên hệ </a>
                </li>
            </ul>
        </li>
        <li class="content">
            <a href="admin/content.html" class="exp inactive">
                <span>Nội dung</span>
                <strong>4</strong>
            </a>
            <ul class="sub" style="display: none;">
                <li>
                    <a href="admin/slide.html">
                        Slide </a>
                </li>
                <li>
                    <a href="admin/news.html">
                        Tin tức </a>
                </li>
                <li>
                    <a href="admin/info.html">
                        Trang thông tin </a>
                </li>
                <li>
                    <a href="admin/video.html">
                        Video </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<div class="clear"></div>
	