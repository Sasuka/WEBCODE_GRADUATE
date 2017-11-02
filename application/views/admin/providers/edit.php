
<?php
$tmp['providerName'] = (isset($_POST['providerName']) ? $_POST['providerName'] : $info['TEN_NHA_CUNGCAP']);
$tmp['website'] = (isset($_POST['website']) ? $_POST['website'] : $info['WEBSITE']);
$tmp['phone'] = (isset($_POST['phone']) ? $_POST['phone'] : $info['SDT']);
$tmp['email'] = (isset($_POST['email']) ? $_POST['email'] : $info['EMAIL']);
$tmp['address'] = (isset($_POST['address']) ? $_POST['address'] : $info['DIACHI_NHA_CUNGCAP']);
$tmp['status'] = (isset($_POST['status']) ? $_POST['status'] : $info['TRANGTHAI']);
?>
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
            <h6>Cập nhật nhà cung cấp</h6>
        </div>

        <form class="form" id="form-branh" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- Tên nhà cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên nhà cung cấp<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="providerName" id="providerName" _autocheck="true"
                                                    type="text" value="<?php echo $tmp['providerName'] ?>"
                                                    maxlength="50" required></span>
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
                                                    type="text" value="<?php echo $tmp['website'];?>"
                                                    maxlength="100" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="website_error" class="clear error" id="website_error"><?php echo form_error('webiste'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <!--SDT Nhà Cung cấp -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Số điện thoại<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="phone" id="phone" _autocheck="true"
                                                    type="text" value="<?php echo $tmp['phone']; ?>"
                                                    maxlength="15"  minlength="12" required></span>
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
                                                    type="email" value="<?php echo $tmp['email'] ;?>"
                                                   required></span>
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
                                                           required><?php echo $tmp['address']; ?> </textarea></span>
                        <span name="address_autocheck" class="autocheck"></span>
                        <div name="address_error" id="address_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- TRANG THAI -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Trạng thái:<span class="req">*</span></label>
                    <div class="formRight">
                        <label class="radio-inline"><input type="radio" name="status" value="0"
                                <?php echo $tmp['status'] == '0' ? 'checked' : ''; ?>>
                            Tạm nghỉ</label>
                        <label class="radio-inline"><input type="radio" name="status" value="1"
                                <?php echo $tmp['status'] == '1' ? 'checked' : ''; ?>> Hoạt động</label>
                        <span name="status_autocheck" class="autocheck"></span>
                        <div name="status_error" class="clear error">
                            <?php echo form_error('status'); ?></div>

                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input value="Cập nhật" class="redB" type="submit">
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