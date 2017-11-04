
<?php
$account = $this->session->userdata('account');
$employeName = $account['HO'].' '.$account['TEN'];
$employeCode = $account['MA_NHANVIEN'];
?>
<!-- head -->
<?php $this->load->view('admin/warehouse/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <!-- Form -->

    <div class="widget">
        <div class="title">
            <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
            <h6>Thêm mới kho</h6>
        </div>

        <form class="form" id="form-branh" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- Tên kho -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên Kho<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="warehouse" id="warehouse" _autocheck="true"
                                                    type="text" value="<?php echo set_value('warehouse') ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="warehouse_error" class="clear error"
                             id="warehouse_error"><?php echo form_error('warehouse'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Vị trí của kho-->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Vị trí kho<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="place" id="place" _autocheck="true"
                                                    type="text" value="<?php echo set_value('place') ?>"
                                                    maxlength="100" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="place_error" class="clear error"
                             id="place_error"><?php echo form_error('place'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Vị trí của kho-->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên nhân viên lập<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="id" id="id" _autocheck="true"
                                   type="hidden" value="<?php echo $employeCode; ?>"
                                   maxlength="10" required>
                            <input name="name" id="name" _autocheck="true"
                                   type="text" value="<?php echo $employeName; ?>"
                                   maxlength="200" required disabled>
                        </span>

                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="place_error" class="clear error"
                             id="place_error"><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input value="Thêm mới" class="redB" type="submit">
                    <input value="Hủy bỏ" class="basic" type="reset">
                </div>
                <div class="clear"></div>
            </fieldset>
        </form>
    </div>
</div>
<script>
    $(function () {

    });
</script>