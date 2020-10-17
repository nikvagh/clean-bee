<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('checklogin')) {
	function checkLogin($userType = "")
	{
		// echo "<pre>";
		// print_r($_SESSION);
		// echo "</pre>";
		// exit;

		$err = "N";
		if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != "") {
			if ($_SESSION['user_type'] != $userType) {
				$err = "Y";
			}
		} else {
			$err = "Y";
		}

		if ($err == 'Y') {
			if ($userType == 'admin') {
				header('Location:' . base_url() . ADMINPATH . 'login');
				exit;
			} elseif ($userType == 'vendor') {
				header('Location:' . base_url() . VENDORPATH . 'login');
				exit;
			} else {
				header('Location:' . base_url() . VENDORPATH . 'login');
				exit;
			}
		}
	}
}

if (!function_exists('destroy_login_session')) {
	function destroy_login_session()
	{
		echo "<pre>";
		print_r($_SESSION);
		echo "<pre>";
		exit;
	}
}

