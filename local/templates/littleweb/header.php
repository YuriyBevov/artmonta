<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico" /> -->

	<? $APPLICATION->ShowHead(); ?>
	<title><? $APPLICATION->ShowTitle() ?></title>

	<?
	includeGlobalAssets();
	initBitrixCore('popup');
	?>
</head>

<body>
	<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
	<div id="smooth-wrapper">
		<div id="smooth-content">
			<header class="header">
				<div class="container">

					<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/site-blocks/logo.php");  ?>
					<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/site-blocks/social.php");  ?>

				</div>
			</header>
			<main class="workarea">