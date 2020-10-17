<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $title; ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">

                    <form name="form1" id="form1" action="<?php echo base_url() . ADMINPATH .'ad/edit/'.$form_data['id']; ?>" method="post" enctype="multipart/form-data" class="">
                        <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>">
                        <input type="hidden" name="action" value="">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" name="title" id="title" value="<?php echo $form_data['title']; ?>" class="form-control"/>
                                <?php echo form_error('title'); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Banner Pic</label>
                                <br/>
                                <?php
                                    if (file_exists(ADBNR_PATH . 'thumb/50x50_' . $form_data['img'])) {
                                        $banner_img = base_url() . ADBNR_PATH . 'thumb/50x50_' . $form_data['img'];
                                    } else {
                                        $banner_img = "";
                                    }
                                ?>
                                <img src="<?php echo $banner_img; ?>"/>
                                <br/><br/>
                                <input type="file" name="img" class="form-control" />
                                <input type="hidden" name="img_old" value="<?php echo $form_data['img']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Target Url</label>
                                <input type="text" name="target" id="target" value="<?php echo $form_data['target']; ?>" class="form-control"/>
                                <?php echo form_error('target'); ?>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Enable" <?php if($form_data['status'] == 'Enable'){ echo "selected"; } ?>>Enable</option>
                                    <option value="Disable" <?php if($form_data['status'] == 'Disable'){ echo "selected"; } ?>>Disable</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="box-footer">
                        <button class="btn btn-warning btn-flat submit_btn" onclick="save_form('form1','submit')">Submit</button>
                        <a href="<?php echo base_url().ADMINPATH; ?>ad" class="btn btn-default btn-flat margin">Cancel</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>