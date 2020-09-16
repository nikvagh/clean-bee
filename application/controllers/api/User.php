<?php

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model','user');

        $this->load->database();
        $this->curr_date = date('Y-m-d H:i:s');
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
                    'phone' => $_POST['phone'],
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
                        'phone_varified' => 'true',
                        'confirmed_at' => ''
                    );
                    if($this->db->insert('customers',$signup_customer)){
                        $this->user->update_user_token($user_id);
                        $this->user->update_device_token($user_id,$_POST['device_token']);
                        $customer = $this->user->get_customer_by_id($user_id);

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

}
