

<!-- head -->
<?php $this->load->view('admin/madein/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <!-- Form -->

    <div class="widget">
        <div class="title">
            <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
            <h6>Thêm mới xuất xứ</h6>
        </div>

        <form class="form" id="form-madein" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- Tên thương hiệu -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên xuất xứ<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="madein" id="madein" _autocheck="true"
                                                    type="text" value="<?php echo set_value('madein') ?>"
                                                    maxlength="30" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="madein_error" class="clear error" id=madein_error"><?php echo form_error('madein'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
<!--                <!-- Logo thương hiệu-->
<!--                <div class="formRow">-->
<!--                    <label class="formLeft">Logo <span class="req"></span></label>-->
<!--                    <div class="formRight">-->
<!--                        <div class="left"><input id="image" name="image" type="file"-->
<!--                                                 value="--><?php ////echo set_value('avatar') ?><!--"></div>-->
<!--                        <div name="image_error" class="clear error">--><?php ////echo form_error('avatar'); ?><!--</div>-->
<!--                    </div>-->
<!--                    <div class="clear"></div>-->
<!--                </div>-->

                <div class="formSubmit">
                    <input value="Thêm mới" class="redB" type="submit">
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
