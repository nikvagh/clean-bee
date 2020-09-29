<?php
    class Rider_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='users';
            $this->curr_date = date('Y-m-d H:i:s');
        }

        public function update_user_token($user_id){
            $token = random_strings(20);
            $data = array(
                "token" => $token
            );
            $this->db->where('id',$user_id);
            if($this->db->update('users',$data)){
                return $token;
            }
        }

        public function update_device_token($user_id,$device_token){
            $data0 = array("device_token" => '');
            $this->db->where('device_token',$device_token);
            $this->db->update('users',$data0);

            $data = array("device_token" => $device_token);
            $this->db->where('id',$user_id);
            if($this->db->update('users',$data)){
                return $device_token;
            }
        }

        public function get_rider_by_id($user_id){
            $this->db->select('u.id,u.phone,u.email,u.password,u.role_id,u.privileges,u.token,u.device_token,r.firstname,r.lastname,r.img,r.address,r.ride_type,r.phone_varified,r.email_varified');
            $this->db->from('users u');
            $this->db->join('riders r','r.rider_id = u.id','left');
            $this->db->where('u.id',$user_id);
            $query = $this->db->get();

            $row = (object) array();
            if ($query->num_rows() > 0) {

                $row = $query->row_array();
                // echo base_url().CUSTOMER_PRO.'thumb/50x50_'.$row['img'];
                // exit;

                if(file_exists(RIDER_PRO.'thumb/120x120_'.$row['img'])){
                    $row['profile_pic_url'] = base_url().RIDER_PRO.'thumb/120x120_'.$row['img'];
                }else{
                    $row['profile_pic_url'] = base_url().RIDER_PRO.'thumb/120x120_'.'profile_default.png';
                }

            }
            return $row;
        }

        // public function get_notification_by_user_id($user_id){
        //     $this->db->select('n.id,n.user_id,n.title,n.message,n.is_new,n.created_at');
        //     $this->db->from('notifications n');
        //     $this->db->where('n.user_id',$user_id);
        //     $query = $this->db->get();

        //     $result = (object) array();
        //     if ($query->num_rows() > 0) {
        //         $result = $query->result();
        //     }
        //     return $result;
        // }

        // public function get_total_new_notification_by_user_id($user_id){
        //     $this->db->select('count(n.id) as total');
        //     $this->db->from('notifications n');
        //     $this->db->where('n.user_id',$user_id);
        //     $query = $this->db->get();
        //     return $query->num_rows();
        // }

        public function update_email($user_id,$email){
            $success = "N";

            $data_user = array(
                'email'=>$email,
                'updated_at'=>$this->curr_date
            );
            $this->db->where('id',$user_id);
            if($this->db->update('users',$data_user)){
                $data_user = array(
                    'email_varified'=>'false',
                );
                if($this->db->where('rider_id',$user_id)){
                    $success = "Y";
                }
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function update_phone($user_id,$phone){
            $success = "N";

            $data_user = array(
                'phone'=>$phone,
                'updated_at'=>$this->curr_date
            );
            $this->db->where('id',$user_id);
            if($this->db->update('users',$data_user)){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function update_password($user_id,$password){
            $success = "N";

            $data_user = array(
                'password'=>$password
                // 'updated_at'=>$this->curr_date
            );
            $this->db->where('id',$user_id);
            if($this->db->update('users',$data_user)){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function update_password_by_phone($phone,$password){
            $success = "N";

            $data_user = array(
                'password'=>$password
                // 'updated_at'=>$this->curr_date
            );
            $this->db->where('phone',$phone);
            if($this->db->update('users',$data_user)){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function get_rider_by_selected_fields($select,$where){
            $this->db->select($select);
            $this->db->where($where);
            $this->db->where('role_id',4);
            $query1 = $this->db->get('users u');
            $res = (object) array();
            if ($query1->num_rows() > 0) {
                $res = $query1->row();
                // echo $this->db->last_query();
                // print_r($res);
            }
            return $res;
        }
        
    }
?>