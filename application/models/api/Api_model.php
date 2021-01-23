<?php
    class Api_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='users';
            $this->curr_date = date('Y-m-d H:i:s');
        }

        public function get_ads(){
            $this->db->select('a.id,a.title,a.img');
            $this->db->from('ads a');
            $this->db->where('a.status','Enable');
            $query = $this->db->get();

            $result = (object) array();
            if ($query->num_rows() > 0) {

                $result = $query->result();
                // print_r($result);
                // exit;
                foreach($result as $key=>$val){

                    if(file_exists(ADBNR_PATH.$val->img)){
                        $result[$key]->img = base_url().ADBNR_PATH.$val->img;
                    }else{
                        $result[$key]->img = "";
                    }
                }
            }
            return $result;
        }
        public function order_again($id)
        {
            // $this->db->from('orders o');
           $query= $this->db
                        ->select('*')
                        ->select('o.id')
                        ->where('o.user_id',$id)
                        ->join('shops', 'o.shop_id = shops.id')
                        ->order_by('o.id',"desc")
                        ->limit(3)
                        ->get('orders o')
                        ->result();

            if (count($query) > 0) {
            $result = [];
                foreach($query as $key=>$val){

                    $data = $this->db->where('order_id',$val->id)
                        ->limit(3)
                        ->join('laundries', 'order_items.laundry_id = laundries.id')
                        ->get('order_items')
                        ->result();
                        $order_items = [];
                            if (count($data) > 0) {
                                foreach ($data as  $value) {
                                    $order_items[] = array('qty' => $value->qty,'name' => $value->name, );
                                }
                            }
                $result[] = array('id' => $val->id,
                                        'shop_name' => $val->shop_name,
                                        'order_cost' => $val->order_cost,
                                        'date' => $val->created_at,
                                        'order_items' =>  $order_items,
                                         );
                }
                return $result;
            }
        }
        public function freedelivery()
        {
            $query = $this->db->where('freedelivery','Y')
                        ->limit(3)
                        ->get('shops')
                        ->result();
                if (count($query) > 0) {
                    $result = [];
                    foreach($query as $key=>$val){
                        if(file_exists(shop_IMG_PATH.$val->image)){
                            $img = base_url().shop_IMG_PATH.$val->image;
                        }else{  $img = ""; }

                         $shop_ratings = $this->db->where('shop_id',$val->id)
                                    ->get('shop_ratings')->result();
                                    $rate=0;  $no=0;
                                    foreach ($shop_ratings as $key => $value) {
                                        $rate += $value->rate;  $no++;
                                    }
                        $review_count= ($rate/$no);
                        $result[] = array('id' => $val->id,
                            'shop_name' => $val->shop_name,
                            'image' => $img,
                            'minimum_order' => $val->minimum_order,
                            'review_count' => $review_count, );
                    }
                }
            return $result;
        }
        public function twenty_four_hours()
        {
           $query = $this->db->where('24hrs','Y')
                        ->limit(3)
                        ->get('shops')
                        ->result();
                if (count($query) > 0) {
                    $result = [];
                    foreach($query as $key=>$val){
                        if(file_exists(shop_IMG_PATH.$val->image)){
                            $img = base_url().shop_IMG_PATH.$val->image;
                        }else{  $img = ""; }

                         $shop_ratings = $this->db->where('shop_id',$val->id)
                                    ->get('shop_ratings')->result();
                                    $rate=0;  $no=0;
                                    foreach ($shop_ratings as $key => $value) {
                                        $rate += $value->rate;  $no++;
                                    }
                        $review_count= ($rate/$no);
                        $result[] = array('id' => $val->id,
                            'shop_name' => $val->shop_name,
                            'image' => $img,
                            'minimum_order' => $val->minimum_order,
                            'review_count' => $review_count, );
                    }
                }
            return $result;
        }
    }
?>