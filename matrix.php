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

				<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
			</div>
		</header>
    <<section id="banner">
				<div class="inner">
					<header>
						<h1>XC Authentication - Telechargement Matrice</h1>
					</header>
			 </div>



			</section>
          <footer id="footer">
				<div class="inner">

					<h3>Telecharger ma matrice</h3>
        <form action="#" method="POST">
			ID (email) : <input type="text" name="mail" size="70" maxlength="70" value="utilisateur@mondomaine.com" /><br /><br />
			Code d'activation : <input type="text" name="code" size="30" maxlength="30" /><br /><br />
            <li><input type="submit" class="button alt" value="Télécharger"/></li><br>
        </form>
		
        
        <br>
        <a href="index.php" class="button alt">Retour à l'accueil</a>
       </footer>
        <?php

                if(isset($_POST['mail']) && isset($_POST['code']))
				{

					$mail = htmlspecialchars($_POST['mail']);
					$code = htmlspecialchars($_POST['code']);

					$wsdl = "http://ntx.pcscloud.net/XCASERVER_WEB/awws/XCAServer.awws?wsdl";

					$client = new SoapClient($wsdl);
					$param = array("sServiceName" => "INSACVL", "sElementName" => $mail, "sActivationCode" => $code);

					$results = $client->__soapCall("DOWNLOAD_CLIENTMATRIX", $param);

					if($results)
					{
						echo $results;
						echo "Téléchargement de la matrice réussi.";
					}
					else
					{
						echo "<br>Echec du téléchargement de la matrice !";
					}
                }

	echo '<br /><br/><button onclick="localStorage.setItem(\'INSACVL3:'.$mail.'\',\''. $results.'\')">Enregistrer ma matrice dans le navigateur</button>
	<br /><br />
	<button onclick="alert(localStorage.getItem(\'INSACVL3:'.$mail.'\'))">Voir ma matrice</button> ';

        ?>
	
	
</body>
</html>

