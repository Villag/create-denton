<?php  

  	add_action('wp_enqueue_scripts', 'loginradius_counter_output'); 

		if( $LoginRadius_settings['LoginRadius_counterEnable'] == "1" ){

 			if( isset( $LoginRadius_settings['LoginRadius_counterhome'] ) || isset( $LoginRadius_settings['LoginRadius_counterpost'] ) || isset( $LoginRadius_settings['LoginRadius_counterpage'] ) || isset( $LoginRadius_settings['LoginRadius_counterexcerpt'] ) || isset( $LoginRadius_settings['LoginRadius_counterarchive'] ) || isset( $LoginRadius_settings['LoginRadius_counterfeed'] ) )

 			{

 				function loginRadiusCounterContent($content) 

 				{

 				global $LoginRadius_settings;

 				



				if (strpos($LoginRadius_settings['LoginRadius_counterCode'], 'isHorizontal = true') !== false) {



					$append = "<div style='margin:0'><b>".ucfirst($LoginRadius_settings['LoginRadius_counter_title'])."</b></div><br/><div class='lrcounter_simplebox'></div>";

				}else{

					$append = "<div class='lrcounter_simplebox'></div>";

				} 					

 				if( ( isset( $LoginRadius_settings['LoginRadius_counterhome'] ) && is_front_page() ) || ( isset( $LoginRadius_settings['LoginRadius_counterpost'] ) && is_single() ) || ( isset( $LoginRadius_settings['LoginRadius_counterpage'] ) && is_page() ) || ( isset( $LoginRadius_settings['LoginRadius_counterexcerpt'] ) && has_excerpt() ) || ( isset( $LoginRadius_settings['LoginRadius_counterarchive'] ) && is_archive() ) || ( isset( $LoginRadius_settings['LoginRadius_counterfeed'] ) && is_feed() ) )

 				{	

 				

 					if( isset( $LoginRadius_settings['LoginRadius_countertop'] ) && isset( $LoginRadius_settings['LoginRadius_counterbottom'] ) )

 					{

 						$content = $append.'<br/>'.$content.'<br/>'.$append;

 					}

 					else

 					{

 						if( isset( $LoginRadius_settings['LoginRadius_countertop'] ) )

 						{

 							$content = $append.$content;

 						}

 						elseif( isset( $LoginRadius_settings['LoginRadius_counterbottom'] ) )

 						{

 							$content = $content.$append;

 						}

 					}

 				}

 			  return $content;

 			}

 			add_filter('the_content', 'loginRadiusCounterContent');

 		} 

	} 

