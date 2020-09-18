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
                    if(file_exists(ADBNR_PATH.'thumb/120x120_'.$val->img)){
                        $result[$key]->img_url = base_url().ADBNR_PATH.'thumb/120x120_'.$val->img;
                    }else{
                        $result[$key]->img_url = "";
                    }
                }

            }
            return $result;
        }
        
    }
?>