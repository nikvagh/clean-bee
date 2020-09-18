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

    public function get_laundries_post(){
        $this->token_check();

        $config = [
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
            $laundries = $this->product->get_laundries($_POST['per_page'],$_POST['page_number']);
            $result['status'] = 200;
            $result['title'] = "Laundries list";
            $result['res'] = $laundries;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function get_shops_post(){
        $this->token_check();

        $config = [
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
            $shops = $this->product->get_shops($_POST['per_page'],$_POST['page_number']);
            
            $result['status'] = 200;
            $result['title'] = "Shops list";
            $result['res'] = $shops;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    // public function index_get($id = 0)
    // {
    //     $this->token_check();
        
    //     if (!empty($id)) {
    //         $data = $this->db->get_where("products", ['id' => $id])->row_array();
    //     } else {
    //         $data = $this->db->get("products")->result();
    //     }

    //     $result['status'] = 401;
    //     $result['title'] = "Success!";
    //     $result['res'] = $data;
        
    //     $this->response($result, REST_Controller::HTTP_OK);
    // }

    // /**
    //  * Get All Data from this method.
    //  *
    //  * @return Response
    //  */
    // public function index_post()
    // {
    //     $input = $this->input->post();
    //     $this->db->insert('products', $input);

    //     $this->response(['Product created successfully.'], REST_Controller::HTTP_OK);
    // }

    // /**
    //  * Get All Data from this method.
    //  *
    //  * @return Response
    //  */
    // public function index_put($id)
    // {
    //     $input = $this->put();
    //     $this->db->update('products', $input, array('id' => $id));

    //     $this->response(['Product updated successfully.'], REST_Controller::HTTP_OK);
    // }

    // /**
    //  * Get All Data from this method.
    //  *
    //  * @return Response
    //  */
    // public function index_delete($id)
    // {
    //     $this->db->delete('products', array('id' => $id));

    //     $this->response(['Product deleted successfully.'], REST_Controller::HTTP_OK);
    // }
}
