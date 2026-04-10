<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if ($arResult['ELEMENTS']) {
  $APPLICATION->AddHeadScript($templateFolder . '/custom_script.js');
}
