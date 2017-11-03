<?php
$account = $this->session->userdata('account');
   $employeCode = $account['MA_NHANVIEN'];
?>
<!-- head -->
<?php $this->load->view('admin/import/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <!-- Form -->

    <div class="widget">
        <div class="title">
            <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
            <h6>Thêm mới phiếu nhập</h6>
        </div>

        <form class="form" id="form-branh" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!--Tên phiếu nhập -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên nhà cung cấp<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="providers" _autocheck="true" id='providers' class="left" required>
                            <option value="0">&nbsp;Lựa chọn chức vụ &nbsp;</option>
                            <?php foreach($providers as $itemProviders) { ?>
                                <option value="<?php echo $itemProviders['MA_NHA_CUNGCAP']; ?>">
                                    <?php echo $itemProviders['TEN_NHA_CUNGCAP']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="providers_error" class="clear error" id="providers_error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Tien TRATRUOC-->
                <div class="formRow">
                    <label class="formLeft" for="param_fname">Tiền trả trước (%)<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="cost" id="cost" _autocheck="true"
                                                            type="text" value="<?php echo set_value('cost') ?>"
                                                            required></span>
                        <span name="cost_autocheck" class="autocheck"></span>
                        <div name="cost_error" id="cost_error"
                             class="clear error"><?php echo form_error('cost'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_fname">Ngày hẹn trả<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="promissDate" id="promissDate" _autocheck="true"
                                                            type="text" value="<?php echo set_value('promissDate') ?>"
                                                            required></span>
                        <span name="promissDate_autocheck" class="autocheck"></span>
                        <div name="promissDate_error" id="promissDate_error"
                             class="clear error"><?php echo form_error('promissDate'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input value="Thêm mới" class="redB" type="submit">
                    <input value="Hủy bỏ" class="basic" type="reset">
                </div>
                <div class="clear"></div>
            </fieldset>
            <input type="hidden" name="employeCode" id="employeCode" value="<?php echo $employeCode;?>"/>
        </form>
    </div>
</div>
<script>
    $(function () {
        $('#promissDate').datepicker();
    });
</script>

