<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Стоимость");
?>

<section class="section pricelist">
	<div class="container-fluid">
		<?
		$APPLICATION->IncludeFile(
			SITE_TEMPLATE_PATH . '/include/section-inner-header.php',
			array(
				'TITLE' => "Стоимость",
			),
			array('MODE' => 'html', 'NAME' => 'шапку страницы', 'SHOW_BORDER' => false)
		);
		?>
	</div>

	<? include_once($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/pricelist-download/template.php");  ?>

	<div class="container">
		<div class="glass-wrapper">
			<?
			$APPLICATION->IncludeFile(
				SITE_DIR . 'include/pricelist-content.php',
				array(),
				array('MODE' => 'html', 'NAME' => 'телефон', 'SHOW_BORDER' => true)
			);
			?>
		</div>
	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>