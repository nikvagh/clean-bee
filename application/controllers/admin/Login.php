<?php
    class Login extends CI_Controller {
        function __construct()
        {
            //parent::CI_Controller();
            parent::__construct();

            // $this->load->library('administration');
//			$this->output->enable_profiler(TRUE);
            // checkLogin('admin');

            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
        }
        function index()
        {
            // if($this->admin->logged_in){
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin"){
                // $data['title'] = "Dashboard";
                // $this->load->view(ADMINPATH.'dashboard', $data);
                redirect(ADMINPATH.'dashboard','location');
            }else{
                $data['title'] = "Login";
                $this->load->view(ADMINPATH.'login', $data);
            }
        }
        function dologin()
        {
            // if ($this->admin->logged_in){
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin"){
                redirect(ADMINPATH.'dashboard','location');
            } else {
                if (!$this->input->post('submit'))
                {
                    $data['title'] = "Login";
                    $this->load->view(ADMINPATH.'login', $data);
                } else {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->admin->login($username, $password))
                    {
                        redirect(ADMINPATH.'dashboard','location');
                    } else {
                        $data['title'] = "Login";
                        $this->session->set_flashdata('error', 'Invalid Login. Please try again.');
                        $this->load->view(ADMINPATH.'login', $data);
                    }
                }
            }
        }

        function logout()
        {
            $this->admin->logout();
            redirect(ADMINPATH.'login');
        }

    }
?>