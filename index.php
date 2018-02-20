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
						<h1>XC Authentication</h1>
					</header>
			 </div>



			</section>

    <footer id="footer">
				<div class="inner">

					<h3>Identifiez-vous</h3>

					<form action="#" method="POST">


							<label for="email">ID (e-mail)</label>
							<input type="text" name="mail" size="70" maxlength="70" value="utilisateur@mondomaine.com" />
						</div>
							<li><input type="submit" class="button alt" value="Envoyer" /></li>
                            <li><a href="matrix.php" class = "button alt">Télécharger la matrice</a></li>
                                <?php
		// Lorsque l'utilisateur tente de se connecter
		if(isset($_POST['mail'])){

		$mail = htmlspecialchars($_POST['mail']);

		$wsdl = "http://ntx.pcscloud.net/XCASERVER_WEB/awws/XCAServer.awws?wsdl";
		$client = new SoapClient($wsdl);

		// L'identifiant existe-t-il pour le service INSACVL ?
		$param = array("sServiceName" => "INSACVL", "sElementName" => $mail, "sSessionVar" => "groupe3");
		$results = $client->__soapCall("ISEXIST_ELEMENTSERVICE_XCAJAX", $param);

		// L'identifiant existe-t-il ?
		if($results == 1) {
			// L'identifiant existe
			// Demande du Défi
			$param = array("sServiceName" => "INSACVL", "sElementName" => $mail);
			$results = $client->__soapCall("GET_SERVER_CHALLENGE", $param);

			// CALCUL DE LA REPONSE AU DEFI
				echo '<script> var mat=localStorage.getItem(\'INSACVL3:'.$mail.'\');
						var chal = \''.$results.'\';
						var mail = \''.$mail.'\';
						var result = "";

						chal = chal.split(" ");

					    for(var i=0; i< chal.length-1; i++)
						{
							result += mat[chal[i]];
						}

						// ça marche bien ! :)
						//alert(result);

					// Pour sortir la réponse au défi du javascript et le donner au PHP afin de l envoyer,
					// on envoie via POST le mail et la réponse au défi à une autre page PHP qui enverra la réponse
					var form = document.createElement("form");
					form.setAttribute("method", "POST");
					form.setAttribute("action", "./challenge.php");

					var hiddenField = document.createElement("input");
            				hiddenField.setAttribute("type", "hidden");
            				hiddenField.setAttribute("name", "mail");
            				hiddenField.setAttribute("value", mail);
            				form.appendChild(hiddenField);
					var hiddenField = document.createElement("input");
            				hiddenField.setAttribute("type", "hidden");
            				hiddenField.setAttribute("name", "response");
            				hiddenField.setAttribute("value", result);
            				form.appendChild(hiddenField);

					document.body.appendChild(form);
					form.submit();
				</script>';

		// L'identifiant n'existe pas
		} else
			echo "<br> Utilisateur inconnu.";

		}
	?>
						</ul>
					</form>


		</footer>
	

	
	
	<section id="three" class="wrapper align-center">
				<div class="inner">
					<header>
						<h3>Composition de l'équipe</h3>
					</header>
					<div class="flex flex-2">
						<article>
							<div class="image round">
								<img src="images/pic01.png" alt="Pic 01" />
							</div>
							<header>
								<h3>Noaman Fakhir Aboulhouda</h3>
							</header>
						</article>


						<article>
							<div class="image round">
								<img src="images/pic02.png" alt="Pic 02" />
							</div>
							<header>
								<h3>Camille Chastain</h3>
							</header>
						</article>

						<article>
							<div class="image round">
								<img src="images/pic03.png" alt="Pic 03" />
							</div>
							<header>
								<h3>Thierry-Philippe Thiot</h3>
							</header>
						</article>

						<article>
							<div class="image round">
								<img src="images/pic04.png" alt="Pic 04" />
							</div>
							<header>
								<h3>Joseph Kawalec </h3>
							</header>
						</article>

					</div>
				</div>
			</section>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
</html>
