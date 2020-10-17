<?php
    class Login extends CI_Controller {
        function __construct()
        {
            //parent::CI_Controller();
            parent::__construct();
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
        }
        function index()
        {
            // if ($this->member->logged_in) 
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "vendor")
            {
                // $data['title'] = "Dashboard";
                // $this->load->view(VENDORPATH.'dashboard', $data);
                redirect(VENDORPATH.'dashboard','location');
            }else{
                $data['title'] = "Login";
                $this->load->view(VENDORPATH.'login', $data);
            }
        }
        function dologin()
        {
            // if ($this->admin->logged_in)
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "vendor")
            {
                redirect(VENDORPATH.'dashboard','location');
            } else {
                if (!$this->input->post('submit'))
                {
                    $data['title'] = "Login";
                    $this->load->view(VENDORPATH.'login', $data);
                } else {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->vendor->login($username, $password))
                    {
                        redirect(VENDORPATH.'dashboard','location');
                    } else {
                        $data['title'] = "Login";
                        $this->session->set_flashdata('error', 'Invalid Login. Please try again.');
                        $this->load->view(VENDORPATH.'login', $data);
                    }
                }
            }
        }

        function logout()
        {
            $this->vendor->logout();
            redirect(VENDORPATH.'login');
        }
    }
?>