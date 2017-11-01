<script>
    $(function () {

    });
</script>

<!-- head -->
<?php $this->load->view('admin/providers/head'); ?>
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

                <!-- Tên nhà cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên nhà cung cấp<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="providerName" id="providerName" _autocheck="true"
                                                    type="text" value="<?php echo set_value('providerName') ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="providerName_error" class="clear error" id="providerName_error"><?php echo form_error('providerName'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Website nhà cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Website nhà cung cấp<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="website" id="website" _autocheck="true"
                                                    type="text" value="<?php echo set_value('website') ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="website_error" class="clear error" id="website_error"><?php echo form_error('providerWebiste'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <!--SDT Nhà Cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Số điện thoại<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="phone" id="phone" _autocheck="true"
                                                    type="text" value="<?php echo set_value('phone') ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="phone_error" class="clear error" id="phone_error"><?php echo form_error('phone'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!--Email Nhà Cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Email<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="email" id="email" _autocheck="true"
                                                    type="email" value="<?php echo set_value('email') ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="email_error" class="clear error" id="email_error"><?php echo form_error('email'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Địa chỉ Nhà cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_site_title">Địa chỉ:</label>
                    <div class="formRight">
                            <span class="oneTwo"><textarea name="address" id="address" _autocheck="true" rows="4"
                                                           cols=""
                                                           required><?php echo set_value('address') ?> </textarea></span>
                        <span name="address_autocheck" class="autocheck"></span>
                        <div name="address_error" id="address_error" class="clear error"></div>
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
