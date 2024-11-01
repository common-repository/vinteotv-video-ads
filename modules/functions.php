<?php 	
function wvt_show_code( $acc_id, $sub_id, $width, $height ){
	
	if( $sub_id > 99 ){
		$sub_id = 99;
	}
	if( $sub_id == '' ){
		$sub_id = '01';
	}
	
	$sub_id = sprintf("%02d", $sub_id);
	
	return '<div><script type="text/javascript" adwidth="'.$width.'" adheight="'.$height.'" id="RoketMedia" subid="'.$acc_id.'-'.$sub_id.'" clickMacro="" src="https://cd2bbd91aa2988660d5e-08c20aaf79f9a9d371f32793e88f2809.ssl.cf1.rackcdn.com/rkm_direct_v1.9.2.js"></script></div>';
}

?>