<?php
    class Product_model extends CI_Model{
        function __construct(){
            parent::__construct();
            // $this->table='users';
            $this->curr_date = date('Y-m-d H:i:s');
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

        public function get_shops($per_page,$page_no,$filter,$user_id){

            $offset = (int)$per_page * (int)$page_no;
            $this->db->select('s.id,s.shop_name,s.phone,s.description,s.opening_time,s.closing_time,s.latitude,s.longitude,s.address,s.image,
                                IF(sf.id > 0, "true", "false") as favourite');
            $this->db->join('shop_favourite sf','sf.shop_id = s.id AND sf.user_id='.$user_id,'left');
            // $this->db->join('shop_services ss','ss.shop_id = s.id','left');
            // $this->db->join('capabilities c','c.id = ss.capability_id','left');
            $this->db->from('shops s');
            $this->db->group_by('s.id');
            $this->db->limit($per_page,$offset);
            // $this->db->where('s.available','Y');
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result();

                foreach($result as $key=>$val){

                    if($filter == "nearby"){

                    }

                    if($filter = "favourite"){

                    }

                    if(file_exists(LAUNDRY_IMG_PATH.'thumb/120x120_'.$val->image)){
                        $result[$key]->img_url = base_url().LAUNDRY_IMG_PATH.'thumb/120x120_'.$val->image;
                    }else{
                        $result[$key]->img_url = "";
                    }

                    // =====================
                    $this->db->select('c.id,c.name,c.arabic_name,c.image');
                    $this->db->from('shop_services ss');
                    $this->db->join('capabilities c','c.id=ss.capability_id','left');
                    $this->db->where('ss.shop_id',$val->id);
                    $this->db->group_by('ss.capability_id');
                    $query2 = $this->db->get();

                    $result2 = array();
                    if ($query2->num_rows() > 0) {
                        $result2 = $query2->result();
                        foreach($result2 as $key2=>$val2){

                            if(file_exists(CAPABILITY_IMG_PATH.'thumb/120x120_'.$val2->image)){
                                $result2[$key2]->img_url = base_url().CAPABILITY_IMG_PATH.'thumb/120x120_'.$val2->image;
                            }else{
                                $result2[$key2]->img_url = "";
                            }
                            
                        }
                    }
                    $result[$key]->capabilities = $result2;

                    // =====================
                    $this->db->select('AVG(rate) as rate');
                    $this->db->from('shop_ratings sr');
                    $this->db->where('sr.shop_id',$val->id);
                    $query3 = $this->db->get();
                    // echo $this->db->last_query();

                    $result3 = 0;
                    if($query3->row('rate') != null){
                        $result3 = $query3->row('rate');
                    }

                    $result[$key]->rating =  number_format($result3,2,".","");

                }

            }
            return $result;

        }

        public function get_laundries($per_page,$page_no,$search){
            
            $offset = (int)$per_page * (int)$page_no;
            $this->db->select('l.id,l.name,l.arabic_name,l.does_require_car,l.image');
            $this->db->from('laundries l');
            $this->db->order_by('l.sort_order','ASC');
            if($search != ""){
                $this->db->like('l.name',$search);
            }
            $this->db->limit($per_page,$offset);
            // $this->db->where('s.available','Y');
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result();

                foreach($result as $key=>$val){
                    if(file_exists(LAUNDRY_IMG_PATH.'thumb/120x120_'.$val->image)){
                        $result[$key]->img_url = base_url().LAUNDRY_IMG_PATH.'thumb/120x120_'.$val->image;
                    }else{
                        $result[$key]->img_url = "";
                    }
                }

            }
            return $result;
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
            $this->db->from('cart c');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                foreach($result as $key=>$val){
                    $cart_service = explode(',',$val->ss_ids);

                    sort($cart_service);
                    sort($service);

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
            // print_r($data);
            $success = "N";
            if($price = $this->get_price_by_services($data['services'],$data['order_type'],$data['qty'])){

            }else{
                return false;
            }

            $services_str = implode(',',$data['services']);

            if($cart_data = $this->check_item_available_into_cart($data['user_id'],$data['laundry_id'],$data['services'])){

                // print_r($cart_data);
                // exit;

                $cart_id = $cart_data->cart_id;
                // $old_qty = $cart_data->qty;
                // echo $data['qty'];
                // exit;
                $new_qty = (int)$cart_data->qty + (int)$data['qty'];

                $cart_data = array();
                $cart_data['qty'] = $new_qty;
                // $cart_data['ss_ids'] = $services_str;
                $cart_data['price'] = $price;
                $cart_data['price_total'] = $new_qty * $price;
                $cart_data['updated_at'] = date('Y-m-d H:i:s');

                $this->db->where('id',$cart_id);
                if($this->db->update('cart',$cart_data)){
                    // echo $this->db->last_query();
                    // exit;
                    $success = "Y";
                }

            }else{
                $cart_data = array();
                $cart_data['user_id'] = $data['user_id'];
                $cart_data['laundry_id'] = $data['laundry_id'];
                $cart_data['qty'] = $data['qty'];
                $cart_data['ss_ids'] = $services_str;
                $cart_data['price'] = $price;
                $cart_data['price_total'] = $data['qty'] * $price;
                
                if($this->db->insert('cart',$cart_data)){
                    $success = "Y";
                }
            }

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
            $services_str = implode(',',$data['services']);

            $cart_id = $data['cart_id'];
            $new_qty = (int)$data['qty'];

            $cart_data = array();
            $cart_data['qty'] = $new_qty;
            $cart_data['ss_ids'] = $services_str;
            $cart_data['price'] = $price;
            $cart_data['price_total'] = $new_qty * $price;
            $cart_data['updated_at'] = date('Y-m-d H:i:s');

            $this->db->where('id',$cart_id);
            if($this->db->update('cart',$cart_data)){
                // echo $this->db->last_query();
                // exit;
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
            if ($query = $this->db->delete('cart')){
                return true;
            }else{
                return false;
            }
        }

        public function get_cart($user_id){
            $this->db->select('c.id,l.name as laundry,c.qty,c.ss_ids as capabilities,c.price,c.price_total');
            // $this->db->where_in('ss.id',$services);
            $this->db->from('cart c');
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

        public function check_discount_code($discount_code,$vendor_id){
            $this->db->select('d.id,d.name,d.discount_type,d.percentage,d.value,d.applied_to,d.expiry_date');
            $this->db->where('d.name',$discount_code);
            $this->db->where('d.expiry_date <=',$this->curr_date);
            $this->db->where('find_in_set('.$vendor_id.',d.vendors) > 0');
            $this->db->from('discounts d');
            $query = $this->db->get();

            $row = (object) array();
            if ($query->num_rows() > 0) {
                $row = $query->row();
            }else{
                $row = false;
            }

            return $row;
        }
        
    }
?>