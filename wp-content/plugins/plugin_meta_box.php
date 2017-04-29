<?php 
/**
  * Plugin Name: Meta box 
  * Author: Lee Phuoc
  * Description: Demo meta box 
  */

function leephuoc_meta_box() {
	add_meta_box('info', 'Info app', 'leephuoc_info_output', 'post');
}
add_action('add_meta_boxes', 'leephuoc_meta_box');

if(!function_exists('leephuoc_info_output')) {
	function leephuoc_info_output($id) {
		echo '<label>Link</label>';
		echo '<input type="text" id="info-link" name="info_link" />';
	}
}

if(!function_exists('leephuoc_save_info')) {
	function leephuoc_save_info($id) {
		$data_post['info_link'] = !empty($_POST['info_link']) ? $_POST['info_link'] : null;

		update_post_meta($id, 'info_link', $data_post['info_link']);
	}
}
add_action('save_post', 'leephuoc_save_info');