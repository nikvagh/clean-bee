<?php

use GrahamCampbell\ResultType\Result;

class Product_model extends CI_Model{
        function __construct(){
            parent::__construct();
            // $this->table='users';
            $this->curr_date = date('Y-m-d H:i:s');
            $this->today_date = date('Y-m-d');
        }

        public function get_time_slot(){
            $this->db->select('s.id,DATE_FORMAT(s.start_time, "%H:%i") as start_time,DATE_FORMAT(s.end_time, "%H:%i") as end_time,s.available');
            $this->db->from('slots s');
            $this->db->where('s.available','Y');
            $query = $this->db->get();

            $result = (object) array();
            if ($query->num_rows() > 0) {
                $result = $query->result();
            }
            return $result;
        }

        public function get_shops($latitude,$longitude,$per_page,$page_no,$filter,$user_id,$search){

            $maximum_nearby_km = $this->system->maximum_nearby_km;
            
            $offset = (int)$per_page * (int)$page_no;
            $this->db->select('s.id,s.shop_name,s.phone,s.description,s.opening_time,s.closing_time,s.latitude,s.longitude,s.address,s.delivery_fee,s.minimum_order,s.image,s.offer');
            // $this->db->join('shop_services ss','ss.shop_id = s.id','left');
            // $this->db->join('capabilities c','c.id = ss.capability_id','left');
            $this->db->from('shops s');
            $this->db->group_by('s.id');
            $this->db->limit($per_page,$offset);
            if($search != ""){
                $this->db->like('s.shop_name',$search);
            }

            if($filter == 4){
                // Promotions
                $this->db->where('s.offer','>', 0);
            }

            if($filter == 6){
                // Delivery by Clean Bee
                $this->db->where('s.delivery_by','CleanBee');
            }

            if($filter == 7){
                // Delivery by Shop
                $this->db->where('s.delivery_by','Shop');
            }

            // $this->db->where('s.available','Y');
            $query = $this->db->get();

            $res = array();
            if ($query->num_rows() > 0) {
                $result = $query->result();

                foreach($result as $key=>$val){

                    $this->db->select('AVG(rate) as rate');
                    $this->db->from('shop_ratings sr');
                    $this->db->where('sr.shop_id',$val->id);
                    $query3 = $this->db->get();
                    // echo $this->db->last_query();

                    $result3 = 0;
                    if($query3->row('rate') != null){
                        $result3 = $query3->row('rate');
                    }

                    $result[$key]->rating  = $rating =  number_format($result3,2,".","");
                    if($filter == 1){
                        // rating
                        if($rating < 3){
                            continue;
                        }
                    }

                    $favourite = false;
                    $favourite_q = $this->db->where('shop_id',$val->id)->where('user_id',$user_id)->get('shop_favourite')->row();
                    if($favourite_q){
                        $favourite = true;
                    }

                    $result[$key]->favourite = $favourite;
                    if($filter == 2){
                        // Favourite
                        if(!$favourite){
                            continue;
                        }
                    }

                    $km = radius_distance($latitude,$longitude,$val->latitude,$val->longitude);
                    $result[$key]->km = $km;
                    if($filter == 3){
                        // Nearby
                        if($km > $maximum_nearby_km){
                            continue;
                        }
                    }

                    $result[$key]->get_qar = '10';
                    if(file_exists(shop_IMG_PATH.$val->image)){
                        $result[$key]->image = base_url().shop_IMG_PATH.$val->image;
                    }else{
                        $result[$key]->image = "";
                    }

                    // =====================
                    // $this->db->select('c.id,c.name,c.arabic_name,c.image');
                    // $this->db->from('shop_services ss');
                    // $this->db->join('capabilities c','c.id=ss.capability_id','left');
                    // $this->db->where('ss.shop_id',$val->id);
                    // $this->db->group_by('ss.capability_id');
                    // $query2 = $this->db->get();

                    // $result2 = array();
                    // if ($query2->num_rows() > 0) {
                    //     $result2 = $query2->result();
                    //     foreach($result2 as $key2=>$val2){

                    //         if(file_exists(CAPABILITY_IMG_PATH.'thumb/120x120_'.$val2->image)){
                    //             $result2[$key2]->img_url = base_url().CAPABILITY_IMG_PATH.'thumb/120x120_'.$val2->image;
                    //         }else{
                    //             $result2[$key2]->img_url = "";
                    //         }
                            
                    //     }
                    // }
                    // $result[$key]->capabilities = $result2;

                    $res[] = $result[$key];
                }

            }
            return $res;
        }

        public function get_laundries($shop_id,$per_page="",$page_no="",$search,$filter){
            // $offset = (int)$per_page * (int)$page_no;
            // $query = $this->db->select('id,name')->get('laundry_type');

            $list = $this->db->from('laundry_type_assign lta')
                            ->join('laundries l','l.id = lta.laundry_id','left')
                            ->join('laundry_type lt','lt.id = lta.laundry_type_id','left')
                            ->select('lt.id,lt.name');
                            if(!empty($filter)){
                                $list = $this->db->where_in('lt.id',$filter);
                            }
                            $list = $list->where('l.shop_id',$shop_id)->get()->result();

            $laundry_types = [];
            foreach($list as $key=>$val){

                $laundry_types[] = ["laundry_type_id"=>$val->id,"name"=>$val->name];
                $laundries = $this->db->from('laundry_type_assign lta')
                                ->join('laundries l', 'lta.laundry_id = l.id')
                                ->select('l.id,l.name,l.arabic_name,l.does_require_car,l.specification,l.image');
                                if($search != ""){
                                    $laundries = $this->db->like('l.name',$search);
                                }
                                
                                $laundries = $this->db->where('l.shop_id',$shop_id)->group_by('l.id')->get()->result();

                foreach($laundries as $key1=>$val1){
                    if($val1->image != ''){
                        $img = base_url().LAUNDRY_IMG_PATH.$val1->image;
                    }else{
                        $img = "";
                    }
                    $laundries[$key1]->img = $img;
                }

                $list[$key]->items = $laundries;

            }

            $res['laundry_types'] = $laundry_types;
            $res['list'] = $list;
            return $res;
        }

        public function get_capabilities($shop_id,$laundry_id){
            $this->db->select('ss.id,ss.standard_amt,ss.urgent_amt,c.name,c.arabic_name,c.image,cu.currency_name');
            $this->db->join('capabilities c','c.id = ss.capability_id','left');
            $this->db->join('currency cu','cu.id = ss.currency','left');
            $this->db->where('ss.shop_id',$shop_id);
            $this->db->where('ss.laundry_id',$laundry_id);
            $this->db->from('shop_services ss');
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result();

                foreach($result as $key=>$val){
                    if(file_exists(CAPABILITY_IMG_PATH.'thumb/120x120_'.$val->image)){
                        $result[$key]->img_url = base_url().CAPABILITY_IMG_PATH.'thumb/120x120_'.$val->image;
                    }else{
                        $result[$key]->img_url = "";
                    }
                }
            }
            return $result;
        }

        public function check_item_available_into_cart($user_id,$laundry_id,$service){

            $available = "N";
            $this->db->select('c.id,c.qty,c.ss_ids');
            $this->db->where('c.user_id',$user_id);
            $this->db->where('c.laundry_id',$laundry_id);
            // $this->db->where('ss_ids',$service);
            $this->db->from('cart_product c');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                foreach($result as $key=>$val){
                    // $cart_service = explode(',',$val->ss_ids);
                    $cart_service =$val->ss_ids;

                    // sort($cart_service);
                    // sort($service);

                    if ($cart_service == $service){
                        $available = "Y";

                        return (object) array("cart_id"=>$val->id,"qty"=>$val->qty);
                        break;
                    }
                }
            }

            if($available == "N"){
                return false;
            }

        }

        public function get_price_by_services($services,$order_type,$qty){
            $this->db->select('ss.id,ss.standard_amt,ss.urgent_amt');
            $this->db->where_in('ss.id',$services);
            $this->db->from('shop_services ss');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                $price = 0;
                foreach($result as $key=>$val){
                    if($order_type == "standard"){
                        // $price = $qty * $row->standard_amt;
                        $price += $val->standard_amt;
                    }else if($order_type == "urgent"){
                        // $price = $qty * $row->urgent_amt;
                        $price += $val->urgent_amt;
                    }
                }
                
                return $price;
            }else{
                return false;
            }
            
            // print_r($services);
            // echo $order_type;
            // exit;
        }

        public function add_to_cart($data){
            $success = "N";
            $order_type = $data['order_type'];
            $user_id = $data['user_id'];

            $cart = $this->db->where('user_id',$user_id)->get('cart')->row();
            if($cart){
                $cart_id = $cart->id;
            }else{
                $cartD = array();
                $cartD['user_id'] = $user_id;
                $this->db->insert('cart',$cartD);
                $cart_id = $this->db->insert_id();
            }
            
            $total = 0;
            $cart_product_id = 0;
            foreach($data['services'] as $key=>$val){
                $laundry_capability_id = $val['laundry_capability_id'];
                $qty = $val['qty'];

                $ltc = $this->db->from('laundry_to_capabilities as ltc')
                                ->join('capabilities c','c.id=ltc.capability_id','left')
                                ->join('laundries l','l.id=ltc.laundry_id','left')
                                ->select('l.id as laundry_id,l.name as laundry_name,c.id as capability_id,c.name as capability_name,ltc.standard_amt,ltc.urgent_amt')
                                ->where('ltc.id',$laundry_capability_id)->get()->row();
                
                if($ltc){
                    if($order_type == 'standard'){
                        $single_amount = $ltc->standard_amt;
                    }else{
                        $single_amount = $ltc->urgent_amt;
                    }

                    $total += $total_amount = $single_amount*$qty;

                    $cart_pro = array();
                    $cart_pro['cart_id'] = $cart_id;
                    $cart_pro['laundry_id'] = $ltc->laundry_id;
                    $cart_pro['laundry_name'] = $ltc->laundry_name;
                    $cart_pro['laundry_capability_id'] = $data['ironing_type_id'];
                    $cart_pro['capability_id'] = $ltc->capability_id;
                    $cart_pro['capability_name'] = $ltc->capability_name;
                    $cart_pro['qty'] = $qty;
                    $cart_pro['single_amount'] = $single_amount;
                    $cart_pro['total_amount'] = $total_amount;
                    $cart_pro['order_type'] = $order_type;
                    $this->db->insert('cart_product',$cart_pro);
                    $cart_product_id = $this->db->insert_id();
                }
            }

            if($cart_product_id > 0){
                if(isset($data['ironing_type_id'])){
                    $it = $this->db->where('id',$data['ironing_type_id'])->get('ironing_type')->row();

                    $cartD = array();
                    $cartD['cart_id'] = $cart_id;
                    $cartD['cart_product_id'] = $cart_product_id;
                    $cartD['ironing_type_id'] = $data['ironing_type_id'];
                    $cartD['name'] = $it->name;
                    $this->db->insert('cart_ironing_type',$cartD);
                }

                if(isset($data['starch_level_id'])){
                    $sl = $this->db->where('id',$data['starch_level_id'])->get('starch_level')->row();

                    $starchD = array();
                    $starchD['cart_id'] = $cart_id;
                    $starchD['cart_product_id'] = $cart_product_id;
                    $starchD['starch_level_id'] = $data['starch_level_id'];
                    $starchD['name'] = $sl->name;
                    $this->db->insert('cart_starch_level',$starchD);
                }
                $success = "Y";
            }

            $this->system->update_cart_total($data['user_id'],$cart_id);
            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function update_cart($data){
            $success = "N";
            if($price = $this->get_price_by_services($data['services'],$data['order_type'],$data['qty'])){
            }else{
                return false;
            }
            $services_str = $data['services'];

            $cart_id = $data['cart_id'];
            $new_qty = (int)$data['qty'];

            // $old_cart = $this->db->where('user_id', $data['user_id'])->get('cart')->row();
            // $cart_data_cart = array();
            // $cart_data_cart['subtotal'] = $new_qty * $price;
            // $cart_data_cart['total'] = $old_cart->total+($data['qty'] * $price);
            // $this->db->where('user_id',$data['user_id']);
            // $this->db->update('cart',$cart_data_cart);

            $cart_data = array();
            $cart_data['qty'] = $new_qty;
            $cart_data['ss_ids'] = $services_str;
            $cart_data['price'] = $price;
            $cart_data['price_total'] = $new_qty * $price;
            $cart_data['updated_at'] = date('Y-m-d H:i:s');

            $this->db->where('id',$cart_id);
            $this->db->update('cart_product',$cart_data);
            
            if(set_cart_totel($data['user_id'])){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function remove_from_cart($user_id,$cart_id){
            $this->db->where('user_id', $user_id);
            if($cart_id != ""){
                $this->db->where('id', $cart_id);
            }
            $this->db->delete('cart_product');
           
            if (set_cart_totel($user_id)){
                return true;
            }else{
                return false;
            }
        }

        public function get_cart($user_id){
            $this->db->select('c.id,l.id as laundry_id,l.name as laundry,c.qty,c.ss_ids as capabilities,c.price,c.price_total');
            // $this->db->where_in('ss.id',$services);
            $this->db->from('cart_product c');
            $this->db->join('laundries l','l.id = c.laundry_id','left');
            $this->db->where('c.user_id', $user_id);
            $query = $this->db->get();

            $result = array();
            if($query->num_rows() > 0){
                $result = $query->result();
                foreach($result as $key=>$val){
                    $services = explode(',',$val->capabilities);
                    $result[$key]->capabilities = $services;
                }
            }
            return $result;
        }

        public function switch_order_type($request){

            $this->db->select('c.*');
            $this->db->from('cart c');
            $this->db->where('c.user_id', $request['user_id']);
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $result = $query->result();
                foreach($result as $key=>$val){

                    $price = $this->get_price_by_services(explode(',',$val->ss_ids),$request['order_type'],$val->qty);
                    $new_qty = (int)$val->qty;

                    $cart_data = array();
                    $cart_data['price'] = $price;
                    $cart_data['price_total'] = $new_qty * $price;
                    $cart_data['updated_at'] = date('Y-m-d H:i:s');

                    $this->db->where('id',$val->id);
                    if($this->db->update('cart',$cart_data)){
                        $success = "Y";
                    }

                }
            }

            return true;
        }

        public function check_user_favourite($shop_id,$user_id){
            $this->db->select('sf.id');
            $this->db->where('sf.shop_id',$shop_id);
            $this->db->where('sf.user_id',$user_id);
            $this->db->from('shop_favourite sf');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            }
        }

        public function shop_to_favourite($shop_id,$user_id,$action){

            if($action == "add"){
                if($this->check_user_favourite($shop_id,$user_id)){
                    return "already";
                }else{
                    $fav_data = array();
                    $fav_data['shop_id'] = $shop_id;
                    $fav_data['user_id'] = $user_id;
                    if($this->db->insert('shop_favourite',$fav_data)){
                        return "add";
                    }
                }
            }elseif($action == "remove"){
                $this->db->where('shop_id', $shop_id);
                $this->db->where('user_id', $user_id);
                if ($query = $this->db->delete('shop_favourite')){
                    return "remove";
                }
            }

        }

        public function get_discount($vendor_id){
            $this->db->select('d.id,d.name,d.discount_type,d.percentage,d.value,d.applied_to,d.expiry_date');
            $this->db->where('find_in_set('.$vendor_id.',d.vendors) > 0');
            $this->db->where('d.expiry_date >=',$this->curr_date);
            $this->db->from('discounts d');
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result();
            }
            return $result;
        }

        public function check_discount_code($discount_code,$vendor_id,$user_id){
            $this->db->select('d.id,d.name,d.discount_type,d.percentage,d.value,d.applied_to,d.expiry_date');
            $this->db->where('d.name',$discount_code);
            $this->db->where('d.expiry_date >=',$this->curr_date);
            $this->db->where('find_in_set('.$vendor_id.',d.vendor_id) > 0');
            $this->db->from('discounts d');
            $query = $this->db->get();

            $row = (object) array();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                
                $old_cart = $this->db->where('user_id', $user_id)->get('cart')->row();
                $cart_data_cart = array();
                $cart_data_cart['discount'] = $old_cart->discount + $row->value;
                $cart_data_cart['total'] = $old_cart->total - $row->value;
                // print_r($old_cart->total);
                // exit();
                $this->db->where('user_id',$user_id);
                $this->db->update('cart',$cart_data_cart);
            }else{
                $row = false;
            }

            return $row;
        }

        public function get_shop_by_id($shop_id){
            $this->db->select('s.id,s.cleanbee_percentage');
            $this->db->where('s.id',$shop_id);
            $this->db->from('shops s');
            $query = $this->db->get();

            $row = (object) array();
            if ($query->num_rows() > 0) {
                $row = $query->row();
            }
            return $row;
        }

        public function add_order($request){

            // $customer = $this->user->get_customer_by_id($request['user_id']);
            // print_r($customer);
            
            $shop = $this->get_shop_by_id($request['shop_id']);
            // print_r($shop);

            $system_per = $shop->cleanbee_percentage;
            $net_amount = $request['net_amount'];
            $commission_amount = ($net_amount*$system_per)/100;
            $payable_amount_to_shop = $net_amount - $commission_amount;
            // exit;

            $success = "N";

            $cart_data = $this->get_cart($request['user_id']);
            // print_r($cart_data);

            if(!empty($cart_data)){

                $order_data = array();
                $order_data['user_id'] = $request['user_id'];
                $order_data['shop_id'] = $request['shop_id'];
                $order_data['order_type'] = $request['order_type'];
                $order_data['pick_location'] = $request['pick_location'];
                $order_data['pickup_date'] = $request['pickup_date'];
                $order_data['pickup_hour'] = $request['pickup_hour'];
                $order_data['pickup_time'] = $request['pickup_time'];
                $order_data['delivery_date'] = $request['delivery_date'];
                $order_data['delivery_hour'] = $request['delivery_hour'];
                $order_data['delivery_time'] = $request['delivery_time'];
                $order_data['order_cost'] = $net_amount;
                $order_data['delivery_fee'] = $request['delivery_fee'];
                $order_data['pick_lat'] = $request['pick_lat'];
                $order_data['pick_lng'] = $request['pick_lng'];
                $order_data['shop_lat'] = $request['shop_lat'];
                $order_data['shop_lng'] = $request['shop_lng'];

                $order_data['order_status'] = 1;
                $order_data['created_at'] = $this->curr_date;

                if($this->db->insert('orders',$order_data)){
                    
                    $order_id = $this->db->insert_id();

                    foreach($cart_data as $key=>$val){
                        $order_item = array();
                        $order_item['order_id'] = $order_id;
                        $order_item['laundry_id'] = $val->laundry_id;
                        $order_item['qty'] = $val->qty;
                        $order_item['ss_ids'] = implode(',',$val->capabilities);
                        $order_item['price'] = $val->price;
                        $order_item['price_total'] = $val->price_total;
    
                        if($this->db->insert('order_items',$order_item)){
                    
                        }
                    }

                    $payment_data = array();
                    $payment_data['order_id'] = $order_id;
                    $payment_data['shop_id'] = $request['shop_id'];
                    $payment_data['payment_token'] = $request['payment_token'];
                    $payment_data['fill_name'] = $request['payment_name'];
                    $payment_data['total_amount'] = $request['total_amount'];
                    $payment_data['net_amount'] = $request['net_amount'];
                    // $payment_data['paypal_fee'] = $val['total_amount'];
                    $payment_data['email'] = $request['payment_email'];
                    $payment_data['payment_type'] = $request['payment_type'];
                    if($request['payment_type'] == "credit_card" || $request['payment_type'] == "wallet"){
                        $payment_data['date_received'] = $this->curr_date;
                    }
                    $payment_data['address'] = $request['payment_address'];
                    if($request['payment_type'] == "credit_card" || $request['payment_type'] == "wallet"){
                        $payment_data['status'] = 'paid';
                    }else{
                        $payment_data['status'] = 'pending';
                    }
                    $payment_data['order_amount'] = $request['order_amount'];
                    $payment_data['discount'] = $request['discount'];
                    $payment_data['delivery_fee'] = $request['delivery_fee'];
                    $payment_data['online_payment_commision'] = $request['online_payment_commision'];

                    $payment_data['payable_amount_to_shop'] = $payable_amount_to_shop;
                    $payment_data['commission_amount'] = $commission_amount;
                    $payment_data['created_at'] = $this->curr_date;
                    if($this->db->insert('payments',$payment_data)){

                        $this->remove_from_cart($request['user_id'],'');
                        $success = "Y";
                    
                    }

                }

            }else{

            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }

        }

        public function get_orderDetails($order_id){
            $this->db->select('o.id,ur.email as rider_email,s.shop_name,o.order_type,o.pick_location,o.pickup_date,o.pickup_hour,o.pickup_time,o.delivery_date,o.delivery_time,os.status_code,os.status_title,o.order_cost,o.delivery_fee,o.created_at,
                                p.payment_type,p.status as payment_status,
                                c.firstname as user_firstname,c.lastname as user_lastname,uc.phone as user_phone,uc.email as user_email,c.address as user_address
                            ');
            $this->db->from('orders o');
            $this->db->join('users ur','ur.id = o.rider_id','left');
            $this->db->join('shops s','s.id = o.shop_id','left');
            $this->db->join('order_status os','os.id = o.order_status','left');
            $this->db->join('payments p','p.order_id = o.id','left');
            $this->db->join('users uc','uc.id = o.user_id','left');
            $this->db->join('customers c','c.customer_id = uc.id','left');
            // $this->db->join('order_items oi','oi.order_id = o.id','left');
            $this->db->where('o.id', $order_id);
            $query = $this->db->get();

            $result = (object) array();
            if ($query->num_rows() > 0) {
                $result = $query->row();

                $this->db->select('oi.id,oi.laundry_id,l.name as lanudry_name,oi.ss_ids');
                $this->db->from('order_items oi');
                $this->db->join('laundries l','l.id = oi.laundry_id','left');
                $this->db->where('oi.order_id', $order_id);
                $query1 = $this->db->get();

                $result1 = array();
                if ($query1->num_rows() > 0) {
                    $result1 = $query1->result();

                    foreach($result1 as $key=>$val){
                        $services_ids = $val->ss_ids;
                        $services_ids_ary = explode(",", $services_ids);

                        $this->db->select('GROUP_CONCAT(c.name) as services');
                        $this->db->from('capabilities c');
                        $this->db->where_in('c.id', $services_ids_ary);
                        $query2 = $this->db->get();
                        
                        $services_str = "";
                        if ($query2->num_rows() > 0) {
                            $result2 = $query2->row();
                            $services_str = $result2->services;
                            // print_r($result2);
                        }

                        $result1[$key]->services = $services_str;
                        unset($result1[$key]->ss_ids);
                    }

                }
                // echo $this->db->last_query();
                // print_r($result);
                // exit;

                $result->items = $result1;

            }
            return $result;
        }

        public function get_todays_orders($user_id){
            $this->db->select('o.id');
            $this->db->from('orders o');
            $this->db->where('o.user_id', $user_id);
            // $this->db->where('o.created_at', $this->today_date);
            $this->db->where('CAST(o.created_at As Date) = "'.$this->today_date.'"');
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;

            $result = array();
            if ($query->num_rows() > 0) {
                $orders_list = $query->result();

                foreach($orders_list as $key=>$val){
                    $result[] = $this->get_orderDetails($val->id);
                }

            }
            return $result;
        }

        public function get_orders($user_id,$tab){
            $this->db->select('o.id');
            $this->db->from('orders o');
            $this->db->where('o.user_id', $user_id);
            // $this->db->join('order_status os','os.id = o.order_status','left');
            // $this->db->where('CAST(o.created_at As Date) = "'.$this->today_date.'"');
            
            if($tab == "ongoing"){
                $this->db->where('o.order_status >=', 3);
                $this->db->where('o.order_status <=', 10);
            }
            if($tab == "scheduled"){
                $this->db->where('o.order_status', 1);
            }
            if($tab == "history"){
                $this->db->where('o.order_status >=', 11);
            }
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;

            $result = array();
            if ($query->num_rows() > 0) {
                $orders_list = $query->result();

                foreach($orders_list as $key=>$val){
                    $result[] = $this->get_orderDetails($val->id);
                }

            }
            return $result;
        }

        public function cancel_order($user_id,$order_id){
            $this->db->select('o.id,o.order_status,os.status_title');
            $this->db->from('orders o');
            $this->db->where('o.id',$order_id);
            $this->db->join('order_status os','os.id = o.order_status','left');
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;

            $result = "";
            if ($query->num_rows() > 0) {

                $orders = $query->row();
                if($orders->order_status <= 2){

                    $order_data = array();
                    $order_data['order_status'] = 12;
                    $this->db->where('id',$order_id);
                    if($this->db->update('orders',$order_data)){
                        $result = "st_update";
                    }

                }else{
                    $result = $orders->status_title;
                }

            }
            return $result;
        }

        public function reorder_order($user_id,$order_id){

            $this->remove_from_cart($user_id,'');

            $this->db->select('oi.*,o.order_status,o.user_id,o.order_type');
            $this->db->from('order_items oi');
            $this->db->where('oi.order_id',$order_id);
            // $this->db->join('order_status os','os.id = o.order_status','left');
            $this->db->join('orders o','o.id = oi.order_id','left');
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;

            $added_cart_cnt = 0;
            if ($query->num_rows() > 0) {

                $order_items = $query->result();
                // print_r($order_items);
                // exit;

                foreach($order_items as $key => $val){
                    $cart_data = array();
                    $cart_data['user_id'] = $val->user_id;
                    $cart_data['laundry_id'] = $val->laundry_id;
                    $cart_data['qty'] = $val->qty;
                    $cart_data['order_type'] = $val->order_type;
                    $cart_data['services'] = explode(',',$val->ss_ids);

                    if($this->add_to_cart($cart_data)){
                        $added_cart_cnt++;
                    }
                }

            }

            if($added_cart_cnt > 0){
                return true;
            }else{
                return false;
            }

        }

        public function rate_order($request){
            // print_r($request);
            // exit;

            $this->db->select('or.*');
            $this->db->from('order_rating or');
            $this->db->where('or.order_id',$request['order_id']);
            $query = $this->db->get();

            $res_status = "";
            if ($query->num_rows() > 0) {
                $res_status = "already";
            }else{
                $rate_data = array();
                $rate_data['order_id'] = $request['order_id'];
                $rate_data['star'] = $request['star'];
                if($rate_data['star'] <= 3){
                    $rate_data['reason_id'] = $request['reason_id'];
                }
                if($rate_data['star'] <= 3 && isset($request['comment'])){
                    $rate_data['comment'] = $request['comment'];
                }
                $rate_data['created_at'] = $this->curr_date;
                if($this->db->insert('order_rating',$rate_data)){
                    $res_status = "insert";
                }
            }

            return $res_status;

        }

        public function get_rating_reason(){
            $this->db->select('rr.*');
            $this->db->from('review_reasons rr');
            $query = $this->db->get();

            $result = array();
            if($query->num_rows() > 0){
                $result = $query->result();
            }
            return $result;
        }


        public function add_service_area_request($request){

            $service_data = array();
            $service_data['email'] = $request['email'];
            $service_data['phone'] = $request['phone'];
            $service_data['address'] = $request['address'];
            $service_data['latitude'] = $request['latitude'];
            $service_data['longitude'] = $request['longitude'];
            if($this->db->insert('service_area_request',$service_data)){
                return true;
            }else{
                return false;
            }

        }



        // =========================== for rider 

        public function get_assigned_order_to_rider($rider_id,$tab,$filter){
            $this->db->select('o.id');
            $this->db->from('orders o');
            $this->db->where('o.rider_id', $rider_id);
            if($tab == "history"){
                $this->db->where('o.order_status >=', 11);
            }

            if(isset($filter) && $filter != ""){
                $this->db->join('shops s','s.id = o.shop_id','left');
                $this->db->join('users u','u.id = o.user_id','left');
                $this->db->join('order_items oi','oi.id = o.id','left');
                $this->db->join('laundries l','l.id = oi.laundry_id','left');
                $this->db->join('capabilities c','find_in_set(c.id,oi.ss_ids) > 0','left');
                $this->db->where('( 
                                    (s.shop_name like "%'.$filter.'%") OR 
                                    (u.phone like "%'.$filter.'%") OR 
                                    (u.email like "%'.$filter.'%") OR 
                                    (l.name like "%'.$filter.'%") OR 
                                    (c.name like "%'.$filter.'%") 
                                )');
                // $this->db->where('o.order_status >=', 11);
            }
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;

            $result = array();
            if ($query->num_rows() > 0) {
                $orders_list = $query->result();

                foreach($orders_list as $key=>$val){
                    $result[] = $this->get_orderDetails($val->id);
                }

            }
            return $result;
        }

        public function start_order($order_id){
            $this->db->select('o.id');
            $this->db->from('orders o');
            $this->db->where('o.id', $order_id);
            $this->db->where('o.pickup_date', $this->today_date);
            
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;
            $success = "";
            if ($query->num_rows() > 0) {
                $order = $query->row();

                $order_data = array();
                $order_data['order_status'] = 3;
                $order_data['updated_at'] = $this->curr_date;

                $this->db->where('id',$order->id);
                if($this->db->update('orders',$order_data)){
                    // echo $this->db->last_query();
                    // exit;
                    $success = "Y";
                }
            }else{
                $success = "N";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function get_laundry($id,$order_type)
        {
            $result = $this->db->where('id',$id)->select('id,name,arabic_name,image')->get('laundries')->row();
            if($result->image){
                $result->image = base_url().LAUNDRY_IMG_PATH.$result->image;
            }else{
                $result->image = "";
            }

            $select = "";
            if($order_type == "standard"){
                $select = ",standard_amt as amount";
            }else if($order_type == "urgent"){
                $select = ",urgent_amt as amount";
            }

            $query = $this->db->from('laundry_to_capabilities ltc')
                        ->join('capabilities c', 'ltc.capability_id = c.id','left')
                        ->select('ltc.id as laundry_capability_id,c.name,c.arabic_name'.$select)
                        ->where('ltc.laundry_id',$id)
                        ->get();
            $result->items = $query->result();
            // foreach ($result->items as $key => $value) {
            //     if(!empty($value->image)){
            //         $result->items[$key]->image = base_url().LAUNDRY_IMG_PATH.$value->image;
            //     }else{
            //         $result->items[$key]->image = "";
            //     }
            // }

            $result->ironing_type = [];
            $result->starch_level = [];

            $result->starch_level = $this->db->from('laundry_to_starch_level lts')
                                    ->join('starch_level sl', 'sl.id = lts.starch_level_id','left')
                                    ->select('sl.id,sl.name')
                                    ->where('lts.laundry_id',$id)->get()->result();

            $result->ironing_type = $this->db->from('laundry_to_ironing_type lti')
                                    ->join('ironing_type it', 'it.id = lti.ironing_type_id','left')
                                    ->select('it.id,it.name')
                                    ->where('lti.laundry_id',$id)->get()->result();
                                    
            return $result;
        }

        public function get_checkout($user_id)
        {
            $result = array();
            $this->db->where('user_id',$user_id);
            $query1 = $this->db->get('cart')->row();
            // print_r($query1->delivery_fees);
            // exit();
            $this->db->select('c.id,l.name as laundry_name,c.qty,c.price_total,c.price');
            $this->db->where('c.user_id',$user_id);
            $this->db->join('laundries l', 'c.laundry_id = l.id'); 
            $query = $this->db->get('cart_product c');

            $result['subtotal']=0;
            $result['delivery fees']=0;
            $result['discount']=0;
            $result['total']=0;
            $result['items']=[];
            if ($query->num_rows() > 0) {
                $result['subtotal'] = (int)$query1->subtotal;
                $result['delivery_fees']=(int)$query1->delivery_fees;
                $result['discount']=(int)$query1->discount;
                $result['total'] = (int)$query1->total;
                $result['items'] = $query->result();
            }
            return $result;
        }
    }
?>