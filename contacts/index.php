<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

<section class="section service-detail">
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
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>