<?php

//Check if we have received a connection_token
if (!empty($_POST['connection_token'])) {
	//Get connection_token
	$token = $_POST['connection_token'];

	//Read settings
	$settings = get_option('oa_social_login_settings');

	//Your Site Settings
	$site_subdomain = (!empty($settings['api_subdomain']) ? $settings['api_subdomain'] : '');
	$site_public_key = (!empty($settings['api_key']) ? $settings['api_key'] : '');
	$site_private_key = (!empty($settings['api_secret']) ? $settings['api_secret'] : '');

	//API Access domain
	$site_domain = $site_subdomain . '.api.oneall.com';

	//Connection Resource
	//http://docs.oneall.com/api/resources/connections/read-connection-details/
	$resource_uri = 'https://' . $site_domain . '/connections/' . $token . '.json';

	//Setup connection
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $resource_uri);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
	curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	curl_setopt($curl, CURLOPT_VERBOSE, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($curl, CURLOPT_FAILONERROR, 0);

	//Send request
	$result_json = curl_exec($curl);

	//Error
	if ($result_json === false) {
		//Implement your custom error handling here
		echo 'Curl error: ' . curl_error($curl) . '<br />';
		echo 'Curl info: ' . curl_getinfo($curl) . '<br />';
		curl_close($curl);
	}
	//Success
	else {
		//Close connection
		curl_close($curl);

		//Decode
		$json = json_decode($result_json);

		//Extract data
		$data = $json -> response -> result -> data;

		//Check for plugin
		if ($data -> plugin -> key == 'social_login') {
			//http://docs.oneall.com/plugins/guide/social-login/
		} elseif ($data -> plugin -> key == 'social_link') {
			//Operation successfull
			if ($data -> plugin -> data -> status == 'success') {
				//Identity linked
				if ($data -> plugin -> data -> action == 'link_identity') {
					//The identity <identity_token> has been linked to the user <user_token>
					$user_token = $data -> user -> user_token;
					$identity_token = $data -> user -> identity -> identity_token;
					
					wp_redirect( siteurl() ); exit;

					//Next Step:
					// 1] Get _your_ $userid from _your_ SESSION DATA
					// 2] Check if the $userid is linked to this user_token: GetUserIdForUserToken($user_token)
					// 2.1] If not linked, tie the <user_token> to this userid : LinkUserTokenToUserId($user_token, $user_id)
					// 3] Redirect the user to the account linking page
				}
				//Identity Unlinked
				elseif ($data -> plugin -> data -> action == 'unlink_identity') {
					//The identity <identity_token> has been unlinked from the user <user_token>
					$user_token = $data -> user -> user_token;
					$identity_token = $data -> user -> identity -> identity_token;
					
					wp_redirect( siteurl() ); exit;
					
					//Next Step:
					// 1] At your convenience
					// 2] Redirect the user to the account linking page
				}
			}
		}
	}
} else {
	echo 'error';
}
