<!-- head -->
<?php $this->load->view('admin/admin/head'); ?>
<!-- line -->
<div class="line"></div>
<!--  content-->
<div class="wrapper">
    <!-- Form -->
    <div class="widget">
        <div class="title">
            <img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
            <h6>Thêm mới quản trị viên</h6>
        </div>

        <form class="form" id="form-employ" action="add" method="post" enctype="multipart/form-data"
              onclick="return check();">
            <fieldset>

                <!-- chức vụ -->
                <div class="formRow">
                    <label class="formLeft" for="param_cat">Chức vụ:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="level" _autocheck="true" id='level' class="left" required>
                            <option value="">&nbsp;Lựa chọn chức vụ &nbsp;</option>

                        </select>
                        <span name="cat_autocheck" class="autocheck"></span>
                        <div name="level_error" class="clear error" id="level_error"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <!-- ho -->
                <div class="formRow">
                    <label class="formLeft" for="param_fname">Họ:<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="fname" id="fname" _autocheck="true"
                                                            type="text" value="" required></span>
                        <span name="fname_autocheck" class="autocheck"></span>
                        <div name="fname_error" id="fname_error"
                             class="clear error"><?php //echo form_error('fname'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- ten -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="lname" id="lname" _autocheck="true"
                                                            type="text" value="<?php //echo set_value('lname') ?>" required></span>
                        <span name="lname_autocheck" class="autocheck"></span>
                        <div name="lname_error" id="lname_error"
                             class="clear error"><?php //echo form_error('lname'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- mat khau -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Mật khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="password" id="password" _autocheck="true"
                                                            type="password"
                                                            value="<?php //echo set_value('password') ?>" required></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" id="password_error"
                             class="clear error"><?php //echo form_error('password'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- nhap lai mat khau -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Nhập lại mật khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="re-pass" id="re-pass" _autocheck="true"
                                                            type="password"
                                                            value="<?php //echo set_value('re-pass') ?>" required></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" id="re-pass_error"
                             class="clear error"><?php //echo form_error('re-pass'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- sdt -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Số điện thoại:<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="phone" id="phone" _autocheck="true"
                                                            type="text" value="<?php //echo set_value('phone') ?>"
                                                            maxlength="15" required></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"
                             id="phone_error"><?php //echo form_error('phone'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- email -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Email:<span class="req">*</span></label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="email" id="email" _autocheck="true"
                                                            type="email"
                                                            value="<?php //echo set_value('email') ?>"
                                                            class="check_email" required></span>
                        <span name="name_autocheck" class="autocheck" id="mail_autocheck"></span>
                        <div name="name_error" class="clear error"
                             id="email_error"><?php //echo form_error('email'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- diachi -->
                <div class="formRow">
                    <label class="formLeft" for="param_site_title">Địa chỉ:</label>
                    <div class="formRight">
                            <span class="oneTwo"><textarea name="address" id="address" _autocheck="true" rows="4"
                                                           cols="" required><?php //echo set_value('address') ?> </textarea></span>
                        <span name="address_autocheck" class="autocheck"></span>
                        <div name="address_error" id="address_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <!-- ngay sinh -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Ngày sinh:</label>
                    <div class="formRight">
                                <span class="oneTwo"><input name="birthday" id="birthday" _autocheck="true"
                                                            type="text"
                                                            value="<?php //echo set_value('birthday') ?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php //echo form_error('birthday'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- hinh anh -->
                <div class="formRow">
                    <label class="formLeft">Hình ảnh:<span class="req"></span></label>
                    <div class="formRight">
                        <div class="left"><input id="image" name="image" type="file"
                                                 value="<?php //echo set_value('avatar') ?>"></div>
                        <div name="image_error" class="clear error"><?php //echo form_error('avatar'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- gioi tinh -->
                <div class="formRow">
                    <label class="formLeft" for="param_name">Giới tính:</label>
                    <div class="formRight">
                                <span class="one-two"><input name="gender" id="param_name" _autocheck="true"
                                                             type="radio" value="0" checked>
                                </span><label>Nam</label>
                        <span class="one-two"><input name="gender" id="param_name" _autocheck="true"
                                                     type="radio" value="1">
                                </span><label>Nữ</label>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php //echo form_error('gender'); ?></div>
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
    $(document).ready(function () {
        $("#datepicker").datepicker({
//            showOtherMonths: true,
//            selectOtherMonths: true
        });

        $('#form_register').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    message: 'Username không được để trống',
                    validators: {
                        notEmpty: {
                            message: 'The username is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9]+$/,
                            message: 'The username can only consist of alphabetical and number'
                        },
                        different: {
                            field: 'password',
                            message: 'The username and password cannot be the same as each other'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'The email address is not a valid'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        different: {
                            field: 'username',
                            message: 'The password cannot be the same as username'
                        },
                        stringLength: {
                            min: 8,
                            message: 'The password must have at least 8 characters'
                        }
                    }
                },
                birthday: {
                    validators: {
                        notEmpty: {
                            message: 'The date of birth is required'
                        },
                        date: {
                            // format: 'DD/MM/YYYY',
                            message: 'The date of birth is not valid'
                        }
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'The gender is required'
                        }
                    }
                }
            }
        });
    });


</script>