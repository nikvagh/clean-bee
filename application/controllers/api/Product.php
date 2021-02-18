<?php

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Product extends REST_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Product_model','product');
        $this->load->model('api/User_model','user');

        $this->load->database();
        // $this->table='users';
        $this->curr_date = date('Y-m-d H:i:s');
    }

    public function get_slots_get(){
        $this->token_check();
        $slots = $this->product->get_time_slot();
        
        $result['status'] = 200;
        $result['title'] = "Time slots list";
        $result['res'] = $slots;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function shop_filter_option_get(){
        $shop_filter_option = SHOP_FILTER_OPTION;
        $this->response(['status' => 200, 'title' => 'Shop filter option','res' => $shop_filter_option], REST_Controller::HTTP_OK);
    }

    public function get_shops_post(){
        $this->token_check();

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'per_page',
                    'label' => 'per_page',
                    'rules' => 'required|numeric',
                    'errors' => [],
            ],
            [
                    'field' => 'page_number',
                    'label' => 'page_number',
                    'rules' => 'required|numeric',
                    'errors' => [],
            ],
             [
                    'field' => 'latitude',
                    'label' => 'latitude',
                    'rules' => 'required',
                    'errors' => [],
            ],
             [
                    'field' => 'longitude',
                    'label' => 'longitude',
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
            $result['res'] = [];
            $this->response($result, REST_Controller::HTTP_OK);

        }else{
            $filter = "";
            if(isset($_POST['filter']) && $_POST['filter']){
                $filter = $_POST['filter'];
                // if($_POST['filter'] != "all" && $_POST['filter'] != "favourite" && $_POST['filter'] != "nearby"){
                //     $result['status'] = 400;
                //     $result['title'] = "Filter values must be all,favourite or nearby";
                //     $result['res'] = [];
                //     $this->response($result, REST_Controller::HTTP_OK);
                // }
            }

            $search = "";
            if(isset($_POST['search']) && $_POST['search']){
                $search = $_POST['search'];
            }

            $shops = $this->product->get_shops($_POST['latitude'],$_POST['longitude'],$_POST['per_page'],$_POST['page_number'],$filter,$_POST['user_id'],$search);
            
            $result['status'] = 200;
            $result['title'] = "Shops list";
            $result['res'] = $shops;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function laundry_filter_option_get(){
        $filter = $this->db->select('id,name')->get('laundry_type')->result();
        $this->response(['status' => 200, 'title' => 'laundry filter option','res' => $filter], REST_Controller::HTTP_OK);
    }

    public function get_laundries_post(){
        $this->token_check();

        $config = [
            // [
            //         'field' => 'per_page',
            //         'label' => 'per_page',
            //         'rules' => 'required|numeric',
            //         'errors' => [],
            // ],
            [
                    'field' => 'shop_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            // [
            //         'field' => 'page_number',
            //         'label' => 'page_number',
            //         'rules' => 'required|numeric',
            //         'errors' => [],
            // ]
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
            $this->response($result, REST_Controller::HTTP_OK);

        }else{
            $search = "";
            if(isset($_POST['search'])){
                $search = $_POST['search'];
            }

            $filter = "";
            if(isset($_POST['filter'])){
                $filter = explode(',',$_POST['filter']);
                // if($_POST['filter'] != "all" && $_POST['filter'] != "favourite" && $_POST['filter'] != "nearby"){
                //     $result['status'] = 400;
                //     $result['title'] = "Filter values must be all,favourite or nearby";
                //     $result['res'] = [];
                //     $this->response($result, REST_Controller::HTTP_OK);
                // }

                $filter = array_filter($filter);
            }

            $laundries = $this->product->get_laundries($_POST['shop_id'],0,0,$search,$filter);
            $result['status'] = 200;
            $result['title'] = "Laundries list";
            $result['res'] = $laundries;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    // public function laundry_filter_option_get(){
    //     $shop_filter_option = SHOP_FILTER_OPTION;
    //     $this->response(['status' => 200, 'title' => 'Shop filter option','res' => $shop_filter_option], REST_Controller::HTTP_OK);
    // }

    public function get_laundry_post()
    {
        $this->token_check();
        $config = [
            [
                'field' => 'laundry_id',
                'rules' => 'required'
            ],
            [
                'field' => 'order_type',
                'rules' => 'required'
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
            $this->response($result, REST_Controller::HTTP_OK);
        }

        if($_POST['order_type'] != "standard" && $_POST['order_type'] != "urgent"){
            $result['status'] = 400;
            $result['title'] = 'order_type must be standard or urgent';
            $this->response($result, REST_Controller::HTTP_OK);
        }

        if($request = $this->product->get_laundry($_POST['laundry_id'],$_POST['order_type'])){
            $result['status'] = 200;
            $result['title'] = "Laundry details";
            $result['res'] = $request;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function get_capabilities_post(){
        $this->token_check();
        $config = [
            [
                    'field' => 'shop_id',
                    'label' => 'shop_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'laundry_id',
                    'label' => 'laundry_id',
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
            $result['res'] = [];
            $this->response($result, REST_Controller::HTTP_OK);

        }else{
            $capabilities = $this->product->get_capabilities($_POST['shop_id'],$_POST['laundry_id']);
            $result['status'] = 200;
            $result['title'] = "Capabilities list";
            $result['res'] = $capabilities;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function add_to_cart_post(){
        $this->token_check();
        // $_POST = json_decode($this->input->raw_input_stream,true);
        $_POST = $this->request->body;
        // print_r($_POST);
        // exit;

        $config = [
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'laundry_id',
                    'label' => 'laundry_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            // [
            //         'field' => 'qty',
            //         'label' => 'qty',
            //         'rules' => 'required|numeric',
            //         'errors' => [],
            // ],
            [
                    'field' => 'order_type',
                    'label' => 'order_type',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'services[]',
                    'label' => 'services',
                    'rules' => 'required',
                    'errors' => [],
            ],
        ];

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){
            $result['status'] = 400;
            foreach($this->form_validation->error_array() as $key => $val){
                $result['title'] = $val;
                break;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            if(empty($_POST['services'])){
                $result['status'] = 310;
                $result['title'] = "Select atleast one service";
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($_POST['order_type'] != "standard" && $_POST['order_type'] != "urgent"){
                $result['status'] = 320;
                $result['title'] = "order_type must be standard or urgent";
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($this->product->add_to_cart($_POST)){
                $result['status'] = 200;
                $result['title'] = "Cart data updated successfully";
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 330;
                $result['title'] = "Add to cart failed. please try again";
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function update_cart_post(){
        $this->token_check();
        $_POST = $this->request->body;

        $config = [
            [
                    'field' => 'cart_id',
                    'label' => 'cart_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'user_id',
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'laundry_id',
                    'label' => 'laundry_id',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'qty',
                    'label' => 'qty',
                    'rules' => 'required|numeric',
                    'errors' => [],
            ],
            [
                    'field' => 'order_type',
                    'label' => 'order_type',
                    'rules' => 'required',
                    'errors' => [],
            ],
            [
                    'field' => 'services[]',
                    'label' => 'services',
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
            if(empty($_POST['services'])){
                $result['status'] = 310;
                $result['title'] = "Select atleast one service";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($_POST['order_type'] != "standard" && $_POST['order_type'] != "urgent"){
                $result['status'] = 320;
                $result['title'] = "Enter valid order type";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($this->product->update_cart($_POST)){
                $result['status'] = 200;
                $result['title'] = "Cart data updated successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 330;
                $result['title'] = "Update cart failed. please try again";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function remove_from_cart_post(){
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

            $cart_id = "";
            if(isset($_POST['cart_id'])){
                $cart_id = $_POST['cart_id'];
            }
            if($this->product->remove_from_cart($_POST['user_id'],$cart_id)){
                $result['status'] = 200;
                $result['title'] = "Cart data updated successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function shop_to_favourite_post(){
        $this->token_check();

        $config = [
            [
                'field' => 'shop_id',
                'label' => 'shop_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'action',
                'label' => 'action',
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
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            if($_POST['action'] != "add" && $_POST['action'] != "remove"){
                $result['status'] = 320;
                $result['title'] = "Action value must be add or remove";
                $this->response($result, REST_Controller::HTTP_OK);
            }

            $action_status = $this->product->shop_to_favourite($_POST['shop_id'],$_POST['user_id'],$_POST['action']);

            if($action_status == "already"){
                $result['status'] = 310;
                $result['title'] = "Shop already added to your favourite list";
            }elseif($action_status == "add"){
                $result['status'] = 200;
                $result['title'] = "Shop added to your favourite list";
            }elseif($action_status == "remove"){
                $result['status'] = 200;
                $result['title'] = "Shop removed from your favourite list";
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function get_cart_get(){
        $this->token_check();
        $user_id = $_GET['user_id'];
        $cart = $this->product->get_cart($user_id);
        
        $result['status'] = 200;
        $result['title'] = "Cart";
        $result['res'] = $cart;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function switch_order_type_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'order_type',
                'label' => 'order_type',
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

            if($_POST['order_type'] != "standard" && $_POST['order_type'] != "urgent"){
                $result['status'] = 320;
                $result['title'] = "Enter valid order type";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($this->product->switch_order_type($_POST)){
                $result['status'] = 200;
                $result['title'] = "Order type change successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function get_dicsount_codes_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'vendor_id',
                'label' => 'vendor_id',
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
            $discounts = $this->product->get_discount($_POST['vendor_id']);
            $result['status'] = 200;
            $result['title'] = "Discount list";
            $result['res'] = $discounts;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function check_discount_code_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'discount_code',
                'label' => 'discount_code',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'vendor_id',
                'label' => 'vendor_id',
                'rules' => 'required',
                'errors' => [],
            ],[
                'field' => 'user_id',
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
            if($discount = $this->product->check_discount_code($_POST['discount_code'],$_POST['vendor_id'],$_POST['user_id'])){
                $result['status'] = 200;
                $result['title'] = "Discount Details";
                $result['res'] = $discount;
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 310;
                $result['title'] = "Invalid discount code";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function place_order_post(){
        $this->token_check();
        $_POST = $this->request->body;

        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'shop_id',
                'label' => 'shop_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'order_type',
                'label' => 'order_type',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'pick_location',
                'label' => 'pick_location',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'pickup_date',
                'label' => 'pickup_date',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'pickup_hour',
                'label' => 'pickup_hour',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'pickup_time',
                'label' => 'pickup_time',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'delivery_date',
                'label' => 'delivery_date',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'delivery_hour',
                'label' => 'delivery_hour',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'delivery_time',
                'label' => 'delivery_time',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'pick_lat',
                'label' => 'pick_lat',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'pick_lng',
                'label' => 'pick_lng',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'shop_lat',
                'label' => 'shop_lat',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'shop_lng',
                'label' => 'shop_lng',
                'rules' => 'required',
                'errors' => [],
            ],

            [
                'field' => 'payment_name',
                'label' => 'payment_name',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'payment_email',
                'label' => 'payment_email',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'payment_address',
                'label' => 'payment_address',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'payment_type',
                'label' => 'payment_type',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'payment_token',
                'label' => 'payment_token',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'order_amount',
                'label' => 'order_amount',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'discount',
                'label' => 'discount',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'delivery_fee',
                'label' => 'delivery_fee',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'net_amount',
                'label' => 'net_amount',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'online_payment_commision',
                'label' => 'online_payment_commision',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'total_amount',
                'label' => 'total_amount',
                'rules' => 'required',
                'errors' => [],
            ],
        ];

        // optional
        // online_payment_commision

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

            if($_POST['payment_type'] != "credit_card" && $_POST['payment_type'] != "cash" && $_POST['payment_type'] != "wallet"){
                $result['status'] = 310;
                $result['title'] = "Invalid payment_method. payment method must be credit_card,cash,wallet";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            // echo "111";
            if($this->product->add_order($_POST)){
                $result['status'] = 200;
                $result['title'] = "Order placed successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 310;
                $result['title'] = "order placing failed";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }

    }

    public function get_orders_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'tab',
                'label' => 'tab',
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

            if($_POST['tab'] != "ongoing" && $_POST['tab'] != "scheduled" && $_POST['tab'] != "history"){
                $result['status'] = 400;
                $result['title'] = "Tab values should be ongoing,scheduled or history.";
                $result['res'] = [];
                $this->response($result, REST_Controller::HTTP_OK);
            }

            $orders = $this->product->get_orders($_POST['user_id'],$_POST['tab']);
            $result['status'] = 200;
            $result['title'] = "Orders list";
            $result['res'] = $orders;
            $this->response($result, REST_Controller::HTTP_OK);

        }
    }

    public function cancel_order_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
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
            $order_cancel = $this->product->cancel_order($_POST['user_id'],$_POST['order_id']);

            if($order_cancel == "st_update"){
                $result['status'] = 200;
                $result['title'] = "Order canceled successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 310;
                $result['title'] = "Order can not be cancel. order status is ".$order_cancel;
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function reorder_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
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

            $order_cancel = $this->product->reorder_order($_POST['user_id'],$_POST['order_id']);
            if($order_cancel){
                $result['status'] = 200;
                $result['title'] = "Order Item added to cart successfully";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $result['status'] = 310;
                $result['title'] = "Something Wrong... Items added to cart failed";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function get_rating_reason_get(){
        $this->token_check();
        $rating_reasons = $this->product->get_rating_reason();
        
        $result['status'] = 200;
        $result['title'] = "Rating reason list";
        $result['res'] = $rating_reasons;
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function rate_order_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
                'label' => 'user_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'order_id',
                'label' => 'order_id',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'star',
                'label' => 'star',
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

            $star_ary = array(0.5,1,1.5,2,2.5,3,3.5,4,4.5,5);
            if(!in_array($_POST['star'],$star_ary)){
                $result['status'] = 301;
                $result['title'] = "Star values must be lessthan 5 and 0.5 figure";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

            if($_POST['star'] <= 3){
                if(!isset($_POST['reason_id']) && !isset($_POST['comment'])){
                    $result['status'] = 302;
                    $result['title'] = "Please Select Review Reason or Enter Comment !!!";
                    $result['res'] = (object) array();
                    $this->response($result, REST_Controller::HTTP_OK);
                }
            }

            $order_rate = $this->product->rate_order($_POST);
            if($order_rate == "already"){
                $result['status'] = 310;
                $result['title'] = "Order rate already added";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }elseif($order_rate == "insert"){
                $result['status'] = 200;
                $result['title'] = "Rating added successfully.";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }

        }
    }

    public function service_area_request_post(){
        $this->token_check();
        $config = [
            [
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|callback_chk_valid_email',
                'errors' => [],
            ],
            [
                'field' => 'phone',
                'label' => 'phone',
                'rules' => 'required|numeric',
                'errors' => [],
            ],
            [
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'latitude',
                'label' => 'latitude',
                'rules' => 'required',
                'errors' => [],
            ],
            [
                'field' => 'longitude',
                'label' => 'longitude',
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
            if($request = $this->product->add_service_area_request($_POST)){
                $result['status'] = 200;
                $result['title'] = "Request Added Successfully.";
                $result['res'] = (object) array();
                $this->response($result, REST_Controller::HTTP_OK);
            }
        }
    }

    public function get_checkout_post()
    {
        $this->token_check();
        $config = [
            [
                'field' => 'user_id',
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
            if($request = $this->product->get_checkout($_POST['user_id'])){
                $result['status'] = 200;
                $result['title'] = "Request Added Successfully.";
                $result['res'] = $request;
                $this->response($result, REST_Controller::HTTP_OK);
            }
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
}
