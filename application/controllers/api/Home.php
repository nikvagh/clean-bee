<?php

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Home extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Api_model','api');
        $this->load->model('api/Product_model','product');

        $this->load->database();
        $this->curr_date = date('Y-m-d H:i:s');
    }

    public function ads_get()
    {
        $this->token_check();
        $ads = $this->api->get_ads();

        $result['status'] = 200;
        $result['title'] = "Ads Banner";
        $result['res'] = $ads;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function get_todays_orders_get(){
        $this->token_check();
        $orders = $this->product->get_todays_orders($_GET['user_id']);
        
        $result['status'] = 200;
        $result['title'] = "Today orders list";
        $result['res'] = $orders;
        $this->response($result, REST_Controller::HTTP_OK);
    }

}
