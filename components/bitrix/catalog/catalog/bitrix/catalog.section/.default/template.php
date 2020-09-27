<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="main__item-list">
    <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>

        <div class="main__frame">
            <div class="main__block-item">
                <a href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">
                    <? if (strlen($arElement["DETAIL_PICTURE"]["SRC"]) !== 0) { ?>
                        <img src="<?= $arElement["DETAIL_PICTURE"]['SRC'] ?>" alt="<?= $arElement["NAME"] ?>" title="<?= $arElement["NAME"] ?>"/>
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
                                        Выбрать
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
                                    Выбрать
                                </div>
                            </a>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>