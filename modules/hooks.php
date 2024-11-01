<?php 
add_Action('init', 'wvt_init');
function wvt_init(){
	$config = get_option('wvt_ads');
	//var_Dump( $_POST );
	if( wp_verify_nonce( $_POST['pick_field'], 'pick_action' ) ){
		
		if( $_POST['inj_type'] == 'widget' ){
			
			$config = get_option('wvt_ads'); 
				
				foreach( $_POST as $key=>$value ){
					$wvt_ads[$key] = $value;
				}
			  update_option('wvt_ads', $wvt_ads );
			
			wp_redirect( get_option('home').'/wp-admin/widgets.php', 301 );
			exit;
		}
	}
}
add_Action('the_content', 'wvt_the_content');
function wvt_the_content( $content ){
	
	$config = get_option('wvt_ads');
	$options = get_option('wvt_options');
	if( $config['inj_type'] == 'pre' ){
		if( is_single() || is_page() ){
			$select_placement = $config['select_placement'];
			
			if( $select_placement == '' ){
				$select_placement = 'above_content';
			}
			
			$select_size = $config['select_size'];
			if( $select_size == '' ){
				$select_size = '300x250';
			}
			
			$id_data = $config['id_data'];
			$out_size = explode('x', $select_size);
			$out_code = wvt_show_code( $options['account_id'], $id_data, $out_size[0], $out_size[1] );
			
			switch( $select_placement ){
				case "above_content":
					$content = $out_code.$content;
				break;
				case "middle_content":
				if( strpos($content,"</p>") != 0 ){
					$last_post = strpos($content,"</p>") + 3;
					$content = substr_replace($content, $out_code, $last_post, 0);
				}
				else{
					$content = $content.$out_code;
				}
					
				
					
				break;
				case "below_content":
					$content = $content.$out_code;
				break;
			}
			
		}
	}
	
	return $content;
}
add_filter('widget_text','do_shortcode');
