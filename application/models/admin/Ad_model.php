<?php
    class Ad_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->banner_thumb = array('50'=>'50');
            $this->curr_date = date('Y-m-d H:i:s');

            // Set table name
            $this->table = 'ads';
            // Set orderable column fields
            $this->column_order = array(null,null, 'id','title','img','target','created_at','status',null);
            // Set searchable column fields
            $this->column_search = array('title','target','status');
            // Set default order
            $this->order = array('id' => 'desc');
        }

        public function getRows($postData){
            $this->_get_datatables_query($postData);
            if($postData['length'] != -1){
                $this->db->limit($postData['length'], $postData['start']);
            }
            $query = $this->db->get();
            return $query->result();
        }

        public function countAll(){
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }
        
        public function countFiltered($postData){
            $this->_get_datatables_query($postData);
            $query = $this->db->get();
            return $query->num_rows();
        }

        private function _get_datatables_query($postData){

            if(isset($_SESSION['ad']['filter_date_start']) && $_SESSION['ad']['filter_date_start'] != ""){
                $startDate = date('Y-m-d',strtotime($_SESSION['ad']['filter_date_start']));
                $this->db->where('DATE(created_at) >= "'.$startDate.'"');
            }
            if(isset($_SESSION['ad']['filter_date_end']) && $_SESSION['ad']['filter_date_end'] != ""){
                $endDate = date('Y-m-d',strtotime($_SESSION['ad']['filter_date_end']));
                $this->db->where('DATE(created_at) <= "'.$endDate.'"');
            }

            $this->db->from($this->table .' s');
     
            $i = 0;
            // loop searchable columns 
            foreach($this->column_search as $item){
                // if datatable send POST for search
                if($postData['search']['value']){
                    // first loop
                    if($i===0){
                        // open bracket
                        $this->db->group_start();
                        $this->db->like($item, $postData['search']['value']);
                    }else{
                        $this->db->or_like($item, $postData['search']['value']);
                    }
                    
                    // last loop
                    if(count($this->column_search) - 1 == $i){
                        // close bracket
                        $this->db->group_end();
                    }
                }
                $i++;
            }
             
            if(isset($postData['order'])){
                $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
            }else if(isset($this->order)){
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        // function get_ads() {
        //     $this->db->select('*');
        //     // $this->db->from('number_types n');
        //     if(isset($_SESSION['ad']['filter_date_start']) && $_SESSION['ad']['filter_date_start'] != ""){
        //         $startDate = date('Y-m-d',strtotime($_SESSION['ad']['filter_date_start']));
        //         $this->db->where('DATE(created_at) >= "'.$startDate.'"');
        //     }
        //     if(isset($_SESSION['ad']['filter_date_end']) && $_SESSION['ad']['filter_date_end'] != ""){
        //         $endDate = date('Y-m-d',strtotime($_SESSION['ad']['filter_date_end']));
        //         $this->db->where('DATE(created_at) <= "'.$endDate.'"');
        //     }

        //     $query = $this->db->get($this->table);

        //     $result = array();
        //     if ($query->num_rows() > 0) {
        //         $result = $query->result_array();
        //     }
        //     return $result;
        // }

        function getDataById($id){
            $this->db->select('*');
            $this->db->where('id',$id);
            $query = $this->db->get($this->table);
            // echo $this->db->last_query();
            $row = $query->row_array();
            return $row;
        }

        function insert(){
            $img_name = "";

            if(isset($_FILES['img']['name']) && $_FILES['img']['name'] != ""){

                $img_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['img']['name']);

                $config['file_name'] = $img_name;
                $config['upload_path'] = ADBNR_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('img')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";
                        // print_r($data['error']);
                }else{
                        $data['upload_data'] = $this->upload->data();
                        $this->load->library('image_lib');
                        foreach ($this->banner_thumb as $key => $val) {
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = $_FILES['img']['tmp_name'];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = false;
                                $config['width'] = $key;
                                $config['height'] = $val;
                                $config['new_image'] = ADBNR_PATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $img_name;
                                $this->image_lib->clear();
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                        }
                }
            }

            $data = array(
                'title'=> $this->input->post('title'),
                'img'=> $img_name,
                'target'=> $this->input->post('target'),
                'status'=> $this->input->post('status'),
                'created_at'=> $this->curr_date
            );
            if($this->db->insert($this->table,$data)){
                $id = $this->db->insert_id();
                return true;
            }else{
                return false;
            }
        }

        function update(){
            if(isset($_FILES['img']['name']) && $_FILES['img']['name'] != ""){
                if(file_exists(ADBNR_PATH.$this->input->post('img_old')))
                {
                        @unlink(ADBNR_PATH.$this->input->post('img_old'));
                        foreach ($this->banner_thumb as $key => $val) {
                                if (ADBNR_PATH ."thumb/" . $key. "x" . $val."_".$this->input->post('img_old'))
                                {
                                    @unlink(ADBNR_PATH ."thumb/" . $key . "x" . $val."_".$this->input->post('img_old'));
                                }
                        }
                }

                $img_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['img']['name']);

                $config['file_name'] = $img_name;
                $config['upload_path'] = ADBNR_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('img')) {
                    $errors = $this->upload->display_errors();
                    $this->session->set_flashdata('error',$errors);
                    // echo "<pre>";
                    // print_r($errors);
                    // exit;
                }else{
                    $data['upload_data'] = $this->upload->data();
                    $this->load->library('image_lib');
                    foreach ($this->banner_thumb as $key => $val) {
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $_FILES['img']['tmp_name'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = false;
                            $config['width'] = $key;
                            $config['height'] = $val;
                            $config['new_image'] = ADBNR_PATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $img_name;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                    }
                }
            }else{
                $img_name = $this->input->post('img_old');
            }

            $data = array();
            $date = date('Y-m-d h:i:s');
            $data['title'] = $this->input->post('title');
            $data['img'] = $img_name;
            $data['target'] = $this->input->post('target');
            $data['status'] = $this->input->post('status');
            $data['updated_at'] = $date;

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

        function delete($id=""){

            if($id == ""){
                $id = $this->input->post('id');
            }
            $row = $this->getDataById($id);
            
            if (file_exists(ADBNR_PATH . $row['img'])){
                @unlink(ADBNR_PATH . $row['img']);
                foreach ($this->banner_thumb as $key => $val) {
                    if (ADBNR_PATH ."thumb/" . $key. "x" . $val."_".$row['img']){
                        @unlink(ADBNR_PATH ."thumb/" . $key . "x" . $val."_".$row['img']);
                    }
                }
            }

            $this->db->where('id', $row['id']);
            if ($query = $this->db->delete($this->table)){
                return true;
            }else{
                return false;
            }
        }

        function bulk_delete() {
            $cnt = 0;
            foreach($_POST['ids'] as $key=>$val){
                if($this->delete($val)){
                    $cnt++;
                }
            }

            if($cnt > 0){
                return true;
            }else{
                return false;
            }
        }

        function bulk_status_update() {
            // echo "<pre>";
            // print_r($_POST);
            // exit;
            $this->db->set('status', $this->input->post('bulk_status'));
            $this->db->where_in('id', $this->input->post('ids'));
            if($this->db->update($this->table)){
               return true;
            }else{
                return false;
            }
        }
        
    }
?>