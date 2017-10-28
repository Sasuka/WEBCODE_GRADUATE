<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php $this->load->view('admin/head'); ?>
</head>
<body>
<div id="left_content">
    <?php $this->load->view('admin/left'); ?>
</div>
<div id="rightSide">
    <?php $this->load->view('admin/header');?>
    <!-- Content -->
    <?php $this->load->view($temp, $this->data);?>
    <!-- End Content -->
    <?php $this->load->view('admin/footer');?>
</div>
<div class="clear"></div>
</body>
</html>