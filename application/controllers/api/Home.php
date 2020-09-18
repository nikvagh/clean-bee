<?php

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Home extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Api_model','api');

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

}
