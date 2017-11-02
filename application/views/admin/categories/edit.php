<script>
    $(function () {

    });
</script>
<?php
$tmp['categories'] = (isset($_POST['categories']) ? $_POST['categories'] : $info['TEN_LOAI_SANPHAM']);
$tmp['providers'] = (isset($_POST['providers']) ? $_POST['providers'] : $info['MA_NHA_CUNGCAP']);
$tmp['brand'] = (isset($_POST['brand']) ? $_POST['brand'] : $info['MA_THUONGHIEU']);
$tmp['status'] = (isset($_POST['status']) ? $_POST['status'] : $info['TRANGTHAI']);

?>
<?php //pre($providers);?>
<!-- head -->
<?php $this->load->view('admin/categories/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <!-- Form -->

    <div class="widget">
        <div class="title">
            <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
            <h6>Cập nhật loại sản phẩm</h6>
        </div>

        <form class="form" id="form-categories" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- Tên loại sản phẩm -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên loại sản phẩm<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="categories" id="categories" _autocheck="true"
                                                    type="text" value="<?php echo $tmp['categories']; ?>"
                                                    maxlength="15" required></span>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="categories_error" class="clear error" id="categories_error"><?php echo form_error('categories'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Tên nhà cung cấp-->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên nhà cung cấp:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="providers" _autocheck="true" id='level' class="left" required>
                            <option value="0">&nbsp;Lựa chọn nhà cung cấp &nbsp;</option>

                            <?php foreach ($providers as $itemProviders) { ?>
                                <option value="<?php echo $itemProviders['MA_NHA_CUNGCAP']; ?>"
                                <?php echo ($itemProviders['MA_NHA_CUNGCAP'] == $tmp['providers']) ? 'selected' : ''?>
                                >
                                    <?php echo $itemProviders['TEN_NHA_CUNGCAP']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="providers_error" class="clear error" id="providers_error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Tên thương hiệu-->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên thương hiệu:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="brand" _autocheck="true" id='brand' class="left" required>
                            <option value="0">&nbsp;Lựa chọn tên thương hiệu &nbsp;</option>

                            <?php foreach ($brand as $itemBrand) { ?>
                                <option value="<?php echo $itemBrand['MA_THUONGHIEU']; ?>"
                                    <?php echo ($itemBrand['MA_THUONGHIEU'] == $tmp['brand']) ? 'selected' : ''?>
                                >
                                    <?php echo $itemBrand['TEN_THUONGHIEU']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="brand_error" class="clear error" id="brand_error"></div>
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
                </div>
                <div class="clear"></div>
            </fieldset>
        </form>
    </div>
</div>
