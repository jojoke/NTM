<!DOCTYPE HTML>
<html>

<head>
        <title>Page Publique</title>
        <meta charset="utf-8">
        <meta name="description" content="165c. uniques">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
    <header id="header">
			<div class="inner">
				<a href="index.html" class="logo"><strong>Groupe3</strong></a>

		  </div>
		</header>
    <section id="banner">
				<div class="inner">
					<header>
            <h1>Authentification XCA - PHASE D'AUTHENTIFICATION</h1>
          </header>
        </div>
    </section>


<?php

  	if(isset($_POST['mail']) && isset($_POST['response']))
	{
    	$mail = $_POST['mail'];
		$response = $_POST['response'];
		$session = $_POST['session'];

		echo '  <footer id="footer">
				<div class="inner">
        <br />Utilisateur :<br />';
		echo $mail;
		echo "<br />Réponse au défi :<br />";
		echo $response.' </div> </footer>';



		$wsdl = "http://ntx.pcscloud.net/XCASERVER_WEB/awws/XCAServer.awws?wsdl";
    	$client = new SoapClient($wsdl);
      $response2 = $client->__soapCall("COMPUTE_HASH1",array("SHA-256",$response));
		// Envoi de la réponse au défi
    	$param = array("sSessionVar" => $session, "sServiceName" => "INSACVL", "sElementName" => $mail, "sClientResponse" => $response2);
      echo '  <footer id="footer">
  				<div class="inner"> La réponse est'.$response2.'</div> </footer>';
      $results = $client->__soapCall("SEND_CLIENT_RESPONSE", $param);

	    $paramA = array("sServiceName" => "INSACVL", "sElementName" => $mail);
	    $sessionA= $client->__soapCall("GET_SESSIONVAR_XCAJAX", $paramA);

		// on regarde si l'authentification a marché ? Marche pas car le résultat pas envoyé en hash sha ?
		  $paramB = array("sSessionVar" => $session, "sServiceName" => "INSACVL", "sElementName" => $mail);

  if($client->__soapCall("GET_AUTH_RESULT",$paramB))
	{
    echo '  <footer id="footer">
				<div class="inner"></br>it worked </div> </footer>';
		header('location:private.php');
	}
	else
	{
		echo '<footer id="footer2">
				<div class="inner" >Réussite du défi : </br>négative</div> </footer>';
	}

	}

?>
<footer id="footer">
    <div class="inner">
      <a href="index.php" class="button alt">Retour à l'accueil</a>
    </div>
</footer>
</body>
</html>
