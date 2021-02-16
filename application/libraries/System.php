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

		function update_cart_total($user_id="",$cart_id="")
		{
			$subtotal = 0;
			$is_cart = "";
			if($user_id != ""){
				$is_cart = "Y";
				$cart = $this->obj->db->where('user_id',$user_id)->get('cart')->row();
			}else if($cart_id != ""){
				$is_cart = "Y";
				$cart = $this->obj->db->where('id',$cart_id)->get('cart')->row();
			}

			if($is_cart == 'Y'){
				$cart_id = $cart->id;
				$cart_products = $this->obj->db->where('cart_id',$cart_id)->get('cart_product')->result();
				foreach($cart_products as $key=>$val){
					$subtotal += $val->total_amount;
				}
			}

			$discount = 0;
			$delivery_fees = 0;
			$total = $subtotal-$discount+$delivery_fees;

			$cartD = array();
            $cartD['subtotal'] = $subtotal;
            $cartD['discount'] = $discount;
            $cartD['delivery_fees'] = $delivery_fees;
            $cartD['total'] = $total;
            $this->obj->db->where('id',$cart_id);
            $this->obj->db->update('cart',$cartD);
		}

	}
?>