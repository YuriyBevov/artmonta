<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



global $APPLICATION;


if (empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '
	<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
		<div class="container">
		<ul class="breadcrumbs__list">
		<li class="breadcrumbs__list-item" id="bx_breadcrumb_0" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="/" title="Главная" itemprop="item">
					<span itemprop="name">Главная&nbsp;&mdash;&nbsp;</span>
				</a>
				<meta itemprop="position" content="0" />
			</li>
	';

$itemSize = count($arResult);

for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
		$strReturn .= '
			<li class="breadcrumbs__list-item" id="bx_breadcrumb_' . ($index + 1) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '" itemprop="item">
					<span itemprop="name">' . $title . '&nbsp;&mdash;&nbsp;</span>
				</a>
				<meta itemprop="position" content="' . ($index + 1) . '" />
			</li>';
	} else {
		$strReturn .= '
			<li class="breadcrumbs__list-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="item" itemprop="name">' . $title . '</span>
				<meta itemprop="position" content="' . $itemSize . '" />
			</li>';
	}
}

$strReturn .= '</ul></div></div>';

return $strReturn;
