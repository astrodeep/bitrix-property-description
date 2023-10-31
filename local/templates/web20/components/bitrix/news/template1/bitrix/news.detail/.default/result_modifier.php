<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$elementID = $arParams["ELEMENT_ID"];
$iblockID = $arParams["IBLOCK_ID"];

$arFilter = array(
    "IBLOCK_ID" => $iblockID,
    "ID" => $elementID
);

$arSelect = array("ID", "IBLOCK_ID", "PROPERTY_TITLE");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

if ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $titleValues = $arProps["TITLE"];
    $arResult["TITLE_VALUES"] = $titleValues;

    if (!empty($arResult["TITLE_VALUES"])) {
        $combinedArray = array();

        foreach ($arResult["TITLE_VALUES"]["VALUE"] as $key => $value) {
            $text = $value["TEXT"];
            $description = isset($arResult["TITLE_VALUES"]["DESCRIPTION"][$key]) ? $arResult["TITLE_VALUES"]["DESCRIPTION"][$key] : '';

            $arResult["INFO"][] = array(
                'text' => $text,
                'description' => $description
            );
        }

    }
}

