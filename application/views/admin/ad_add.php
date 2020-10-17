<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $title; ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                
                    <form name="form1" id="form1" action="<?php echo base_url().ADMINPATH; ?>ad/add" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>" class="form-control"/>
                                <?php echo form_error('title'); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Banner Pic</label>
                                <input type="file" name="img" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Target Url</label>
                                <input type="text" name="target" id="target" value="<?php echo set_value('target'); ?>" class="form-control"/>
                                <?php echo form_error('target'); ?>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Enable" <?php if(set_value('status') == 'Enable'){ echo "selected"; } ?>>Enable</option>
                                    <option value="Disable" <?php if(set_value('status') == 'Disable'){ echo "selected"; } ?>>Disable</option>
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
