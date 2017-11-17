<?php

$facebook_appId = "156873018174785";
$facebook_appSecret = "ee95643e1f47992ac84e8b5b18188df3";
$facebook_code = "";
$redirect_uri = urlencode(base_url('facebook_return'));

$code =  $_GET['code'];

$token_url = "https://graph.facebook.com/oauth/access_token?"."client_id=".$facebook_appId."&redirect_uri=".$redirect_uri."&client_secret=".$facebook_appSecret."&code=".$code;

$response = json_decode(file_get_contents($token_url));

if(isset($response->access_token)){
    $graph_url = "https://graph.facebook.com/me?access_token=".$response->access_token."&fields=name,email";
    $user = json_decode(file_get_contents($graph_url));
}else{
	echo "Erro de conexão com Facebook!";
	exit();
}

?>
<html>
	<head>
		<script type="text/javascript">
			window.opener.returnFacebook("<?=$user->name;?>","<?=$user->email;?>");
			window.close();
		</script>
	</head>
</html>