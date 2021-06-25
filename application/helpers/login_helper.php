<?php
	function is_logged_in() {
		$CI =& get_instance();
		$user = $CI->session->userdata('user_data');
		if (!isset($user)) { return false; } else { return true; }
	}	