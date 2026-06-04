<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

if (!defined("PORTFOLIO_FILTER_TYPE")) {
	define("PORTFOLIO_FILTER_TYPE", "portfolio_type");
}

if (!defined("PORTFOLIO_FILTER_CAT")) {
	define("PORTFOLIO_FILTER_CAT", "portfolio_cat");
}

if (!defined("PORTFOLIO_FILTER_YEAR")) {
	define("PORTFOLIO_FILTER_YEAR", "portfolio_year");
}

if (!function_exists("portfolio_list_get_request_value")) {
	function portfolio_list_get_request_value($key)
	{
		$value = $_GET[$key] ?? "";

		if (is_array($value)) {
			return "";
		}

		return trim((string)$value);
	}
}

if (!function_exists("portfolio_list_normalize_property_values")) {
	function portfolio_list_normalize_property_values($property)
	{
		$values = [];
		$rawValue = $property["VALUE_ENUM"] ?? $property["VALUE"] ?? "";

		if (!is_array($rawValue)) {
			$rawValue = [$rawValue];
		}

		foreach ($rawValue as $value) {
			if (is_array($value)) {
				$value = $value["TEXT"] ?? $value["VALUE"] ?? "";
			}

			$value = trim((string)$value);

			if ($value !== "") {
				$values[$value] = $value;
			}
		}

		return array_values($values);
	}
}

if (!function_exists("portfolio_list_get_item_year")) {
	function portfolio_list_get_item_year($item)
	{
		$date = trim((string)($item["ACTIVE_FROM"] ?? ""));

		if ($date === "") {
			return "";
		}

		if (function_exists("MakeTimeStamp")) {
			$timestamp = MakeTimeStamp($date);

			if ($timestamp) {
				return date("Y", $timestamp);
			}
		}

		$timestamp = strtotime($date);

		return $timestamp ? date("Y", $timestamp) : "";
	}
}

if (!function_exists("portfolio_list_item_has_value")) {
	function portfolio_list_item_has_value($values, $selectedValue)
	{
		if ($selectedValue === "") {
			return true;
		}

		return in_array($selectedValue, $values, true);
	}
}

$selectedType = portfolio_list_get_request_value(PORTFOLIO_FILTER_TYPE);
$selectedCat = portfolio_list_get_request_value(PORTFOLIO_FILTER_CAT);
$selectedYear = portfolio_list_get_request_value(PORTFOLIO_FILTER_YEAR);

$filterOptions = [
	"TYPE" => [],
	"CAT" => [],
	"YEAR" => [],
];

$sourceItems = [];

foreach ($arResult["ITEMS"] as $item) {
	if (isset($item["ACTIVE"]) && $item["ACTIVE"] !== "Y") {
		continue;
	}

	$typeValues = portfolio_list_normalize_property_values($item["PROPERTIES"]["TYPE"] ?? []);
	$catValues = portfolio_list_normalize_property_values($item["PROPERTIES"]["CAT"] ?? []);
	$year = portfolio_list_get_item_year($item);

	foreach ($typeValues as $value) {
		$filterOptions["TYPE"][$value] = $value;
	}

	foreach ($catValues as $value) {
		$filterOptions["CAT"][$value] = $value;
	}

	if ($year !== "") {
		$filterOptions["YEAR"][$year] = $year;
	}

	$item["PORTFOLIO_FILTER_VALUES"] = [
		"TYPE" => $typeValues,
		"CAT" => $catValues,
		"YEAR" => $year,
	];

	$sourceItems[] = $item;
}

natcasesort($filterOptions["TYPE"]);
natcasesort($filterOptions["CAT"]);
krsort($filterOptions["YEAR"], SORT_NATURAL);

$arResult["PORTFOLIO_FILTER"] = [
	"PARAMS" => [
		"TYPE" => PORTFOLIO_FILTER_TYPE,
		"CAT" => PORTFOLIO_FILTER_CAT,
		"YEAR" => PORTFOLIO_FILTER_YEAR,
	],
	"SELECTED" => [
		"TYPE" => $selectedType,
		"CAT" => $selectedCat,
		"YEAR" => $selectedYear,
	],
	"OPTIONS" => [
		"TYPE" => array_values($filterOptions["TYPE"]),
		"CAT" => array_values($filterOptions["CAT"]),
		"YEAR" => array_values($filterOptions["YEAR"]),
	],
	"SOURCE_ITEMS_COUNT" => count($sourceItems),
];

$arResult["ITEMS"] = array_values(array_filter($sourceItems, static function ($item) use ($selectedType, $selectedCat, $selectedYear) {
	$values = $item["PORTFOLIO_FILTER_VALUES"];

	return portfolio_list_item_has_value($values["TYPE"], $selectedType)
		&& portfolio_list_item_has_value($values["CAT"], $selectedCat)
		&& ($selectedYear === "" || $values["YEAR"] === $selectedYear);
}));
