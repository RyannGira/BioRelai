<?php
require_once 'auto/autoload.php';
session_start()?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Vlib</title>
        <link rel="icon" href="images/icon-vlib.ico">
		<style type="text/css">
			@import url(styles/vlib.css);
		</style>
	</head>
	<body>
		<?php
			include_once 'controleurs/controleurPrincipal.php';
		?>
	</body>
</html>