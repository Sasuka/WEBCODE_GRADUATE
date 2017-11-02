<script>
    $(function () {

    });
</script>
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
            <h6>Thêm mới loại sản phẩm</h6>
        </div>

        <form class="form" id="form-categories" action="" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- Tên loại sản phẩm -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên loại sản phẩm<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="categories" id="categories" _autocheck="true"
                                                    type="text" value="<?php echo set_value('categories') ?>"
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
                <!-- Tên thương hiệu-->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Tên thương hiệu:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="brand" _autocheck="true" id='level' class="left" required>
                            <option value="0">&nbsp;Lựa chọn tên thương hiệu &nbsp;</option>

                            <?php foreach ($brand as $itemBrand) { ?>
                                <option value="<?php echo $itemBrand['MA_THUONGHIEU']; ?>">
                                    <?php echo $itemBrand['TEN_THUONGHIEU']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="brand_error" class="clear error" id="brand_error"></div>
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
