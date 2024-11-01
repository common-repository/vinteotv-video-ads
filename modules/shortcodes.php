<?php 

global $first_call;
$first_call = 0;

add_shortcode( 'vinteo_video_ads', 'wvt_vinteo_video_ads' );
function wvt_vinteo_video_ads( $atts, $content = null ) {
	global $first_call;

	if( $first_call == 1 ){
		return '';
	}
	$first_call = 1;
	$config = get_option('wvt_options');
	$out = wvt_show_code( $config['account_id'], $atts['subid'], $atts['adwidth'], $atts['adheight'] );
	
	$config = get_option('wvt_ads');
	
	if( $config['inj_type'] != 'shortcode' ){
			return false;
	}	
	
	return $out; 
}

?>