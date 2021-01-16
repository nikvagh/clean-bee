<?php

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/User_model','user');

        $this->load->database();
        $this->curr_date = date('Y-m-d H:i:s');
        $this->customer_thumb = array('50'=>'50', '120'=>'120');
    }

    public function refresh_token_post(){

        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
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
            $user_id = $this->input->post('user_id');
            $token = $this->user->update_user_token($user_id);

            $result['status'] = 200;
            $result['title'] = 'otp sent successfully';
            $result['res'] = array('token' => $token);
            $this->response($result, REST_Controller::HTTP_OK);
        }

    }

    public function check_signup_post(){

        // echo "<pre>";
        // print_r($_POST);
        // exit;

        $config = [
            [
                    'field' => 'firstname',
                    'label' => 'Firstname',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'lastname',
                    'label' => 'Lastname',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|callback_usernamecheck',
                    'errors' => [],
            ],
            [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|callback_emailcheck|callback_chk_valid_email',
                    'errors' => [],
            ],
            [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]',
                    'errors' => [],
            ],
            [
                    'field' => 'confirm_password',
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [],
            ],
            // [
            //         'field' => 'country',
            //         'label' => 'Country',
            //         'rules' => 'required',
            //         'errors' => [
            //                 'required' => 'Country is Required',
            //         ],

            // ],
            [
                    'field' => 'phone',
                    'label' => 'Phone',
                    // 'rules' => 'required|numeric|min_length[10]|max_length[10]|callback_phonecheck',
                    'rules' => 'required|numeric|callback_phonecheck',
                    'errors' => [
                            'numeric' => 'Enter Valid Phone Number',
                            // 'min_length' => 'Enter Valid Phone Number',
                            // 'max_length' => 'Enter Valid Phone Number',
                    ],

            ],
            // [
            //     'field' => 'login_provider',
            //     'label' => 'login_provider',
            //     'rules' => 'required',
            //     'errors' => [],
            // ],
            

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

            // if($_POST['login_provider'] != 'normal' && $_POST['login_provider'] != 'google' && $_POST['login_provider'] != 'fb' && $_POST['login_provider'] != 'apple_id'){
            //     $result['status'] = 400;
            //     $result['title'] = 'Enter valid login_provider. it can be normal,google,fb,apple_id';
            //     $result['res'] = (object) array();
            //     $this->response($result, REST_Controller::HTTP_OK);
            // }

            // sent otp
            $otp = "1234";
            // $otp = otp_generate(4);
            // sent_otp();
            
            if($this->user->update_otp($_POST['phone'],$otp)){
                $result['status'] = 200;
                $result['title'] = 'otp sent successfully';
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }

    }

    public function signup_post(){

        $config = [
            [
                    'field' => 'firstname',
                    'label' => 'Firstname',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'lastname',
                    'label' => 'Lastname',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|callback_usernamecheck',
                    'errors' => [],
            ],
            [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|callback_emailcheck|callback_chk_valid_email',
                    'errors' => [],
            ],
            [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]',
                    'errors' => [],
            ],
            [
                    'field' => 'confirm_password',
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [],
            ],
            // [
            //         'field' => 'country',
            //         'label' => 'Country',
            //         'rules' => 'required',
            //         'errors' => [
            //                 'required' => 'Country is Required',
            //         ],

            // ],
            [
                    'field' => 'phone',
                    'label' => 'Phone',
                    // 'rules' => 'required|numeric|min_length[10]|max_length[10]|callback_phonecheck',
                    'rules' => 'required|numeric|callback_phonecheck',
                    'errors' => [
                            'numeric' => 'Enter Valid Phone Number',
                            // 'min_length' => 'Enter Valid Phone Number',
                            // 'max_length' => 'Enter Valid Phone Number',
                    ],

            ],
            [
                    'field' => 'otp',
                    'label' => 'otp',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'device_token',
                    'label' => 'device_token',
                    'rules' => 'required',
                    'errors' => [],
            ],
            // [
            //     'field' => 'login_provider',
            //     'label' => 'login_provider',
            //     'rules' => 'required',
            //     'errors' => [],
            // ],

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

                $signup_user = array(
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'phone' => $_POST['phone'],
                    'role_id' => 3,
                    'token' => '',
                    'device_token' => $_POST['device_token']
                );

                if($this->db->insert('users',$signup_user)){
                    $user_id = $this->db->insert_id();

                    $signup_customer = array(
                        'customer_id' => $user_id,
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'username' => $_POST['username'],
                        'img' => '',
                        'phone_varified' => 'true'
                    );
                    if($this->db->insert('customers',$signup_customer)){
                        $this->user->update_user_token($user_id);
                        $this->user->update_device_token($user_id,$_POST['device_token']);
                        $customer = $this->user->get_customer_by_id($user_id);

                        $to = $_POST['email'];
                        $subject = "CleanBee Confirmation";
                        $message = "<a href='#'>Confirm Your Registration</a>";
                        $this->load->library('mail');
                        $this->mail->send_email2($to,$subject,$message);

                        $result['status'] = 200;
                        $result['title'] = "Sign Up Success";
                        $result['res'] = $customer;
                        $this->response($result, REST_Controller::HTTP_OK);
                    }

                }

            }else{
                $result['status'] = 310;
                $result['title'] = "Wrong OTP";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }

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
            $this->db->where('role_id',3);
            $query1 = $this->db->get('users');

            // echo $this->db->last_query();
            if ($query1->num_rows() > 0) {
                $user = $query1->row();

                if($user){
                    if ($_POST['password'] == $user->password) {

                        if ($user->status == 'Enable') {

                            $this->user->update_user_token($user->id);
                            $this->user->update_device_token($user->id,$_POST['device_token']);
                            $customer = $this->user->get_customer_by_id($user->id);

                            $result['status'] = 200;
                            $result['title'] = "Login Success";
                            $result['res'] = $customer;
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

    public function login_with_other_post(){
        $config = [
            [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required',
                    'errors' => [],
            ],
            // [
            //         'field' => 'password',
            //         'label' => 'password',
            //         'rules' => 'required',
            //         'errors' => [],
            // ],
            [
                    'field' => 'device_token',
                    'label' => 'device_token',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'login_provider',
                    'label' => 'login_provider',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'provider_token',
                    'label' => 'provider_token',
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

            if($_POST['login_provider'] != "google" && $_POST['login_provider'] != "fb" && $_POST['login_provider'] != "apple_id"){
                $result['status'] = 310;
                $result['title'] = "login_provider must be google,fb,apple_id";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            $this->db->select('u.*');
            $this->db->join('users u','u.id = c.customer_id','left');
            $this->db->where('c.login_provider',$_POST['login_provider']);
            $this->db->where('c.provider_token',$_POST['provider_token']);
            $query1 = $this->db->get('customers c');

            if ($query1->num_rows() > 0) {
                // sign in
                $user = $query1->row();
                if ($user->status == 'Enable') {
                    $this->user->update_user_token($user->id);
                    $this->user->update_device_token($user->id,$_POST['device_token']);
                    $customer = $this->user->get_customer_by_id($user->id);

                    $result['status'] = 200;
                    $result['title'] = "Login Success";
                    $result['res'] = $customer;
                    $this->response($result, REST_Controller::HTTP_OK);
                }else{
                    // $status_err = "Y";
                    $result['status'] = 330;
                    $result['title'] = "Your account is inactive, please contact our support center.";
                    $result['res'] = (object) array();
                    $this->response($result, REST_Controller::HTTP_OK);
                }

            }else{
                // sign up
                $signup_user = array();
                if(isset($_POST['phone'])){
                    $signup_user['phone'] = $_POST['phone'];
                }
                $signup_user['email'] = $_POST['email'];
                $signup_user['password'] = '';
                $signup_user['role_id'] = 3;
                $signup_user['token'] = "";
            
                if($this->db->insert('users',$signup_user)){
                    $user_id = $this->db->insert_id();

                    $signup_customer = array();
                    $signup_customer['customer_id'] = $user_id;
                    if(isset($_POST['firstname'])){
                        $signup_customer['firstname'] =  $_POST['firstname'];
                    }
                    if(isset($_POST['lastname'])){
                        $signup_customer['lastname'] =  $_POST['lastname'];
                    }
                    if(isset($_POST['username'])){
                        $signup_customer['username'] =  $_POST['username'];
                    }
                    $signup_customer['img'] =  '';
                    $signup_customer['phone_varified'] = 'false';
                    $signup_customer['login_provider'] = $_POST['login_provider'];
                    $signup_customer['provider_token'] = $_POST['provider_token'];

                    if($this->db->insert('customers',$signup_customer)){
                        $this->user->update_user_token($user_id);
                        $this->user->update_device_token($user_id,$_POST['device_token']);
                        $customer = $this->user->get_customer_by_id($user_id);

                        $to = $_POST['email'];
                        $subject = "CleanBee Confirmation";
                        $message = "<a href='#'>Confirm Your Registration</a>";
                        $this->load->library('mail');
                        $this->mail->send_email2($to,$subject,$message);

                        $result['status'] = 200;
                        $result['title'] = "Sign Up Success";
                        $result['res'] = $customer;
                        $this->response($result, REST_Controller::HTTP_OK);
                    }
                }
            }

        }
    }

    public function user_profile_get(){
        $this->token_check();
        $user_id = $_GET['user_id'];
        $customer = $this->user->get_customer_by_id($user_id);
        
        $result['status'] = 200;
        $result['title'] = "User Info";
        $result['res'] = $customer;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function user_notificaion_get(){
        $this->token_check();
        $user_id = $_GET['user_id'];
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
            // [
            //         'field' => 'user_id',
            //         'label' => 'user_id',
            //         'rules' => 'required',
            //         'errors' => [],
            // ],
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

            if($this->user->update_email($_POST['user_id'],$_POST['email'])){

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

                if($this->user->update_phone($_POST['user_id'],$_POST['phone'])){
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

    public function update_address_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'address',
                    'label' => 'address',
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

            if($this->user->update_address($_POST['user_id'],$_POST['address'])){
                $result['status'] = 200;
                $result['title'] = "Address number updated successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function update_username_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'username',
                    'label' => 'username',
                    'rules' => 'required|callback_usernamecheck_edit',
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
            if($this->user->update_username($_POST['user_id'],$_POST['username'])){
                $result['status'] = 200;
                $result['title'] = "Username updated successfully";
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
            if($this->user->update_password($_POST['user_id'],$_POST['password'])){
                $result['status'] = 200;
                $result['title'] = "Password updated successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function update_profile_pic_post(){

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
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                    // echo "<pre>";print_r($user);

                    $user = $this->user->get_customer_by_id($_POST['user_id']);

                    if($user['img'] != "" && $user['img'] != "profile_default.png"){
                        if(file_exists(CUSTOMER_PRO.$user['img']))
                        {
                            unlink(CUSTOMER_PRO.$user['img']);
                            foreach ($this->customer_thumb as $key => $val) {
                                if (CUSTOMER_PRO ."thumb/" . $key. "x" . $val."_".$user['img'])
                                {
                                    unlink(CUSTOMER_PRO ."thumb/" . $key . "x" . $val."_".$user['img']);
                                }
                            }
                        }
                    }

                    $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

                    $config['file_name'] = $image_name;
                    $config['upload_path'] = CUSTOMER_PRO;
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
                            foreach ($this->customer_thumb as $key => $val) {
                                    $config['image_library'] = 'gd2';
                                    $config['source_image'] = $_FILES['image']['tmp_name'];
                                    $config['create_thumb'] = false;
                                    $config['maintain_ratio'] = false;
                                    $config['width'] = $key;
                                    $config['height'] = $val;
                                    $config['new_image'] = CUSTOMER_PRO . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_name;
                                    $this->image_lib->clear();
                                    $this->image_lib->initialize($config);
                                    $this->image_lib->resize();
                            }


                            $data_customer = array(
                                'img'=>$image_name
                                // 'updated_at'=>$this->curr_date
                            );
                            $this->db->where('customer_id',$_POST['user_id']);
                            if($this->db->update('customers',$data_customer)){
                                $result['status'] = 200;
                                $result['title'] = "Profile Pic updated successfully";
                                $result['res'] = (object) array();
                                $this->response($result, REST_Controller::HTTP_OK);
                            }

                    }
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

    public function add_credit_to_wallet_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'amount',
                'label' => 'amount',
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
            $wallet_data = $this->user->add_credit_to_wallet($_POST['user_id'],$_POST['amount']);

            $result['status'] = 200;
            if($wallet_data['status'] == 'add'){
                $result['title'] = "Credit added to wallet successfully";
            }else if($wallet_data['status'] == 'not_add'){
                $result['title'] = "Credit addition has been failed! please try again";
            }

            $result['res'] = $wallet_data['user'];
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function get_wallet_get(){
        $this->token_check();
        $user_id = $_GET['user_id'];
        $customer = $this->user->get_customer_wallet($user_id);

        $result['status'] = 200;
        $result['title'] = "Customer wallet";
        $result['res'] = $customer;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function email_test_post(){
        $this->load->library('mail');
        $to = "";
        $subject = "";
        $message = "";
        $this->mail->send_email2($to,$subject,$message);
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
