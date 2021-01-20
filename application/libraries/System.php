<?php
	class System {
		
		function __construct()
		{
			$this->obj =& get_instance();
			$this->get_config();

			$this->obj->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
		}
		
		function get_config()
		{
			$query = $this->obj->db->get('web_config');
		
			foreach ($query->result() as $row)
			{
				$var = $row->config_name;
				//print "<pre>";print_r($row);print "</pre>";
				//print $row->config_name . ' = '. $row->config_value .'<br>';
				$this->$var = $row->config_value ;
			  // 	$this->$row = $row->site_name;
			}
		}
	}
?>