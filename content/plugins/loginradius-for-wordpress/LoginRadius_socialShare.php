<?php  
  	add_action('wp_enqueue_scripts', 'loginradius_share_output'); 


		if( $LoginRadius_settings['LoginRadius_shareEnable'] == "1" ){

 			if(isset( $LoginRadius_settings['LoginRadius_sharehome'] ) || isset( $LoginRadius_settings['LoginRadius_sharepost'] ) || isset( $LoginRadius_settings['LoginRadius_sharepage'] ) || isset( $LoginRadius_settings['LoginRadius_shareexcerpt'] ) || isset( $LoginRadius_settings['LoginRadius_sharearchive'] ) || isset( $LoginRadius_settings['LoginRadius_sharefeed'] ) )

 			{

 				function loginRadiusShareContent($content) 

 				{

 				global $LoginRadius_settings;

 				



	

				if (strpos($LoginRadius_settings['LoginRadius_shareCode'], 'horizontal') !== false) {

					$append = "<div style='margin:0'><b>".ucfirst($LoginRadius_settings['LoginRadius_share_title'])."</b></div><div class='lrsharecontainer'></div>";

				}else{

					$append = "<div class='lrsharecontainer'></div>";

				}

	 				if( ( isset( $LoginRadius_settings['LoginRadius_sharehome'] ) && is_front_page() ) || ( isset( $LoginRadius_settings['LoginRadius_sharepost'] ) && is_single() ) || ( isset( $LoginRadius_settings['LoginRadius_sharepage'] ) && is_page() ) || ( isset( $LoginRadius_settings['LoginRadius_shareexcerpt'] ) && has_excerpt() ) || ( isset( $LoginRadius_settings['LoginRadius_sharearchive'] ) && is_archive() ) || ( isset( $LoginRadius_settings['LoginRadius_sharefeed'] ) && is_feed() ) )

				{	



					if( isset( $LoginRadius_settings['LoginRadius_sharetop'] ) && isset( $LoginRadius_settings['LoginRadius_sharebottom'] ) )

					{

						$content = $append.'<br/>'.$content.'<br/>'.$append;

					}

					else{


						if( isset( $LoginRadius_settings['LoginRadius_sharetop'] ) )


						{

 							$content = $append.$content;

 						}

 						elseif( isset( $LoginRadius_settings['LoginRadius_sharebottom'] ) )

 						{

 							$content = $content.$append;

 						}

 					}

 				}

 			  return $content;

 			}

 			add_filter('the_content', 'loginRadiusShareContent');

 		} 


	} 


