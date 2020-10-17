<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $title;?></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                
                <?php $this->load->view(ADMINPATH.'flashdata_alert'); ?>

                <!-- <div class="box">
                    <div class="box-body">
                        <form action="<?=base_url().ADMINPATH;?>ad/filter" method="post">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Date From Start</label>
                                        <input type="text" name="filter_date_start" id="filter_date_start" class="form-control" value="<?php if(isset($_SESSION['ad']['filter_date_start'])){ echo $_SESSION['ad']['filter_date_start']; } ?>" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Date From End</label>
                                        <input type="text" name="filter_date_end" id="filter_date_end" class="form-control" value="<?php if(isset($_SESSION['ad']['filter_date_end'])){ echo $_SESSION['ad']['filter_date_end']; } ?>" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label><br/>
                                        <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Apply"/>
                                        <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Reset"/>
                                        <a href="<?php echo base_url().ADMINPATH; ?>ad/exportXLS" class="btn btn-primary btn-flat">Export Xls</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->

                <div class="box">
                    <div class="box-body">
                        <form name="datatableForm" id="datatableForm" action="<?=base_url().ADMINPATH;?>ad" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="bulk_action">
                                                    <option value="">Bulk Action</option>
                                                    <option value="bulk_delete">Delete</option>
                                                    <!-- <option value="bulk_status_update">Status Update</option> -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 bulk_status_box">
                                            <div class="form-group">
                                                <select class="form-control" name="bulk_status">
                                                    <option value="">Select Status</option>
                                                    <option value="Enable">Enable</option>
                                                    <option value="Disable">Disable</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <input type="button" name="bulk_apply_btn" id="" class="bulk_apply_btn btn btn-primary btn-flat" onclick="confirmBulk('datatableForm');" value="Apply"/>
                                            <!-- <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Apply"/> -->
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4 text-right">
                                    <div class="form-group">
                                        <!-- <label for="">&nbsp;</label><br/> -->
                                        <a href="<?php echo base_url().ADMINPATH;?>ad/add" class="btn btn-primary btn-flat">Add New <?php echo $title; ?></a>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox_main"/></th>
                                        <th>#</th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Target</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="id" id="id"/>
                            <input type="hidden" name="publish" id="publish"/>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>  


