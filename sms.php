<?php
function sendSMS($message)
{
	//config
	$username = 'xxxxx';
	$password = 'xxxxx';
	//config
	
	$url = 'https://smsapi.free-mobile.fr/sendmsg?user='.$username.'&pass='.$password.'&msg='.$message;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url
	));

	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if($httpCode == 404) {
		echo '404 serverside, check your username or password.';
	}
	elseif($httpCode == 400) {
		echo 'Missing parameter.';
	}
	elseif($httpCode == 402) {
		echo 'Too many SMS sent, please wait.';
	}
	elseif($httpCode == 403) {
		echo 'Service not enabled on your account.';
	}
	elseif($httpCode == 500) {
		echo 'Freemobile server error, please try again later.';
	}
	else
	{
		if(curl_exec($curl) === false)
		{
			echo 'Curl error: ' . curl_error($curl);
		}
		else
		{
			echo 'SMS Sent !';
		}
	}
	curl_close($curl);
}

sendSMS('Yay, working !');
?>