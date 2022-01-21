<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

    <div class="goods__row">
    <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>

        <div class="goods__frame">
            <div class="goods__additionally">
                    <? if (strlen($arElement["PREVIEW_PICTURE"]["SRC"]) !== 0) { ?>
                        <img src="<?= $arElement["PREVIEW_PICTURE"]['SRC'] ?>" alt="<?= $arElement["NAME"] ?>" title="<?= $arElement["NAME"] ?>"/>
                    <? } else { ?>
                        <div class="link-photo">
                            <img class="no_image" src="/local/templates/<? echo SITE_TEMPLATE_ID;?>/images/no_image.png" alt="Нет картинки"/>
                        </div>
                    <? } ?>

                    <div class="goods__additionally-name" >
                        <?
                        $strname = $arElement["NAME"];
                        echo TruncateText($strname, 55);
                        ?>
                    </div>

                <!--<div class="price2">
                        <?/*
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

                                echo "<div class=\"pricebl\"><strong>от "; echo CurrencyFormat($ar_price["PRICE"], "RUB"); echo "</strong></div>" ;
                                */?>

                                <div>
                                  <a class="btn-default" href="<?/* echo $arElement["DETAIL_PAGE_URL"] */?>" title="<?/*= $arElement["NAME"] */?>">Подробнее</a>
                                </div>
                    <?/*
                                break;
                            }
                        }
                        */?>
                </div>-->
                <div class="goods__additionally-price-bay">
                    <? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
                        <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                            <strong class="goods__additionally-price"><s><?= $arPrice["PRINT_VALUE"] ?></s> <?= $arPrice["PRINT_DISCOUNT_VALUE"] ?>
                            </strong>
                        <? else: ?>
                            <strong class="goods__additionally-price"><?= $arPrice["PRINT_VALUE"] ?></strong>
                            <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
                                  class="add_form">
                                <input type="text" name="QUANTITY" value="1" size="5" style="display: none;">
                                <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                                <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>" value="<? echo $arElement["ID"] ?>">
                                <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>" value="<? echo GetMessage("CATALOG_BUY") ?>" style="display: none;">
                                <input type="submit" name="<?/* echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" */?>" value="+" class="goods__additionally-bay-btn">
                            </form>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>


