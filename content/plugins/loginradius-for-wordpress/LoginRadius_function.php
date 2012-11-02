<?php 

/** 
 * Function that process callback redirection. 
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
function loginRadiusGetBp(){
	if( is_plugin_active("buddypress/bp-loader.php") ){
		return true;
	}
	return false;
}

function get_redirect_location($http) {
  $loc = urlencode($http.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); 
  if (urldecode($loc) == wp_login_url() OR urldecode($loc) == site_url().'/wp-login.php?action=register' OR urldecode($loc) ==site_url().'/wp-login.php?loggedout=true') { 
    $loc = site_url().'/'; 
  } 
  elseif ( isset($_GET['redirect_to']) && ( urldecode($_GET['redirect_to']) == admin_url() ) ) { 
    $loc = site_url().'/'; 
  } 
  elseif (isset($_GET['redirect_to'])) { 
    $loc = $_GET['redirect_to']; 
  } 
  else { 
    $loc = urlencode($http.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); 
  } 
  return $loc; 
} 

/** 
 * Function that shows social icons on wp. 
 */ 
function Login_Radius_Connect_button( $newInterface = false ) { 
  global $LoginRadius_settings; 
  $title = $LoginRadius_settings['LoginRadius_title']; 
  if (!is_user_logged_in()) {  
    if ($newInterface) { 
      $result = "<div style='margin-bottom: 3px;'><label>".$title."</label></div>".Login_Radius_get_interface( $newInterface ); 
      return $result; 
    } 
    else {?> 
      <div> 
      <div style='margin-bottom: 3px;'><label><?php _e( $title, 'LoginRadius' ) ?></label></div><?php  
      Login_Radius_get_interface($newInterface);?> 
      </div><?php 
    } 
  } 
} 

/** 
 * Function that shows social icons on wp. 
 */  
function Login_Radius_get_interface( $newInterface=false ) { 
  $LoginRadius_settings = get_option ('LoginRadius_settings'); 
  $LoginRadius_apikey = trim($LoginRadius_settings['LoginRadius_apikey']); 
  $LoginRadius_secret = trim($LoginRadius_settings['LoginRadius_secret']); 
  $loginRadiusError = "<p style ='color:red;'>Your LoginRadius API key and secret is not valid, please correct it or contact LoginRadius support at <b><a href ='http://www.loginradius.com' target = '_blank'>www.LoginRadius.com</a></b></p>"; 
   
  $loginRadiusConnErr = "<p style ='color:red;'>Your API connection setting not working. try to change setting from module option or check your php.ini setting for (<b>cURL support = enabled</b> OR <b>allow_url_fopen = On</b>)</p>"; 
   
  $loginRadiusEmpty = "<p style ='color:red;'>To activate your plugin, please log in to LoginRadius and get API Key & Secret. Web: <b><a href ='http://www.loginradius.com' target = '_blank'>www.LoginRadius.com</a></b></p>"; 
   
  if($LoginRadius_apikey == "" && $LoginRadius_secret == ""){ 
      if (!$newInterface) 
	  { 
        echo $loginRadiusEmpty; 
	  	return; 
      } 
	  else 
      {  
		return $loginRadiusEmpty; 
      } 
  } 
   
  if (isset($LoginRadius_apikey)) { 
    require_once ('LoginRadiusSDK.php'); 
    $obj_auth = new LoginRadius(); 
    $UserAuth = $obj_auth->loginradius_get_auth($LoginRadius_apikey, $LoginRadius_secret); 
    if ($UserAuth == "invalid") { 
	 
      if (!$newInterface) 
	  { 
        echo $loginRadiusError; 
	  	return; 
      } 
	  else 
      {  
		return $loginRadiusError; 
      } 
    } 
	 
	if( $UserAuth == "api connection") 
	{ 
	   if (!$newInterface) 
	   { 
		 echo $loginRadiusConnErr; 
		 return; 
	   } 
	   else 
	   {  
		 return $loginRadiusConnErr; 
	   } 
	} 
	 
    $IsHttps = (!empty($UserAuth->IsHttps) ? $UserAuth->IsHttps : ''); 
    $iframeHeight = (!empty($UserAuth->height) ? $UserAuth->height : 50); 
    $iframeWidth = (!empty($UserAuth->width) ? $UserAuth->width : 169); 
    $http = ($IsHttps == 1 ? "https://" : "http://");

	

	$loc = get_redirect_location($http);

    $loginRadiusResult = "<iframe src=".$http."hub.loginradius.com/Control/PluginSlider.aspx?apikey=".$LoginRadius_apikey."&callback=".$loc." width='".$iframeWidth."' height='".$iframeHeight."' frameborder='0' scrolling='no' allowtransparency='true' ></iframe>"; 
    if (!$newInterface) 
	{ 
      echo $loginRadiusResult; 
    } 
	else 
    { 
	  return $loginRadiusResult; 
  	} 
  } 
} 

/** 
 * Function that shows social icons in widget area. 
 */	 
function Login_Radius_widget_Connect_button( ) { 
  if (!is_user_logged_in()) {  
    Login_Radius_get_interface(); 
  } 
  // On user Login show user details. 
  if (is_user_logged_in() && !is_admin()) { 
    global $LoginRadius_settings; 
    global $user_ID; $size ='60'; 
    $user = get_userdata($user_ID); 
    echo "<div style='height:80px;width:180px'><div style='width:63px;float:left;'>"; 
    if (($user_thumbnail = get_user_meta ($user_ID, 'thumbnail', true)) !== false) { 
	 
      if (strlen (trim ($user_thumbnail)) > 0) { 
	    echo '<img alt="user social avatar" src="'.$user_thumbnail.'" height = "'.$size.'" width = "'.$size.'" title="'.$user->user_login.'" style="border:2px solid #e7e7e7;"/>'; 
      } 
	  else { 
	    echo @get_avatar( $user_ID, $size, $default, $alt );   
	  } 
    } 
	 
	echo "</div><div style='width:110px;float:right;'>"; 
	_e($user->user_login,  'LoginRadius') ; 
	//$redirect = get_permalink(); 
	if ($LoginRadius_settings['LoginRadius_loutRedirect'] == 'custom' && !empty($LoginRadius_settings['custom_loutRedirect'])) 
	{ 
	  $redirect = htmlspecialchars($LoginRadius_settings["custom_loutRedirect"]); 
	} 
	else 
	{ 
	  $redirect = home_url();?><br /> 
     <?php  
	 } 
	 ?> 
	  <a href="<?php echo wp_logout_url($redirect);?>"><?php _e('Log Out', 'LoginRadius');?></a></div></div><?php  
  } 
} 
$LoginRadius_settings = get_option('LoginRadius_settings'); // social share 
if( is_active_widget(false, false, 'loginradiusshare', true) || ( isset($LoginRadius_settings['LoginRadius_shareEnable']) && $LoginRadius_settings['LoginRadius_shareEnable'] == '1') )

{ 
	include('LoginRadius_socialShare.php'); 
} 
// social counter 
if( is_active_widget(false, false, 'loginradiuscounter', true) || ( isset( $LoginRadius_settings['LoginRadius_counterEnable'] ) && $LoginRadius_settings['LoginRadius_counterEnable'] == '1' ) ) 
{

	include('LoginRadius_socialCounter.php'); 
} // Social Login location 
include('LoginRadius_location.php'); 

if ($LoginRadius_settings['LoginRadius_loginform'] == '1' && $LoginRadius_settings['LoginRadius_loginformPosition'] == "embed") { 
  		add_action( 'login_form','Login_Radius_Connect_button'); 
      add_action('bp_before_sidebar_login_form', 'Login_Radius_Connect_button'); 
} 
if (($LoginRadius_settings['LoginRadius_loginform'] == '1' && $LoginRadius_settings['LoginRadius_loginformPosition'] == "beside") || ($LoginRadius_settings['LoginRadius_regform'] == '1' && $LoginRadius_settings['LoginRadius_regformPosition'] == "beside")) {  

	 add_action('login_head', 'loginRadiusLoginInterface'); 
     if($LoginRadius_settings['LoginRadius_loginformPosition'] == "beside"){ 
	 	 add_action('bp_before_sidebar_login_form', 'Login_Radius_Connect_button'); 
	 } 
	 if($LoginRadius_settings['LoginRadius_regformPosition'] == "beside"){

		  add_action('bp_before_account_details_fields', 'Login_Radius_Connect_button');

  	} 
} 
if ($LoginRadius_settings['LoginRadius_regform'] == '1' && $LoginRadius_settings['LoginRadius_regformPosition'] == "embed") { 
  add_action( 'register_form', 'Login_Radius_Connect_button'); 
  add_action( 'after_signup_form','Login_Radius_Connect_button'); 
      add_action('bp_before_account_details_fields', 'Login_Radius_Connect_button'); 

} 

function LoginRadiusCommentScript(){ 
   wp_enqueue_script('LoginRadiusCommentingScript', plugins_url('js/loginRadiusComments.js', __FILE__), array(), false, false); 
   wp_register_style('LoginRadiusCommentsCss', plugins_url('css/loginRadiusComments.css', __FILE__), array(), false, 'all'); 
   wp_enqueue_style('LoginRadiusCommentsCss'); 
} 

function loginRadiusMove_textarea( $loginRadiusInput = array () ) { 	
		static $loginRadiusTextarea = '';
	
	
	
	
	
	
	
		if ( 'comment_form_defaults' === current_filter() )
	
	
		{
	
			// Copy the field to our internal variable …
	
			$loginRadiusTextarea = $loginRadiusInput['comment_field'];
	
	
	
			// … and remove it from the defaults array.
	
	
	
			$loginRadiusInput['comment_field'] = '';
	
			unset( $loginRadiusInput['comment_notes_after'] );
	
	
	
			return $loginRadiusInput;
	
	
	
		}
	
	
	//	global $user_ID; $size ='60';
		//		$user = get_user_meta ($user_ID, 'thumbnail', false);
		//		print_r($user); die;

		if ( !(loginRadiusGetBp() && is_user_logged_in() ) ){

	
		$loginRadiusCommentHtml = $loginRadiusTextarea."<div id='loginRadiusLoginMessage' style='background-color:#000000; display:none; width:95%;height:24px;padding-left:5px;color:#fff; font-size:small'><p class='comment-notes'>Post your comments via a social network or fill out your name and email.</p></div>".
	
														"<div id='loginRadiusMainWrapper' style='display:none'>".
	
	
	
	
	
													"<div id='loginRadiusWrapper' style='width:56%; float:right; padding-left:3%; border-left:1px solid #ccc; margin-left:10px'>";
	
		}
	
			if (is_user_logged_in() && !is_admin()) {
				global $user_ID; $size ='60';
				$user = get_userdata($user_ID);
				
				if (($user_thumbnail = get_user_meta ($user_ID, 'thumbnail', true)) !== false) {
				  if (strlen (trim ($user_thumbnail)) > 0) {
					echo '<img alt="user social avatar" src="'.$user_thumbnail.'" height = "'.$size.'" width = "'.$size.'" title="'.$user->user_login.'" style="border:2px solid #e7e7e7;"/>';
				  }else { 
				  	if( loginRadiusGetBp() ){
						echo "<div style='width:63px;height:70px;clear:both'>";
				  		echo bp_loggedin_user_avatar();
						echo '</div>';
					}else{
						echo "<div style='width:63px;height:70px;clear:both'>";
						echo @get_avatar( $user_ID, $size, $default, $alt ); 
						echo '</div>';
				  	}
				  }
				}
		
			}
	
	
	if ( !(loginRadiusGetBp() && is_user_logged_in() ) ){
		print $loginRadiusCommentHtml;

	}
	
} function loginRadiusWrapper_div_end(){

	if ( !(loginRadiusGetBp() && is_user_logged_in() ) ){

		global $LoginRadius_settings;
	
		echo '</div>';
		
		
		if( loginRadiusGetBp() ){ 
			echo '</div>';
		}
	
		echo '<div id="loginRadiusInterface">'.
	
		"<div id='loginRadiusOr'><p>".htmlspecialchars(trim($LoginRadius_settings['LoginRadius_commentText']))."</p></div>";
	
		echo Login_Radius_get_interface();
	
		echo '</div>';
	}
} 

function loginRadiusWrapper_div_end2(){

	if ( !(loginRadiusGetBp() && is_user_logged_in() ) ){
	
		echo '</div>';

	}
}  function loginRadiusMainWrapperEnd(){
	if ( !(loginRadiusGetBp() && is_user_logged_in() ) ){

		if( !loginRadiusGetBp() ){
			echo '</div>';
		}
	}

} 
if ($LoginRadius_settings['LoginRadius_commentEnable'] == '1') { 
  if ( ( get_option('comment_registration') && !$user_ID ) && $LoginRadius_settings['LoginRadius_commentform'] ) { 
    add_action( 'comment_form_must_log_in_after','Login_Radius_Connect_button'); 
  } 
  if( $LoginRadius_settings['LoginRadius_commentform'] == "new" ){ 
    add_action('wp_enqueue_scripts', 'LoginRadiusCommentScript' ); 
	add_action( 'comment_form_defaults', 'loginRadiusMove_textarea' );

	
		add_action( 'comment_form_top', 'loginRadiusMove_textarea' );
		add_action('comment_form_after_fields', 'loginRadiusWrapper_div_end');
		add_action('comment_form_logged_in_after', 'loginRadiusWrapper_div_end2');
		add_action('comment_form', 'loginRadiusMainWrapperEnd');

  }elseif( $LoginRadius_settings['LoginRadius_commentform'] == "old" ){ 
    add_action( 'comment_form_top','Login_Radius_Connect_button'); 
  } 
} 

/** 
 * Function for redirects user after login. 
 */	 
function LoginRadius_redirect() { 
  $LoginRadius_settings = get_option ('LoginRadius_settings'); 
  $LoginRadius_redirect = $LoginRadius_settings['LoginRadius_redirect']; 
  $LoginRadius_redirect_custom_redirect = $LoginRadius_settings['custom_redirect']; 
  $redirect_to = site_url(); 
  $redirect_to_safe = false; 
  if (!empty($_GET['redirect_to'])) { 
    $redirect_to = $_GET['redirect_to']; 
    $redirect_to_safe = true; 
  } 
  else {

    if (isset($LoginRadius_redirect)) { 
      switch (strtolower($LoginRadius_redirect)) { 
        case 'homepage': 
          $redirect_to = site_url().'/'; 		  break; 
		   
		case 'dashboard': 
		  $redirect_to = admin_url(); 
		  break; 
		   
		case 'custom': 
		  if (isset ($LoginRadius_redirect) && strlen(trim($LoginRadius_redirect_custom_redirect)) > 0) { 
            $redirect_to = trim($LoginRadius_redirect_custom_redirect); 
          } 
		  break; 
		 
		default: 
		  case 'samepage': 
		    $redirect_to = @$_GET['callback']; 
		  break; 
      } 
    } 
  } 
  
  	if( loginRadiusGetBp() ){

		if(isset($LoginRadius_redirect) && strtolower($LoginRadius_redirect) == "samepage" ){

			//$redirect_to = site_url().$_SERVER['REQUEST_URI'];
			$redirect_to = ($_SERVER["HTTPS"] == "on") ? "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		}

		if( ($LoginRadius_settings['LoginRadius_commentEnable'] == '1') && ($LoginRadius_settings['LoginRadius_commentform'] == 'new') ){

			//$redirect_to = site_url().$_SERVER['REQUEST_URI'];
			$redirect_to = ($_SERVER["HTTPS"] == "on") ? "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		}

		bp_core_redirect($redirect_to);

  }else {

 		if( ($LoginRadius_settings['LoginRadius_commentEnable'] == '1') && ($LoginRadius_settings['LoginRadius_commentform'] == 'new') ){

		?>
			<script type="text/javascript">
				location.href = "<?php echo isset($_GET['callback']) ? $_GET['callback'] : ""; ?>";
			</script>
			<?php
			die;

		}

 

	  if ($redirect_to_safe) {

		wp_redirect($redirect_to);

	  }

	  else {
	  	if( strtolower($LoginRadius_redirect) == "samepage" )
		{
		?>
			<script type="text/javascript">
				location.href = "<?php echo $redirect_to; ?>";
			</script>
			<?php
			die;
		}
		wp_safe_redirect($redirect_to); 

	  }

  } 
} 

/** 
 * Display Sharing Interface. 
 */	   
function loginradius_share_output() {

	global $LoginRadius_settings;

	if (strpos($LoginRadius_settings['LoginRadius_shareCode'], 'islrsocialcounter = false') !== false){

		echo str_replace("islrsocialcounter = false", "islrsocialcounter = true", $LoginRadius_settings['LoginRadius_shareCode']);

	}else{

		echo $LoginRadius_settings['LoginRadius_shareCode'];

	}

} 
/** 
 * Display counter Interface. 
 */	   
function loginradius_counter_output() {

	global $LoginRadius_settings;

	if (strpos($LoginRadius_settings['LoginRadius_counterCode'], 'islrsharing = false') !== false){

		echo str_replace("islrsharing = false", "islrsharing = true", $LoginRadius_settings['LoginRadius_counterCode']);

	}else{

		echo $LoginRadius_settings['LoginRadius_counterCode'];

	}

} /** 
 * Function for shows share bar title. 
 */		 
function loginradius_share_title() { 
  global $LoginRadius_settings; 
  $html = '<!-- Start Sociable --><div class="loginradius">'; 
  // If a tagline is set, display it above the social icons 
  $tagline = isset( $LoginRadius_settings['LoginRadius_share_title'] ) ? $LoginRadius_settings['LoginRadius_share_title'] : '' ; 
  if (!empty($tagline)) { 
    $html .= '<div class="loginradius_tagline">'; 
    $html .= "<a class='loginradius_tagline' target='_blank' href='http://loginradius.com' style='color:#333333;text-decoration:none'>".$tagline."</a>"; 
    $html .= "</div>"; 
  } 
  return $html; 
} 

/** 
 * Function for auto approve comment if uses sociallogin. 
 */ 
function loginradius_comment_approved($approved) { 
  global $LoginRadius_settings; 
  if (empty($approved)) { 
    $LoginRadius_settings = get_option ('LoginRadius_settings'); 
    if ($LoginRadius_settings['LoginRadius_autoapprove'] == '1') { 
      $user_id = get_current_user_id(); 
      if (is_numeric($user_id)) { 
        $comment_user = get_user_meta ($user_id, 'id', true); 
        if ($comment_user !== false) { 
          $approved = 1; 
        } 
      } 
    } 
  } 
  return $approved; 
} 
if ($LoginRadius_settings['LoginRadius_commentEnable'] == '1') {

	add_action('pre_comment_approved', 'loginradius_comment_approved');

} 
?>