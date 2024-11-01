<?php 
	
add_action('admin_menu', 'wvt_item_menu');

function wvt_item_menu() {
	add_menu_page(  __('Vinteo.tv' ,'wvt'), __('Vinteo.tv' ,'wvt'), 'edit_published_posts', 'wvt_editor', 'wvt_editor', plugins_url('images/logo_small.png', __FILE__ ) );
	 add_submenu_page('wvt_editor', 'Video ads', 'Video ads', 'manage_options', 'wvt_editor' );
	add_submenu_page( 'wvt_editor', __('Settings' ,'wvt'), __('Settings' ,'wvt'), 'edit_published_posts', 'wvt_settings', 'wvt_settings');
}

function wvt_settings(){

?>
<div class="wrap tw-bs cus_wrap">
<h2><img class="backend_logo" src="<?php echo plugins_url('/images/settings.png', __FILE__ ); ?>" /><?php _e('Settings', 'wvt'); ?></h2>
 <?php if(  wp_verify_nonce($_POST['_wpnonce']) ): ?>
  <div id="message" class="updated" ><?php _e('Settings saved successfully', 'wvt'); ?></div>  
  <?php 
	$config = get_option('wvt_options'); 
	foreach( $_POST as $key=>$value ){
		$wvt_options[$key] = sanitize_text_field( $value );
	}
	update_option('wvt_options', $wvt_options );
  ?>
  <?php else:  ?>

  <?php //exit; ?>
  
  <?php endif; ?> 
<form class="form-horizontal" method="post" action="">
<?php wp_nonce_field();  
$config = get_option('wvt_options'); 

//var_dump( $config );
?>  
<fieldset>

		<div class="control-group">  
            <ul class="settings_list">
				<li>1) Sign up for a Vinteo.tv account <a class="fancybox fancybox.iframe"  href="http://dashboard.vinteo.tv">here</a> ( registration is 100% free and take less than 5 minutes)</li>
				<li>2) Enter your accout ID (it's the number located on the bottom of the <a class="fancybox fancybox.iframe"  href="http://dashboard.vinteo.tv">dashboard</a> )</li>
				<li><input class="input-small account_id" name="account_id" value="<?php echo $config['account_id']; ?>" /></li>
				<li>3) Create your video ads <a href="<?php echo get_option('home'); ?>/wp-admin/admin.php?page=wvt_editor">here</a></li>
			</ul>  
          </div>

          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Save</button>  
          </div>  

		 
		  
        </fieldset>  

</form>

</div>


<?php 
}


function wvt_editor(){

?>
<div class="wrap tw-bs cus_wrap">
<h2><img class="backend_logo" src="<?php echo plugins_url('/images/settings.png', __FILE__ ); ?>" /><?php _e('Video ads', 'wvt'); ?></h2>
 <?php if(  wp_verify_nonce( $_POST['pick_field'], 'pick_action' )  ): ?>
  <div id="message" class="updated" ><?php _e('Settings saved successfully', 'sc'); ?></div>  
  <?php 
  $config = get_option('wvt_ads'); 

	foreach( $_POST as $key=>$value ){
		$wvt_ads[$key] = sanitize_text_field( $value );
	}
  update_option('wvt_ads', $wvt_ads );
  ?>
  <?php else:  ?>

  <?php //exit; ?>
  
  <?php endif; ?> 
<form class="form-horizontal" method="post" action="">
<?php wp_nonce_field( 'pick_action', 'pick_field' );  

$config = get_option('wvt_ads'); 

//var_dump( $config );
?>  
<fieldset>
	<legend>Choose how you'd like to insert your ads:</legend>
	
	<div class="pre_defined_block parent_block">  
            <label class="label_list" for="select01"><input type="radio" <?php if( $config['inj_type'] == 'pre' || !$config['inj_type'] ) echo ' checked '; ?> class="radio_block" name="inj_type" value="pre" />Insert ads via pre-defined settings (recommended)</label>  
		<div class="inner_block <?php if( $config['inj_type'] == 'pre' || !$config['inj_type'] ) echo ' visible_block '; ?> ">
		   <div class="inner_controls">  
				  <select name="select_placement">  
					<option  value="" >Select video ad position</option>  
					<option  value="above_content"  <?php if( $config['select_placement'] == "above_content" ) echo ' selected '; ?>  >Above content</option>  
					<option  value="middle_content"  <?php if( $config['select_placement'] == "middle_content" ) echo ' selected '; ?>  >Middle content</option> 
					<option  value="below_content"  <?php if( $config['select_placement'] == "below_content" ) echo ' selected '; ?>  >Below content</option> 				
				  </select>  
			</div>  
			
			 <div class="inner_controls">  
				  <select name="select_size">  
					<option  value="" >Select video ad size</option>  
					<option  value="640x480"  <?php if( $config['select_size'] == "640x480" ) echo ' selected '; ?>  >640x480</option>  
					<option  value="480x320"  <?php if( $config['select_size'] == "480x320" ) echo ' selected '; ?>  >480x320</option> 
					<option  value="300x250"  <?php if( $config['select_size'] == "300x250" ) echo ' selected '; ?>  >300x250</option> 				
				  </select>  
			</div>
			<label class="inner_controls" for="select01">Select a sub ID to associate with this site / blog and view its according results: <input type="number" value="<?php echo (int)$config['id_data']; ?>" name="id_data"  pattern="[0-9]{2}" class="input-mini" min="0" max="99"></label>  
		</div>
    </div>
	<div class="widget_block parent_block">  
            <label class="label_list" for="select01"><input type="radio" value="widget" class="radio_block" name="inj_type" <?php if( $config['inj_type'] == 'widget' ) echo ' checked '; ?> />Insert ads via Widget</label> 
		<div class="inner_block <?php if( $config['inj_type'] == 'widget'  ) echo ' visible_block '; ?>">
			<a class="btn btn-info widget_link" target="_blank" href="<?php echo get_option('home'); ?>/wp-admin/widgets.php" >Go to the Widgets area</a>
		</div>
	</div> 
	<div class="shortcode_block parent_block">  
            <label class="label_list" for="select01"><input type="radio" value="shortcode" class="radio_block" name="inj_type" <?php if( $config['inj_type'] == 'shortcode' ) echo ' checked '; ?>  />Insert ads via Shortcode</label> 	
			<div class="inner_block <?php if( $config['inj_type'] == 'shortcode'  ) echo ' visible_block '; ?>">
			Copy this Wordpress shortcode <b>[vinteo_video_ads subid="01" adwidth="300" adheight="250"]</b> and paste it to any page/post or Text Widget ( the number after "subid=" should reflect a specific placement in your site/blog, you can use only numbers between 01-99. You can also define the adwidth and adheight you'd like to use after the "adwidth=" and "adheight=" placeholders, the minimal dimensions are 250 width and 170 height )
			</div>
	</div> 
		
		
          <div class="form-actions">  
            <button type="submit" class="btn btn-primary fast_save">Save</button>  
          </div>  
        </fieldset>  

</form>

</div>


<?php 
}

?>