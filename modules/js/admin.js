jQuery(document).ready(function($){
	if( $(".fancybox").length ){
		$(".fancybox").fancybox();
	}
	
	$(".label_list .radio_block").change(function(){
		$('.visible_block').removeClass('visible_block');
		$('.parent_block .inner_block').hide();
		var pnt = $(this).parents('.parent_block');
		$('.inner_block', pnt).fadeIn();
	});
	$('.widget_link').click(function(){
		$('.fast_save').click();
	})
	
	setInterval(function(){
		
		console.log( $('.widget-liquid-right .search_mark').length )
		if( $('.widget-liquid-right .search_mark').length > 0){
			$('.widget-liquid-left .widget[id*="_vinteo_widget"]').hide();
		}else{
			$('.widget-liquid-left .widget[id*="_vinteo_widget"]').show();
		}
	},500)
}); // main jquery container
