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

        public function get_laundries($per_page,$page_no){
            
            $offset = (int)$per_page * (int)$page_no;
            $this->db->select('l.id,l.name,l.arabic_name,l.does_require_car,l.image');
            $this->db->from('laundries l');
            $this->db->order_by('l.sort_order','ASC');
            $this->db->limit($per_page,$offset);
            // $this->db->where('s.available','Y');
            $query = $this->db->get();

            $result = (object) array();
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

        public function get_shops($per_page,$page_no){

            $offset = (int)$per_page * (int)$page_no;
            $this->db->select('s.id,s.shop_name,s.phone,s.description,s.opening_time,s.closing_time,s.latitude,s.longitude,s.address,s.image');
            $this->db->from('shops s');
            $this->db->limit($per_page,$offset);
            // $this->db->where('s.available','Y');
            $query = $this->db->get();

            $result = (object) array();
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
        
    }
?>