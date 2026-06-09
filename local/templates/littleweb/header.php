<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	

	<? $APPLICATION->ShowHead(); ?>
	<title><? $APPLICATION->ShowTitle() ?></title>

	<?
	includeGlobalAssets();
	initBitrixCore('popup');

	$curPage = $APPLICATION->GetCurPage();
	?>
</head>

<body class="site-loading">
	<div class="site-loader" data-site-loader aria-hidden="true"></div>
	<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

	<header class="header">
		<div class="container">

			<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>

			<div class="menu">
				<div class="menu__wrapper">

					<div class="menu__header">
						<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>

						<div class="burger-btn burger-btn--closer" aria-label="Кнопка открытия меню">
							<svg width="20" height="20" viewBox="0 0 20 20" role="img" aria-hidden="true" focusable="false">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-cross"></use>
							</svg>
						</div>
					</div>
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"top-menu",
						array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "2",
							"MENU_CACHE_GET_VARS" => array(),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_THEME" => "site",
							"ROOT_MENU_TYPE" => "top",
							"USE_EXT" => "Y",
							"COMPONENT_TEMPLATE" => "top-menu"
						),
						false
					); ?>

					<div class="contacts-block">
						<?
						$APPLICATION->IncludeFile(
							SITE_DIR . 'include/phone.php',
							array(),
							array('MODE' => 'html', 'NAME' => 'номер телефона', 'SHOW_BORDER' => true)
						);
						?>

						<?
						$APPLICATION->IncludeFile(
							SITE_DIR . 'include/mail.php',
							array(),
							array('MODE' => 'html', 'NAME' => 'адрес эл.почты', 'SHOW_BORDER' => true)
						);
						?>
					</div>
					
					<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>
					

				</div>
			</div>

			<div class="contacts-block">
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR . 'include/mail.php',
					array(),
					array('MODE' => 'html', 'NAME' => 'адрес эл.почты', 'SHOW_BORDER' => true)
				);
				?>
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR . 'include/phone.php',
					array(),
					array('MODE' => 'html', 'NAME' => 'номер телефона', 'SHOW_BORDER' => true)
				);
				?>
			</div>

			<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>
			<button type="button" class="burger-btn burger-btn--opener">
				<svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
					<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-burger'></use>
				</svg>
			</button>
		</div>
	</header>
	<? if ($curPage === '/'): ?>
		
		<? include_once($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/hero-section/template.php");  ?>
		

		<div class="hero-overlay"></div>
	<? endif; ?>



	<div id="smooth-wrapper">
		<div id="smooth-content">
			<? if ($curPage === '/'): ?>
				<div class="hero-spacer"></div>
			<? endif; ?>
			<main class="workarea">
				<? if ($curPage != '/' && !defined("ERROR_404")):
					$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"lw-breadcrumb", 
	[
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0",
		"COMPONENT_TEMPLATE" => "lw-breadcrumb"
	],
	false
);
				endif; ?>
