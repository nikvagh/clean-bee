<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if (!function_exists('get_last_30_yr')) {
	function get_last_30_yr()
	{
		$year = array();
		for ($i = 29; $i > -1; $i--) {
			$year[] = date("Y", strtotime("-$i years"));
		}
		rsort($year);

		// echo "<pre>";
		// print_r($year);
		// exit;
		return $year;
	}
}

if (!function_exists('random_strings')) {
	function random_strings($length_of_string)
	{
		// String of all alphanumeric character 
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}

if (!function_exists('send_mail')) {
	function send_mail($to_email, $subject, $msg, $cc = "")
	{
		// echo "send_mail";
		$timecode = strtotime("NOW");
		$timecode = md5($timecode);

		$from = "test111@gmail.com";
		// $headers = "From: ".$from;
		// $headers .= "Content-type: text/html\r\n";

		$headers = 'To: ' . $to_email . "\r\n";
		$headers .= 'From: ' . $from . "\r\n";
		if ($cc != "") {
			$headers .= 'Cc: ' . $cc . "\r\n";
		}
		$headers .= "Content-type: text/html;\r\n";
		$message = '<html><body>' . $msg . '</body></html>';

		// echo $to_email;
		// echo "<br/>";
		// echo $subject;
		// echo "<br/>";
		// echo $message;
		// echo "<br/>";
		// exit;

		if (mail($to_email, $subject, $message, $headers)) {
			// echo "send";
			return true;
		} else {
			// echo "err";
			return false;
		}
	}
}

if (!function_exists('otp_generate')) {
	function otp_generate($length_of_string)
	{
		// String of all alphanumeric character 
		$str_result = '0123456789';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}

if (!function_exists('sent_otp')) {
	function sent_otp()
	{
		// OTP sending function
	}
}


if (!function_exists('radius_distance')) {
	function radius_distance($lat1, $lon1, $lat2, $lon2, $unit="K") {
		if (($lat1 == $lat2) && ($lon1 == $lon2)) {
			return 0;
		} else {
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$unit = strtoupper($unit);
	
			if ($unit == "K") {
				return ceil(($miles * 1.609344));
			} else if ($unit == "N") {
				return ($miles * 0.8684);
			} else {
				return $miles;
			}
		}
	}
}

if (!function_exists('set_cart_totel')){
	function set_cart_totel($id)
	{
		$db =& get_instance();
		$cart_data= $db->db->where('user_id',$id)->get('cart')->row();
		$cart_pro_totel= $db->db->where('user_id',$id)->select('sum(price_total) as total')->get('cart_product')->row();

 		$total=$cart_pro_totel->total - ($cart_data->discount);
        $cart_data_cart = array();
        $cart_data_cart['subtotal'] = $cart_pro_totel->total;
        $cart_data_cart['total'] = $total;
        $db->db->where('user_id',$id);
        $db->db->update('cart',$cart_data_cart);

		return true;
	}
}
if (!function_exists('check_cart_uesr')) {
	function check_cart_uesr($id)
	{
		$db =& get_instance();
		$cart_data= $db->db->where('user_id',$id)->get('cart')->row();
		
		if (empty($cart_data->id)) {
			return false;
		}else{
			return $cart_data->id;
		}
	}
}

