<!DOCTYPE HTML>
<html>

<head>
        <title>Page publique</title>
        <meta charset="utf-8">
        <meta name="description" content="165c. uniques">
</head>

<body>
    <h1>Authentification XCA - PHP</h1>
	<p>PHASE D'AUTHENTIFICATION</p>

<?php

  	if(isset($_POST['mail']) && isset($_POST['response'])) 
	{
    	$mail = $_POST['mail'];
		$response = $_POST['response'];
		$session = $_POST['session'];

		echo "<br />Utilisateur :<br />";
		echo $mail;
		echo "<br />Réponse au défi :<br />";
		echo $response;

		$response = hash('sha256', $response);

		$wsdl = "http://ntx.pcscloud.net/XCASERVER_WEB/awws/XCAServer.awws?wsdl";
    	$client = new SoapClient($wsdl);

		// Envoi de la réponse au défi
    	$param = array("sSessionVar" => $session, "sServiceName" => "INSACVL", "sElementName" => $mail, "sClientResponse" => $response);
    	$results = $client->__soapCall("SEND_CLIENT_RESPONSE", $param);
	echo "<br/>";
	$param = array("sServiceName" => "INSACVL", "sElementName" => $mail, "sClientResponse" => $response);
	$session= $client->__soapCall("GET_SESSIONVAR", $param);
echo $session;

	echo "<br/>";
		// on regarde si l'authentification a marché ? Marche pas car le résultat pas envoyé en hash sha ?	
		$param = array("sSessionVar" => $session, "sServiceName" => "INSACVL", "sElementName" => $mail);
        if($client->__soapCall("GET_AUTH_RESULT",$param))
	{
		echo "true";
	}
	else
	{
		echo "false";
	}
		
	}

?>

</body>
</html>
