<?php
function sendSMS($message)
{
	//config
	$username = 'xxxxx';
	$password = 'xxxxx';
	//config
	
	$url = 'https://smsapi.free-mobile.fr/sendmsg?user='.$username.'&pass='.$password.'&msg='.$message.'';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));

	if(curl_exec($curl) === false)
	{
		echo 'Curl error: ' . curl_error($ch);
	}
	else
	{
		echo 'SMS Sent !';
	}

	curl_close($curl);
}

sendSMS('Yay, working !');
?>