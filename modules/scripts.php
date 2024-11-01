<?php 

add_action('wp_print_scripts', 'wvt_add_script_fn');
function wvt_add_script_fn(){
	wp_enqueue_style('wvt_bootsrap_css', plugins_url('/inc/assets/css/boot-cont.css', __FILE__ ) ) ;

   if(is_admin()){

	wp_enqueue_script('wvt_jquery.fancybox.js', plugins_url('/inc/fb/jquery.fancybox.js', __FILE__ ), array('jquery'), '2.0' ) ;
	wp_enqueue_style('wvt_uery.fancybox.css', plugins_url('/inc/fb/jquery.fancybox.css', __FILE__ ) ) ;
	  
   
   
	wp_enqueue_style('wvt_admin_css', plugins_url('/css/admin.css', __FILE__ ) ) ;	
	wp_enqueue_script('wvt_admin_js', plugins_url('/js/admin.js', __FILE__ ), array('jquery', 'media-upload', 'thickbox'), '1.0' ) ;
	
  }else{
	wp_enqueue_style('wvt_front_css', plugins_url('/css/front.css', __FILE__ ) ) ;
	wp_enqueue_script('wvt_admin_js', plugins_url('/js/front.js', __FILE__ ), array('jquery'), '1.0' ) ;
  }
}
?>