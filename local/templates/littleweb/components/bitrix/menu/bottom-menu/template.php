<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if ($arResult): ?>
	<div class="bottom-menu">
		<ul>
			<? foreach ($arResult as $arItem) : ?>
				<li>
					<a href="<?= $arItem["LINK"] ?>" <?= ($arItem["SELECTED"] ? 'class="selected"' : '') ?>><?= $arItem["TEXT"] ?></a>
				</li>
			<? endforeach ?>
		</ul>
	</div>
<? endif; ?>