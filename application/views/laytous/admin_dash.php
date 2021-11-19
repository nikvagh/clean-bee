<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view(ADMINPATH . 'head'); ?>
    <title><?php //echo $this->system->company_name; ?> <?php echo $title; ?></title>
    <?php $this->load->view(ADMINPATH . 'common_css'); ?>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php $this->load->view(ADMINPATH . 'header'); ?>
      <?php $this->load->view(ADMINPATH . 'sidebar'); ?>

      <?php echo $content_for_layout; ?>

      <?php $this->load->view(ADMINPATH . 'footer'); ?>
    </div>

    <?php $this->load->view(ADMINPATH . 'common_js'); ?>

    <?php if($page == "ad_list"){ ?>
        <div class="modal fade" id="confirm_model" role="dialog"></div>
        <?php $this->load->view(ADMINPATH.'common_js'); ?>
        <script>
            $(document).ready(function(){
                table = $('#datatable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "url": "<?php echo base_url(ADMINPATH.'ad/getLists/'); ?>",
                        "type": "POST"
                    },
                    "columnDefs": [{ 
                        "targets": [0],
                        "orderable": false
                    }]
                });
                // table.ajax.reload();
            });

            filter_date_start = $("#filter_date_start").val();
            $('#filter_date_end').datepicker('setStartDate', filter_date_start);

            // on change startDate
            $("#filter_date_start").datepicker({
                todayBtn:  1,
                autoclose: true,
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#filter_date_end').datepicker('setStartDate', minDate);
                $('#filter_date_end').datepicker('setDate', minDate);
            });
            
            // on change endDate
            $("#filter_date_end").datepicker() .on('changeDate', function (selected) {
                // var maxDate = new Date(selected.date.valueOf());
                // $('#filter_date_start').datepicker('setEndDate', maxDate);
            });

            check_uncheck_main();
        </script>
    <?php } ?>


    <?php if($page == "ad_add"){ ?>
      <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
      <script>
          base_url = '<?php echo base_url().ADMINPATH; ?>';
          $('#form1').validate({
              rules: {
                  title:{
                      required: true,
                  },
                  img:{
                      // required: true,
                      accept: "image/jpg,image/jpeg,image/png,image/gif"
                  },
                  target:{
                      required: true,
                      remote: base_url+'ad/valid_url_format'
                  }
              },
              messages: {
                  img:{
                      accept: "Invalid Image Type!!"
                  },
                  target:{
                      remote: 'Invalid Url'
                  }
              }
          });
      </script>
    <?php } ?>

    <?php if($page == "ad_edit"){ ?>
      <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>

      <script type="text/javascript">
          base_url = '<?php echo base_url().ADMINPATH; ?>';

          $('#form1').validate({
              rules: {
                  title:{
                      required: true,
                  },
                  img:{
                      // required: true,
                      accept: "image/jpg,image/jpeg,image/png,image/gif"
                  },
                  target:{
                      required: true,
                      remote: base_url+'ad/valid_url_format'
                  }
              },
              messages: {
                  img:{
                      accept: "Invalid Image Type!!"
                  },
                  target:{
                      remote: 'Invalid Url'
                  }
              }
          });
          resubmit_false();
      </script>
    <?php } ?>

  </body>
</html>