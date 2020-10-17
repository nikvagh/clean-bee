<?php
    class Ad extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(ADMINPATH.'ad_model','ad');
            // $this->load->library('upload');
            checkLogin('admin');
            $this->accessibility->check_access('ad');
        }

        function index(){
            $data['ad_manage'] = TRUE;
            $data['title'] = "Ads";
            $data['page'] = "ad_list";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->ad->st_update()) {
                    $this->session->set_flashdata('success', 'Status has been update successfully.');
                    redirect(ADMINPATH.'ad');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->ad->delete()) {
                    $this->session->set_flashdata('success', 'Ad deleted successfully.');
                    redirect(ADMINPATH.'ad');
                }
            }elseif ($this->input->post('action') == "bulk_delete") {
                if ($result = $this->ad->bulk_delete()) {
                    $this->session->set_flashdata('success', 'Ads deleted successfully.');
                    redirect(ADMINPATH.'ad');
                }
            }elseif ($this->input->post('action') == "bulk_status_update") {
                if ($result = $this->ad->bulk_status_update()) {
                    $this->session->set_flashdata('success', 'Status has been update successfully.');
                    redirect(ADMINPATH.'ad');
                }
            }
            $this->layouts->view(ADMINPATH.$data['page'],$data,'admin_dash');
        }

        function getLists(){
            $data = $row = array();

            $qData = $this->ad->getRows($_POST);
            $i = $_POST['start'];
            // onClick="confirmDelete(datatableForm,'.$val->id.',Ad)"
            foreach($qData as $val){
                $i++;
                $status = "";

                $checkbox = '<input type="checkbox" name="ids[]" id="" class="ids_check" value="'.$val->id.'"/>';

                if($val->status == "Enable"){
                    $status = '<span class="label label-success">'.$val->status.'</span>';
                    $status .= ' <button type="button" class="btn btn-xs btn-sm btn-flat" id="status_'.$val->id.'" onClick="confirmPublishStatus(\'datatableForm\',\''.$val->id.'\',\'Disable\')">Click to Disable</button> ';
                }else if($val->status == "Disable"){
                    $status = '<span class="label label-danger">'.$val->status.'</span>';
                    $status .= ' <button type="button" class="btn btn-xs btn-sm btn-flat" id="status_'.$val->id.'" onClick="confirmPublishStatus(\'datatableForm\',\''.$val->id.'\',\'Enable\')">Click to Enable</button> ';
                }
                $action = '<a href="'.base_url().ADMINPATH.'ad/edit/'.$val->id.'" class="btn btn-sm btn-primary btn-flat">Edit</a> ';
                $action .= ' <button type="button" class="btn btn-danger btn-sm btn-flat" id="delete_'.$val->id.'" onClick="confirmDelete(\'datatableForm\',\''.$val->id.'\',\'Ad\')">Delete</button> ';
               
                // echo base_url(). ADBNR_PATH . 'thumb/50x50_' . $val['pic'];
                if (file_exists(ADBNR_PATH . 'thumb/50x50_' . $val->img)) {
                    $img_url = base_url() . ADBNR_PATH . 'thumb/50x50_' . $val->img;
                } else {
                    $img_url = "";
                }

                $img = '<img src="'.$img_url.'"/>';
                $data[] = array($checkbox , $i, $val->id, $val->title, $img, $val->target, $val->created_at, $status, $action);
            }
            
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->ad->countAll(),
                "recordsFiltered" => $this->ad->countFiltered($_POST),
                "data" => $data,
            );
            
            // Output to JSON format
            echo json_encode($output);
        }

        function add(){
            $data['ad_form'] = TRUE;
            $data['action']='add';
            $data['title']="Ads";
            $data['page']="ad_add";
            
            if(isset($_POST['action'])){

                // $config = [
                //     [
                //             'field' => 'name',
                //             'label' => 'Name',
                //             'rules' => 'required',
                //             'errors' => [
                //                     // 'required' => 'Member Id Missing.',
                //             ],
                //     ],
                //     [
                //             'field' => 'username',
                //             'label' => 'Username',
                //             'rules' => 'required|callback_usernameCheck_add',
                //             'errors' => [
                //                     // 'required' => 'Amount is required fields',
                //             ],
                //     ],
                //     [
                //             'field' => 'phone',
                //             'label' => 'Phone',
                //             'rules' => 'required|numeric|callback_phoneCheck_add',
                //             'errors' => [
                //                     // 'required' => 'Amount is required fields',
                //             ],
                //     ],
                //     [
                //             'field' => 'email',
                //             'label' => 'email',
                //             'rules' => 'required|callback_chk_valid_email|callback_emailCheck_add',
                //             'errors' => [
                //                     // 'required' => 'Member Id Missing.',
                //             ],
                //     ],
                //     [
                //             'field' => 'password',
                //             'label' => 'Password',
                //             'rules' => 'required|min_length[6]',
                //             'errors' => [
                //                     // 'required' => 'Password is Required',
                //             ],
                //     ],
                //     [
                //             'field' => 'confirm_password',
                //             'label' => 'Confirm Password',
                //             'rules' => 'required|matches[password]',
                //             'errors' => [
                //                     // 'required' => 'Confirmn Password is Required',
                //             ],
                //     ],
                    
                // ];
    
                // $this->form_validation->set_data($_POST);
                // $this->form_validation->set_rules($config);
            
                // if ($this->form_validation->run() == FALSE)
                // {
                //     $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                //     $this->load->view(ADMINPATH.'ad/add',$data); 
                // }else{
                    if($this->ad->insert()) {
                        $this->session->set_flashdata('notification', 'Ad information has been insert successfully.');
                        redirect(ADMINPATH.'ad');
                    }
                // }
                
            }else{
                $this->layouts->view(ADMINPATH.$data['page'],$data,'admin_dash');
            }
        }

        function edit(){
            $data['ad_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Admin Ad";
            $data['page']="ad_edit";
            
            // $data['companies'] = $this->ad->get_companies();
            $data['form_data'] = $this->ad->getDataById($this->uri->segment(4));
            
            if(isset($_POST['action'])){
                // $config = [
                //     [
                //             'field' => 'name',
                //             'label' => 'Name',
                //             'rules' => 'required',
                //             'errors' => [
                //                     // 'required' => 'Member Id Missing.',
                //             ],
                //     ],
                //     [
                //             'field' => 'username',
                //             'label' => 'Username',
                //             'rules' => 'required|callback_usernameCheck_edit',
                //             'errors' => [
                //                     // 'required' => 'Amount is required fields',
                //             ],
                //     ],
                //     [
                //             'field' => 'phone',
                //             'label' => 'Phone',
                //             'rules' => 'required|numeric|callback_phoneCheck_edit',
                //             'errors' => [
                //                     // 'required' => 'Amount is required fields',
                //             ],
                //     ],
                //     [
                //             'field' => 'email',
                //             'label' => 'email',
                //             'rules' => 'required|callback_chk_valid_email|callback_emailCheck_edit',
                //             'errors' => [
                //                     // 'required' => 'Member Id Missing.',
                //             ],
                //     ],
                //     [
                //             'field' => 'password',
                //             'label' => 'Password',
                //             'rules' => 'min_length[6]',
                //             'errors' => [
                //                     // 'required' => 'Password is Required',
                //             ],
                //     ],
                //     [
                //             'field' => 'confirm_password',
                //             'label' => 'Confirm Password',
                //             'rules' => 'matches[password]',
                //             'errors' => [
                //                     // 'required' => 'Confirmn Password is Required',
                //             ],
                //     ],
                    
                // ];
                // $this->form_validation->set_data($_POST);
                // $this->form_validation->set_rules($config);
            
                // if ($this->form_validation->run() == FALSE)
                // {
                //     $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                //     $this->load->view(ADMINPATH.'ad/edit',$data); 
                // }else{

                    if ($result = $this->ad->update()) {
                        $this->session->set_flashdata('success','Ad information has been update successfully.');
                        redirect(ADMINPATH.'ad');
                    }
                // }
            }else{
                $this->layouts->view(ADMINPATH.$data['page'],$data,'admin_dash');
            }
        }

        // function view(){
        //     $data['user_form'] = TRUE;
        //     $data['action']="edit";
        //     $data['title']="Member";
        //     $data['form_data'] = $this->member->getDataById($this->uri->segment(4));
        //     $this->load->view(ADMINPATH.'member/view',$data); 
        // }

        function filter(){
            // echo "<pre>";
            // print_r($_POST);

            if($_POST['submit'] == 'Apply'){
                $_SESSION['ad']['filter_date_start'] = $_POST['filter_date_start'];
                $_SESSION['ad']['filter_date_end'] = $_POST['filter_date_end'];
            }else if($_POST['submit'] == 'Reset'){
                unset($_SESSION['ad']);
            }

            redirect(ADMINPATH.'ad');
        }

        public function valid_url_format(){
            // echo "<pre>";
            // print_r($_GET);
            // exit;
            // $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
            $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
            if (!preg_match($pattern,trim($_GET['target']))){
                // $this->form_validation->set_message('valid_url_format', 'The URL you entered is not correctly formatted.');
                // return FALSE;
                echo json_encode(false);
                exit;
            }
            echo json_encode(true);
            exit;
        }

        function exportXLS(){
            $data = $this->ad->get_ads();
            $this->load->library('xls');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowSheet1 = 1;$colSheet1 = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'#');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Id');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Title');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Banner');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Target Url');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Status');
            $colSheet1++;

            $count = 1;
            foreach($data as $val){
                $rowSheet1++;$colSheet1 = 0;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$count);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['id']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['title']);
                $colSheet1++;

                if (file_exists(ADBNR_PATH . 'thumb/50x50_' . $val['pic'])) {
                    $profile_pic = base_url() . ADBNR_PATH . 'thumb/50x50_' . $val['pic'];
                } else {
                    $profile_pic = "";
                }
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$profile_pic);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['target']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['status']);
                $colSheet1++;

                $count++;
            }
            
            $objPHPExcel->setActiveSheetIndex(0);

            $this->xls->d_load($objPHPExcel,'ads');
        }

    }
?>