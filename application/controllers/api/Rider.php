<?php

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rider extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Product_model','product');
        $this->load->model('api/User_model','user');
        $this->load->model('api/Rider_model','rider');

        $this->load->database();
        $this->curr_date = date('Y-m-d H:i:s');
        $this->rider_thumb = array('50'=>'50', '120'=>'120');
    }

    public function login_post(){

        $config = [
            [
                    'field' => 'username',
                    'label' => 'username',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'device_token',
                    'label' => 'device_token',
                    'rules' => 'required',
                    'errors' => [],
            ],
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{
            
            $username_err = 'N';
            $password_err = 'N';
            $status_err = 'N';

            $this->db->select('*');
            $this->db->where('((email = "'.$this->input->post('username').'") OR (phone = "'.$this->input->post('username').'") ) ');
            $this->db->where('role_id',4);
            $query1 = $this->db->get('users');

            // echo $this->db->last_query();
            if ($query1->num_rows() > 0) {
                $user = $query1->row();

                if($user){
                    if ($_POST['password'] == $user->password) {

                        if ($user->status == 'Enable') {

                            $this->user->update_user_token($user->id);
                            $this->user->update_device_token($user->id,$_POST['device_token']);
                            $user = $this->rider->get_rider_by_id($user->id);

                            $result['status'] = 200;
                            $result['title'] = "Login Success";
                            $result['res'] = $user;
                            $this->response($result, REST_Controller::HTTP_OK);

                        }else{
                            $status_err = "Y";
                        }

                    }else{
                        $password_err = 'Y';
                    }

                }else{
                    $username_err = 'Y';
                }

            }else{
                $username_err = 'Y';
            }

            if($username_err == "Y"){
                $result['status'] = 310;
                $result['title'] = "Username incorrect";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($password_err == "Y"){
                $result['status'] = 320;
                $result['title'] = "Password incorrect.";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($status_err == "Y"){
                $result['status'] = 330;
                $result['title'] = "Your account is inactive, please contact our support center.";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
            
        }

    }

    public function logout_post(){
        $this->token_check();
        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $this->user->update_user_token($_POST['user_id']);
            $result['status'] = 200;
            $result['title'] = "Logout successfully";
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function update_email_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required|callback_emailcheck_edit|callback_chk_valid_email',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            if($this->rider->update_email($_POST['user_id'],$_POST['email'])){
                $to = $_POST['email'];
                $subject = "CleanBee - Email Update Confirmation";
                $message = "<a href='#'>Confirm Your Email</a>";
                $this->load->library('mail');
                $this->mail->send_email2($to,$subject,$message);

                $result['status'] = 200;
                $result['title'] = "Check your email for confirmation";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function update_phone_otp_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'phone',
                    'label' => 'phone',
                    'rules' => 'required|callback_phonecheck_edit',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            // sent otp
            $otp = "1234";
            // $otp = otp_generate(4);
            // sent_otp();
            
            if($this->user->update_otp($_POST['phone'],$otp)){
                $result['status'] = 200;
                $result['title'] = "OTP sent on your new phone number";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function update_phone_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'phone',
                    'label' => 'phone',
                    'rules' => 'required|callback_phonecheck_edit',
                    'errors' => [],
            ],
            [
                    'field' => 'otp',
                    'label' => 'otp',
                    'rules' => 'required',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            if($this->user->check_otp($_POST['phone'],$_POST['otp'])){

                if($this->rider->update_phone($_POST['user_id'],$_POST['phone'])){
                    $result['status'] = 200;
                    $result['title'] = "Phone number updated successfully";
                    $result['res'] = (object) array();
                    $this->response($result, REST_Controller::HTTP_OK);
                }

            }else{
                $result['status'] = 310;
                $result['title'] = "Wrong OTP";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function update_password_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required|min_length[6]',
                    'errors' => [],
            ],
            [
                    'field' => 'confirm_password',
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [],
            ],
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            if($this->rider->update_password($_POST['user_id'],$_POST['password'])){
                $result['status'] = 200;
                $result['title'] = "Password updated successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function update_profile_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            $image_name = "";
            $file_upload = "N";
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                    // echo "<pre>";print_r($user);

                    $user = $this->rider->get_rider_by_id($_POST['user_id']);

                    if($user['img'] != "" && $user['img'] != "profile_default.png"){
                        if(file_exists(RIDER_PRO.$user['img']))
                        {
                            unlink(RIDER_PRO.$user['img']);
                            foreach ($this->rider_thumb as $key => $val) {
                                if (RIDER_PRO ."thumb/" . $key. "x" . $val."_".$user['img'])
                                {
                                    unlink(RIDER_PRO ."thumb/" . $key . "x" . $val."_".$user['img']);
                                }
                            }
                        }
                    }

                    $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

                    $config['file_name'] = $image_name;
                    $config['upload_path'] = RIDER_PRO;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                            $data['error'] = array('error' => $this->upload->display_errors());
                            // echo "<pre>";
                            // print_r($data['error']);

                            $result['status'] = 310;
                            $result['title'] = "Invalid or corrupt image.";
                            $result['res'] = (object) array();
                            $this->response($result, REST_Controller::HTTP_OK);

                    }else{
                            $data['upload_data'] = $this->upload->data();
                            $this->load->library('image_lib');
                            foreach ($this->rider_thumb as $key => $val) {
                                    $config['image_library'] = 'gd2';
                                    $config['source_image'] = $_FILES['image']['tmp_name'];
                                    $config['create_thumb'] = false;
                                    $config['maintain_ratio'] = false;
                                    $config['width'] = $key;
                                    $config['height'] = $val;
                                    $config['new_image'] = RIDER_PRO . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_name;
                                    $this->image_lib->clear();
                                    $this->image_lib->initialize($config);
                                    $this->image_lib->resize();
                            }
                            
                            $file_upload = "Y";
                    }
            }

            $data_rider = array();
            if($file_upload == "Y"){
                $data_rider['img'] = $image_name;
            }
            if(isset($_POST['firstname'])){
                $data_rider['firstname'] = $_POST['firstname'];
            }
            if(isset($_POST['lastname'])){
                $data_rider['lastname'] = $_POST['firstname'];
            }
            
            if(!empty($data_rider)){
                $this->db->where('rider_id',$_POST['user_id']);
                if($this->db->update('riders',$data_rider)){
                    $result['status'] = 200;
                    $result['title'] = "Profile data updated successfully";
                    $result['res'] = (object) array();
                    $this->response($result, REST_Controller::HTTP_OK);
                }
            }else{
                $result['status'] = 310;
                $result['title'] = "Enter atleast one field to update profile";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function forgot_password_req_post(){

        $config = [
            [
                    'field' => 'reset_pass_by',
                    'label' => 'reset_pass_by',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'val',
                    'label' => 'val',
                    'rules' => 'required',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            if($_POST['reset_pass_by'] != 'phone' && $_POST['reset_pass_by'] != 'email'){
                $result['status'] = 400;
                $result['title'] = 'Enter valid reset_password_by. as phone or email';
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            $where = array(
                $_POST['reset_pass_by'] => $_POST['val']
            );
            $rider = $this->rider->get_rider_by_selected_fields('*',$where);
            // print_r($rider);
            // exit;

            if(empty($rider)){
                $result['status'] = 301;
                $result['title'] = 'Account does not exist!';
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
            
            if($_POST['reset_pass_by'] == 'phone'){
                // sent otp
                $otp = "1234";
                // $otp = otp_generate(4);
                // sent_otp();

                 if($this->user->update_otp($_POST['val'],$otp)){
                    $result['status'] = 200;
                    $result['title'] = 'otp sent successfully';
                    $result['res'] = (object) array();
                    $this->response($result, REST_Controller::HTTP_OK);
                }
            }else if($_POST['reset_pass_by'] == 'email'){

                $to = $_POST['val'];
                $subject = "CleanBee Password Reset Confirmation";
                $message = "<a href='#'>Change Your Passord</a>";
                $this->load->library('mail');
                $this->mail->send_email2($to,$subject,$message);    

                $result['status'] = 200;
                $result['title'] = 'email sent successfully';
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);

            }

        }

    }

    public function forgot_password_reset_post(){
        $config = [
            [
                    'field' => 'phone',
                    'label' => 'phone',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'otp',
                    'label' => 'otp',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required|min_length[6]',
                    'errors' => [],
            ],
            [
                    'field' => 'confirm_password',
                    'label' => 'confirm_password',
                    'rules' => 'required|matches[password]',
                    'errors' => [],
            ],
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            if($this->user->check_otp($_POST['phone'],$_POST['otp'])){
                if($this->rider->update_password_by_phone($_POST['phone'],$_POST['password'])){
                    $result['status'] = 200;
                    $result['title'] = "Password updated successfully";
                    $result['res'] = (object) array();
                    $this->response($result, REST_Controller::HTTP_OK);
                }
            }else{
                $result['status'] = 310;
                $result['title'] = "Wrong OTP";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function rider_profile_get(){
        $this->token_check();
        $user_id = $_GET['rider_id'];
        $rider = $this->rider->get_rider_by_id($user_id);
        
        $result['status'] = 200;
        $result['title'] = "Rider Info";
        $result['res'] = $rider;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function rider_notificaion_get(){
        $this->token_check();
        $user_id = $_GET['rider_id'];
        $notifications = $this->user->get_notification_by_user_id($user_id);
        $total_new = $this->user->get_total_new_notification_by_user_id($user_id);
        
        $result['status'] = 200;
        $result['title'] = "Notification list";
        $result['res']['total_new'] = $total_new;
        $result['res']['notification'] = $notifications;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function notification_to_viewed_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'notification_id',
                    'label' => 'notification_id',
                    'rules' => 'required',
                    'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{

            if($this->user->change_notification_to_viewed($_POST['notification_id'])){
                $result['status'] = 200;
                $result['title'] = "Notification status changed to viewed";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }
    
    public function get_assigned_order_post(){
        $config = [
            [
                'field' => 'rider_id',
                'label' => 'rider_id',
                'rules' => 'required',
                'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{
            $tab="";
            if(isset($_POST['tab'])){
                $tab = $_POST['tab'];
            }

            $filter="";
            if(isset($_POST['filter'])){
                $filter = $_POST['filter'];
            }

            $orders = $this->product->get_assigned_order_to_rider($_POST['rider_id'],$tab,$filter);
            $result['status'] = 200;
            $result['title'] = "Orders list";
            $result['res'] = $orders;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function start_order_post(){
        $config = [
            // [
            //     'field' => 'rider_id',
            //     'label' => 'rider_id',
            //     'rules' => 'required',
            //     'errors' => [],
            // ],
            [
                'field' => 'order_id',
                'label' => 'order_id',
                'rules' => 'required',
                'errors' => [],
            ]
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $result['res'] = (object) array();
            $this->response($result, REST_Controller::HTTP_OK);

        }else{
            if($order_start = $this->product->start_order($_POST['order_id'])){
                $result['status'] = 200;
                $result['title'] = "Order started successfully.";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 310;
                $result['title'] = "Order can't be start. Something wrong";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }
    







    
    public function emailcheck()
    {
        $this->db->select('id');
        $this->db->where('u.email =',$this->input->post('email'));
        $query1 = $this->db->get('users u');
        if ($query1->num_rows() > 0) {
            $this->form_validation->set_message('emailcheck', 'Email Already Exists');
            return false;
        }else{
            return true;
        }
    }

    public function emailcheck_edit()
    {
        $this->db->select('*');
        $this->db->where('email =',$this->input->post('email'));
        $this->db->where('id !=',$this->input->post('user_id'));
        $query1 = $this->db->get('users');
        if ($query1->num_rows() > 0) {
            $this->form_validation->set_message('emailcheck_edit', 'Email Already Exists');
            return false;
        }else{
            return true;
        }
    }

    public function chk_valid_email()
    {
        if(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            $this->form_validation->set_message('chk_valid_email', 'Enter Valid Email');
            return false;
        }
    }

    public function usernamecheck()
    {
        $this->db->select('id');
        $this->db->where('username =',$this->input->post('username'));
        $query1 = $this->db->get('customers c');
        if ($query1->num_rows() > 0) {
            $this->form_validation->set_message('usernamecheck', 'Username Already Exists');
            return false;
        }else{
            return true;
        }
    }

    public function usernamecheck_edit(){
        $this->db->select('id');
        $this->db->where('username =',$this->input->post('username'));
        $this->db->where('customer_id !=',$this->input->post('user_id'));
        $query1 = $this->db->get('customers c');
        if ($query1->num_rows() > 0) {
            $this->form_validation->set_message('usernamecheck_edit', 'Username Already Exists');
            return false;
        }else{
            return true;
        }
    }

    public function phonecheck()
    {
        $this->db->select('id');
        $this->db->where('phone =',$this->input->post('phone'));
        $query1 = $this->db->get('users u');
        if ($query1->num_rows() > 0) {
            $this->form_validation->set_message('phonecheck', 'Phone Number Already Exists');
            return false;
        }else{
            return true;
        }
    }

    public function phonecheck_edit()
    {
        $this->db->select('*');
        $this->db->where('phone =',$this->input->post('phone'));
        $this->db->where('id !=',$this->input->post('user_id'));
        $query1 = $this->db->get('users');
        // echo $this->db->last_query();
        if ($query1->num_rows() > 0) {
            $this->form_validation->set_message('phonecheck_edit', 'Phone Number Already Exists');
            return false;
        }else{
            return true;
        }
    }

}
