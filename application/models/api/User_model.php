<?php
    class User_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='users';
            $this->curr_date = date('Y-m-d H:i:s');
        }

        function update_otp($phone,$otp){
            $this->db->where('phone', $phone);
            $dlt_old_otp = $this->db->delete('otps');

            $data_otp = array(
                'phone'=>$phone,
                'otp'=>$otp
            );
            if($this->db->insert('otps',$data_otp)){
                return true;
            }else{
                return false;
            }
        }

        public function check_otp($phone,$otp){
            $this->db->select('o.*');
            $this->db->from('otps o');
            $this->db->where('o.phone',$phone);
            $this->db->where('o.otp',$otp);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            }else{
                return false;
            }
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

        public function get_customer_by_id($user_id){
            $this->db->select('u.id,u.phone,u.email,u.password,u.role_id,u.privileges,u.token,u.device_token,c.firstname,c.lastname,c.username,c.img,c.phone_varified,c.email_varified,c.wallet,c.login_provider,c.provider_token,c.is_guest');
            $this->db->from('users u');
            $this->db->join('customers c','c.customer_id = u.id','left');
            $this->db->where('u.id',$user_id);
            $query = $this->db->get();

            $row = (object) array();
            if ($query->num_rows() > 0) {

                $row = $query->row_array();
                // echo base_url().CUSTOMER_PRO.'thumb/50x50_'.$row['img'];
                // exit;
                if(file_exists(CUSTOMER_PRO.'thumb/120x120_'.$row['img'])){
                    $row['profile_pic_url'] = base_url().CUSTOMER_PRO.'thumb/120x120_'.$row['img'];
                }else{
                    $row['profile_pic_url'] = base_url().CUSTOMER_PRO.'thumb/120x120_'.'profile_default.png';
                }

            }
            return $row;
        }

        public function get_credit_cards_by_id($user_id){
            $this->db->select('u.id,u.phone,u.email,u.password,u.role_id,u.privileges,u.token,u.device_token,c.firstname,c.lastname,c.username,c.img,c.phone_varified,c.email_varified,c.wallet,c.login_provider,c.provider_token');
            $this->db->from('users u');
            $this->db->join('customers c','c.customer_id = u.id','left');
            $this->db->where('u.id',$user_id);
            $query = $this->db->get();

            $row = (object) array();
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
            }
            return $row;
        }

        public function get_cards_list($user_id){
            $cards = $this->db->from('card c')->select('c.id as card_id,c.name,c.card_number,c.expiry_date,c.cvv,c.default')
                        ->where('c.customer_id',$user_id)->get()->result();

            foreach($cards as $key=>$val){
                $cards[$key]->expiry_date = date('Y-m',strtotime($val->expiry_date));
            }
            return $cards;
        }

        public function get_notification_by_user_id($user_id){
            $this->db->select('n.id,n.user_id,n.title,n.message,n.is_new,n.created_at');
            $this->db->from('notifications n');
            $this->db->where('n.user_id',$user_id);
            $query = $this->db->get();

            $result = (object) array();
            if ($query->num_rows() > 0) {
                $result = $query->result();
            }
            return $result;
        }

        public function get_total_new_notification_by_user_id($user_id){
            $this->db->select('count(n.id) as total');
            $this->db->from('notifications n');
            $this->db->where('n.is_new','true');
            $this->db->where('n.user_id',$user_id);
            $query = $this->db->get();
            // echo $this->db->last_query();
            // return $query->num_rows();
            return $query->row('total');
        }

        public function change_notification_to_viewed($notifications_id){
            $data_noti = array(
                'is_new'=>'false',
                'updated_at'=>$this->curr_date
            );
            $this->db->where('id',$notifications_id);
            if($this->db->update('notifications',$data_noti)){
                return true;
            }else{
                return false;
            }
        }

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
                if($this->db->where('customer_id',$user_id)){
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

        public function _update_address($user_id,$address){
            $success = "N";

            $data_user = array(
                'address'=>$address
                // 'updated_at'=>$this->curr_date
            );
            $this->db->where('customer_id',$user_id);
            if($this->db->update('customers',$data_user)){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        public function update_profile($user_id,$firstname,$lastname,$email){
            $success = "N";

            $data_customers = array(
                // 'username'=>$username,
                'firstname'=>$firstname,
                'lastname'=>$lastname
                // 'updated_at'=>$this->curr_date
            );
            $data_user = array(
                'email'=>$email,
                // 'password'=>$password,
                // 'updated_at'=>$this->curr_date
            );
            $this->db->where('customer_id',$user_id);
            // $this->db->where('id',$user_id);
            if($this->db->update('customers',$data_customers) && $this->db->where('id',$user_id)->update('users',$data_user)){
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

        public function update_profile_pic($user_id,$address){
            $success = "N";

            $data_user = array(
                'address'=>$address
                // 'updated_at'=>$this->curr_date
            );
            $this->db->where('customer_id',$user_id);
            if($this->db->update('customers',$data_user)){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        function get_members() {
            $this->db->select('m.*');
            $this->db->from('members m');
            $this->db->where('otp_varified','Y');

            if(isset($_SESSION['member']['filter_date_start']) && $_SESSION['member']['filter_date_start'] != ""){
                $startDate = date('Y-m-d',strtotime($_SESSION['member']['filter_date_start']));
                $this->db->where('DATE(m.created_at) >= "'.$startDate.'"');
            }
            if(isset($_SESSION['member']['filter_date_end']) && $_SESSION['member']['filter_date_end'] != ""){
                $endDate = date('Y-m-d',strtotime($_SESSION['member']['filter_date_end']));
                $this->db->where('DATE(m.created_at) <= "'.$endDate.'"');
            }
            
            $this->db->order_by("m.id", "Desc");
            $query = $this->db->get();
            // echo $this->db->last_query();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function get_all_members(){
            $this->db->select('*');
            $this->db->where('status','Enable');
            $query = $this->db->get('members');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function getDataById($id){
            $this->db->select('*');
            $this->db->where('id',$id);
            $query = $this->db->get($this->table);
            // echo $this->db->last_query();
            $row = $query->row_array();
            return $row;
        }

        function get_members_by_compnayId($company_id){
            $this->db->select('*');
            $this->db->where('status','Y');
            $this->db->where('company_id',$company_id);
            $query = $this->db->get('members');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function add_credit_history($user_id,$amount,$operation_type,$description){
            $data_add = array();
            $data_add['user_id'] = $user_id;
            $data_add['amount'] = $amount;
            $data_add['operation_type'] = $operation_type;
            $data_add['description'] = $description;
            if($this->db->insert('wallet_history',$data_add)){
                $id = $this->db->insert_id();
                return true;
            }else{
                return false;
            }
        }

        function add_credit_to_wallet($user_id,$amount){
            $result = array();
            $data_customer = array();
            // $data_customer['wallet'] = "wallet+".(int)$amount."";
            $this->db->set('wallet', 'wallet+'.(float)$amount, FALSE); 
            $this->db->where('customer_id',$user_id);
            if($this->db->update('customers',$data_customer)){

                $operation_type = "credit";
                $description = "Add credit to wallet by customer";
                $this->add_credit_history($user_id,$amount,$operation_type,$description);

                $result['status'] = "add";
            }else{
                $result['status'] = "not_add";
            }
            $result['user'] = $this->get_customer_by_id($user_id);
            return $result;
        }

        public function get_customer_wallet($user_id){
            $result['user'] = $this->get_customer_by_id($user_id);

            $this->db->select('wh.*');
            $this->db->where('user_id',$user_id);
            $query = $this->db->get('wallet_history wh');
            $result['history'] = array();
            if ($query->num_rows() > 0) {
                $result['history'] = $query->result();
            }
            return $result;
        }


        function add_card($data){
            
            if($this->db->insert('card',$data)){
                $success = "Y";
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }
        function get_cards($user_id){

            $this->db->where('customer_id',$user_id);
            // $this->db->where('default','Y');
            $query=$this->db->get('card');
            $result=$query->result();
            $data=[];
            foreach ($result as $value) {
               $data[] = array('id' =>$value->id,
                                'customer_id' =>$value->customer_id,
                                'name' =>$value->name,
                                'card_number' =>$value->card_number,
                                'expiry_year_month' =>date("Y-m", strtotime($value->expiry_date)),
                                'expiry_year' =>date("Y", strtotime($value->expiry_date)),
                                'expiry_month' =>date("m", strtotime($value->expiry_date)),
                                'cvv' =>$value->cvv,
                                'default' =>$value->default, );
            }
            // print_r($data);
            // exit();
            return $data;
        }
        
        function primary_card($user_id,$card_id){

            $data = array(
                'default'=>'N',
            );
            $this->db->where('customer_id',$user_id)->update('card',$data);
            $new_data = array(
                'default'=>'Y',
            );
            $this->db->where('id',$card_id)->update('card',$new_data);
            return true;
        }
        public function delete_card($card_id)
        {
            $this->db->where('id', $card_id);
            if ($query = $this->db->delete('card')){
                return true;
            }else{
                return false;
            }
        }

        function add_address($user_id,$building_number,$longitude,$latitude,$address_type,$street_name,$area_zone,$floor_number,$office_number,$apartment_number){
            $data = array('customer_id' => $user_id,
                            'longitude' => $longitude,
                            'latitude' => $latitude,
                            'address_type' => $address_type,
                            'street_name' => $street_name,
                            'area_zone' => $area_zone,
                            'office_number' => $office_number,
                            'floor_number' => $floor_number,
                            'apartment_number' => $apartment_number,
                            'building_number' => $building_number,
                             );

                 if($this->db->insert('address',$data)){
                    $id=$this->db->insert_id();
                    return true;
                }else{
                    return false;
                }
        }
        public function update_address($address_id,$building_number,$longitude,$latitude,$address_type,$street_name,$area_zone,$floor_number,$office_number,$apartment_number)
        {
           $data = array('longitude' => $longitude,
                            'latitude' => $latitude,
                            'address_type' => $address_type,
                            'street_name' => $street_name,
                            'area_zone' => $area_zone,
                            'office_number' => $office_number,
                            'floor_number' => $floor_number,
                            'apartment_number' => $apartment_number,
                            'building_number' => $building_number,
                             );

            $this->db->where('id',$address_id);
             if($this->db->update('address',$data)){
                return true;
            }else{
                return false;
            }
        }
         public function delete_address($address_id)
        {
            $this->db->where('id', $address_id);
            if ($query = $this->db->delete('address')){
                return true;
            }else{
                return false;
            }
        }
        function primary_address($user_id,$address_id){

            $data = array(
                'default'=>'N',
            );
            $this->db->where('customer_id',$user_id)->update('address',$data);
            $new_data = array(
                'default'=>'Y',
            );
            $this->db->where('id',$address_id)->update('address',$new_data);
            return true;
        }
        function insert(){
            $date = date('Y-m-d h:i:s');
            $data=array(
                'members_name'=>$this->input->post('members_name'),
                'company_id'=>$this->input->post('company_id'),
                'status'=>$this->input->post('status'),
                'created_at'=>$date
            );
            if($this->db->insert($this->table,$data)){
                $id=$this->db->insert_id();
                return true;
            }else{
                return false;
            }
        }
        function get_address_by_uesr_id($user_id)
        {
            $this->db->where('customer_id', $user_id);
            $this->db->select('*');
            $query = $this->db->get('address');
            $result = array();
                if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                }
            return $result;
        }
        public function get_address($address_id)
        {   
            $this->db->where('id', $address_id);
            $query = $this->db->get('address');
            $ret = $query->row();
            return $ret;
        }
        function update(){
            $date = date('Y-m-d h:i:s');
            $data = array(
                'password'=>$this->input->post('password'),
                'updated_at'=>$date
            );
            $this->db->where('id',$this->input->post('id'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }

        function st_update(){
            $this->db->set('status', $this->input->post('publish'));
            $this->db->where('id', $this->input->post('id'));
            if($this->db->update($this->table)){
                // echo $this->db->last_query();
                // echo "dddd";exit;
               return true;
            }else{
                return false;
            }
        }

        function delete(){
            $this->db->where('id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        public function check_phone($phone)
        {
             $this->db->where('phone', $phone);
             $query = $this->db->get('users') ;
            if ($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }
        public function check_phone_otp_send($phone)
        {
            $this->db->where('phone', $phone);
             $query = $this->db->get('otps') ;
            if ($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
        }
         function send_otp($phone,$otp){
            // $this->db->where('phone', $phone);
            // $dlt_old_otp = $this->db->delete('otps');
            $data_otp = array(
                'phone'=>$phone,
                'otp'=>$otp
            );
            if($this->db->insert('otps',$data_otp)){
                return true;
            }else{
                return false;
            }
        }
        public function forgot_password_update($phone,$password)
        {
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
    }
?>