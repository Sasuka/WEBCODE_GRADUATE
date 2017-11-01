<script>
    $(function () {

    });
</script>

<!-- head -->
<?php $this->load->view('admin/branh/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <!-- Form -->

    <div class="widget">
        <div class="title">
            <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
            <h6>Thêm mới thương hiệu sản phẩm</h6>
        </div>

        <form class="form" id="form-branh" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- Tên thương hiệu -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên thương hiệu<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="branh" id="branh" _autocheck="true"
                                                    type="text" value="<?php echo set_value('branh') ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="branh_error" class="clear error" id="branh_error"><?php echo form_error('branh'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Logo thương hiệu-->
                <div class="formRow">
                    <label class="formLeft">Logo <span class="req"></span></label>
                    <div class="formRight">
                        <div class="left"><input id="image" name="image" type="file"
                                                 value="<?php //echo set_value('avatar') ?>"></div>
                        <div name="image_error" class="clear error"><?php //echo form_error('avatar'); ?></div>
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
