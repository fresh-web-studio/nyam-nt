<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $elementEdit
 * @var string $elementDelete
 * @var string $elementDeleteParams
 */


global $APPLICATION;

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCT_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCT_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCT_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCT_CATALOG_RELATIVE_QUANTITY_FEW');

$generalParams = array(
	'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH' => $arParams['COMPARE_PATH'],
	'COMPARE_NAME' => $arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS' => $labelPositionClass,
	'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
	'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
	'~BASKET_URL' => $arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
	'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
	'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($this->randString()));
$containerName = 'catalog-top-container';
?>

<div class="main__item-list">
    <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>

    <div class="main__frame">
        <div class="main__block-item">
            <a href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">
                <? if (strlen($arElement["PREVIEW_PICTURE"]["SRC"]) !== 0) { ?>
                    <img src="<?= $arElement["PREVIEW_PICTURE"]['SRC'] ?>" alt="<?= $arElement["NAME"] ?>" title="<?= $arElement["NAME"] ?>"/>
                <? } else { ?>
                    <div>
                        <img class="no_image" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/no_image.png" alt="Нет картинки"/>
                    </div>
                <? } ?>
                <h3>
                    <div class="main__name">
                        <?
                        $strname = $arElement["NAME"];
                        echo TruncateText($strname, 55);
                        ?>
                    </div>
                </h3>
            </a>

            <div class="main__description">
                <?=$arElement["DETAIL_TEXT"]?>
            </div>
            <div class="main__item-row">
                <?
                $intIBlockID = 4;
                $mxResult = CCatalogSKU::GetInfoByProductIBlock(
                    $intIBlockID
                );
                if (is_array($mxResult))
                {

                $rsOffers = CIBlockElement::GetList(array("PRICE"=>"ASC"),array('IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_'.$mxResult['SKU_PROPERTY_ID'] => $arElement["ID"]));
                while ($arOffer = $rsOffers->GetNext())
                {
                $ar_price = GetCatalogProductPrice($arOffer["ID"], 1);

                echo "<div  class='main__item-text'><div class='main__item-price'>"; echo CurrencyFormat($ar_price["PRICE"], "RUB"); echo "</div>" ;
                ?>

                <? if ($arElement["DISPLAY_PROPERTIES"]['ATT_PIZZA_PRICE_FOR_PIZZA']){?>
                    <div class="main__item-info">
                        <?=$arElement['DISPLAY_PROPERTIES']['ATT_PIZZA_PRICE_FOR_PIZZA']['NAME']?> / <?echo $arElement['DISPLAY_PROPERTIES']['ATT_PIZZA_PRICE_FOR_PIZZA']['DISPLAY_VALUE'];?>
                    </div>
                <?}?>
                <? if ($arElement["DISPLAY_PROPERTIES"]['ATT_PRICE_PER_SERVING']) { ?>
                    <div class="main__item-info">
                        <?= $arElement['DISPLAY_PROPERTIES']['ATT_PRICE_PER_SERVING']['NAME'] ?>
                        / <? echo $arElement['DISPLAY_PROPERTIES']['ATT_PRICE_PER_SERVING']['DISPLAY_VALUE']; ?>
                    </div>
                <? } ?>
            </div>
            <a class="btn-default" href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">
                <div class="main__item-btn">
                    <?=GetMessage('SELECT_PRODUCT')?>
                </div>
            </a>
            <?
            break;
            }
            }
            ?>

        </div>
        <div class="main__item-row">

            <? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
                <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                    <div class="main__item-text">
                        <div class="main__item-price">
                            <s><?= $arPrice["PRINT_VALUE"] ?></s> <?= $arPrice["PRINT_DISCOUNT_VALUE"] ?>
                        </div>
                        <? if ($arElement["DISPLAY_PROPERTIES"]['ATT_PIZZA_PRICE_FOR_PIZZA']) { ?>
                            <div class="main__item-info">
                                <?= $arElement['DISPLAY_PROPERTIES']['ATT_PIZZA_PRICE_FOR_PIZZA']['NAME'] ?>
                                / <? echo $arElement['DISPLAY_PROPERTIES']['ATT_PIZZA_PRICE_FOR_PIZZA']['DISPLAY_VALUE']; ?>
                            </div>
                        <? } ?>
                        <? if ($arElement["DISPLAY_PROPERTIES"]['ATT_PRICE_PER_SERVING']) { ?>
                            <div class="main__item-info">
                                <?= $arElement['DISPLAY_PROPERTIES']['ATT_PRICE_PER_SERVING']['NAME'] ?>
                                / <? echo $arElement['DISPLAY_PROPERTIES']['ATT_PRICE_PER_SERVING']['DISPLAY_VALUE']; ?>
                            </div>
                        <? } ?>
                    </div>
                <? else: ?>

                    <div class="main__item-text">
                        <div class="main__item-price"><?= $arPrice["PRINT_VALUE"] ?></div>
                        <? if ($arElement["DISPLAY_PROPERTIES"]['ATT_PIZZA_PRICE_FOR_PIZZA']) { ?>
                            <div class="main__item-info">
                                <?= $arElement['DISPLAY_PROPERTIES']['ATT_PIZZA_PRICE_FOR_PIZZA']['NAME'] ?>
                                / <? echo $arElement['DISPLAY_PROPERTIES']['ATT_PIZZA_PRICE_FOR_PIZZA']['DISPLAY_VALUE']; ?>
                            </div>
                        <? } ?>
                        <? if ($arElement["DISPLAY_PROPERTIES"]['ATT_PRICE_PER_SERVING']) { ?>
                            <div class="main__item-info">
                                <?= $arElement['DISPLAY_PROPERTIES']['ATT_PRICE_PER_SERVING']['NAME'] ?>
                                / <? echo $arElement['DISPLAY_PROPERTIES']['ATT_PRICE_PER_SERVING']['DISPLAY_VALUE']; ?>
                            </div>
                        <? } ?>
                    </div>
                    <a class="btn-default" href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">
                        <div class="main__item-btn">
                            <?=GetMessage('SELECT_PRODUCT')?>
                        </div>
                    </a>
                <? endif; ?>
            <? endforeach; ?>
        </div>
    </div>
</div>
<? endforeach; ?>
</div>
<script>
	BX.message({
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>'
	});
	var <?=$obName?> = new JCCatalogTopComponent({
		siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
		componentPath: '<?=CUtil::JSEscape($componentPath)?>',
		deferredLoad: false, // enable it for deferred load
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
		template: '<?=CUtil::JSEscape($signedTemplate)?>',
		ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
		parameters: '<?=CUtil::JSEscape($signedParams)?>',
		container: '<?=$containerName?>'
	});
</script>