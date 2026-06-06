<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

<section class="section contacts">
	<div class="container-fluid">
		<?
		$APPLICATION->IncludeFile(
			SITE_TEMPLATE_PATH . '/include/section-inner-header.php',
			array(

				'TITLE' => "Контакты",
				// 'PICTURE' => $arResult["DETAIL_PICTURE"]["SRC"]
			),
			array('MODE' => 'html', 'NAME' => 'шапку страницы', 'SHOW_BORDER' => false)
		);
		?>
	</div>
	<div class="container">
		<div class="contacts-block">

			<div class="contacts-block__field">
				<strong>Телефон для связи:</strong>
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR . 'include/phone.php',
					array(),
					array('MODE' => 'html', 'NAME' => 'телефон', 'SHOW_BORDER' => true)
				);
				?>
			</div>
			<div class="contacts-block__field">
				<strong>E-mail:</strong>
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR . 'include/mail.php',
					array(),
					array('MODE' => 'html', 'NAME' => 'адрес электронной почты', 'SHOW_BORDER' => true)
				);
				?>
			</div>
			<div class="contacts-block__field">
				<strong>Адрес:</strong>
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR . 'include/address.php',
					array(),
					array('MODE' => 'html', 'NAME' => 'адрес', 'SHOW_BORDER' => true)
				);
				?>
			</div>

		</div>
		<? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>

		<?
		$APPLICATION->IncludeFile(
			SITE_DIR . 'include/map.php',
			array(),
			array('MODE' => 'html', 'NAME' => 'карту', 'SHOW_BORDER' => true)
		);
		?>
	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>