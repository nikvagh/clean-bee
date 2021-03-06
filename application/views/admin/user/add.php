<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view(ADMINPATH.'/head'); ?>
    <title> <?php echo $title; ?></title>
    <?php $this->load->view(ADMINPATH.'/common_css'); ?>
</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view(ADMINPATH.'/header'); ?>
        <?php $this->load->view(ADMINPATH.'/sidebar'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
            </section>
            <?php if ($this->session->flashdata('notification')) { ?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span><?php echo $this->session->flashdata('notification'); ?></span>
                </div>
            <?php } ?>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                        
                            <form name="form1" id="form1" action="<?php echo base_url().ADMINPATH; ?>user/add" method="post" enctype="multipart/form-data">
                                <div class="box-body">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="form-control"/>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" class="form-control"/>
                                            <?php echo form_error('username'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control"/>
                                            <?php echo form_error('email'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Phone</label>
                                            <input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" class="form-control"/>
                                            <?php echo form_error('phone'); ?>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="control-label">Profile Picture</label>
                                            <input type="file" name="profile_pic" class="form-control" value="<?php //echo set_value('profile_pic'); ?>"/>
                                            <input type="hidden" name="profile_pic_old" value="<?php //echo $profile['profile_pic']; ?>"/>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label">Passowrd</label>
                                            <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="form-control"/>
                                            <?php echo form_error('password'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirm Passowrd</label>
                                            <input type="password" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" class="form-control"/>
                                            <?php echo form_error('confirm_password'); ?>
                                        </div>
                                        <label class="control-label text-danger" for="inputWarning"><i class="fa fa-bell-o"></i> NOTE:  Only Enter Password When You Want To Chnage It. </label>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="Enable" <?php if(set_value('status') == 'Enable'){ echo "selected"; } ?>>Enable</option>
                                                <option value="Disable" <?php if(set_value('status') == 'Disable'){ echo "selected"; } ?>>Disable</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h3>Accessibility</h3>
                                        <table class="table table-striped">
                                            <tr>
                                                <td>Name</td>
                                                <td><input type="checkbox" id="checkAll" /></td>
                                            </tr>
                                            <?php 
                                                $access_old = array();
                                                if(set_value('access')){
                                                    $access_old = set_value('access');
                                                }
                                            ?>
                                            <?php foreach($privileges_list as $val){ ?>
                                                <tr>
                                                    <td><?php echo $val['name_text']; ?></td>
                                                    <td><input type="checkbox" name="access[<?php echo $val['name_code']; ?>]" <?php if(array_key_exists($val['name_code'],$access_old)){ echo "checked"; } ?> class="accees_check" /></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" name="submit" class="btn btn-warning margin btn-flat">Submit</button>
                                    <a href="<?php echo base_url().ADMINPATH; ?>user" class="btn btn-default btn-flat">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>

        </div>

        <?php $this->load->view(ADMINPATH.'/footer'); ?>
    </div>
    <?php $this->load->view(ADMINPATH.'/common_js'); ?>

    <script>
        $('#checkAll').change(function(){
            if($(this).prop("checked")){
                $('.accees_check').prop('checked',true);
            }else{
                $('.accees_check').prop('checked',false);
            }
        });
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</body>

</html>