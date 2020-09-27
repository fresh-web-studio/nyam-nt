<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="blocks_items">
    <div class="row">
    <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>

        <div class="blocks_item col-lg-4">
            <div class="over_item">
                <a href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">
                    <? if (strlen($arElement["DETAIL_PICTURE"]["SRC"]) !== 0) { ?>
                        <div class="image_item" style="background: url(<?= $arElement["DETAIL_PICTURE"]["SRC"] ?>) no-repeat center; background-size: contain"></div>
                    <? } else { ?>
                        <div class="image_item" style="background: url(/local/images/nof.jpg) no-repeat center; background-size: contain"></div>
                    <? } ?>
                    <span>
                     Артикул: <? echo $arElement["DISPLAY_PROPERTIES"]["ATT_BARCADE"]["~VALUE"];?>
                    </span>
                    <h5>
                        <?
                        $strname = $arElement["NAME"];
                        echo TruncateText($strname, 55);
                        ?>
                    </h5>
                </a>
                <div class="price2">
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

                                echo "<div class=\"pricebl\"><strong>от "; echo CurrencyFormat($ar_price["PRICE"], "RUB"); echo "</strong></div>" ;
                                ?>

                                <div>
                                  <a class="btn-default" href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">Подробнее</a>
                                </div>
                    <?
                                break;
                            }
                        }
                        ?>

                </div>

                <div class="price">



                    <? //echo '<pre>'; print_r($arElement); echo'</pre>';?>
                    <? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
                        <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                            <strong><s><?= $arPrice["PRINT_VALUE"] ?></s> <?= $arPrice["PRINT_DISCOUNT_VALUE"] ?>
                            </strong>
                        <? else: ?>
                            <strong>от <?= $arPrice["PRINT_VALUE"] ?></strong>
                            <?/*<form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
                                  class="add_form">
                                <input type="text" name="QUANTITY" value="1" size="5" style="display: none;">
                                <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                                <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>" value="<? echo $arElement["ID"] ?>">
                                <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>" value="<? echo GetMessage("CATALOG_BUY") ?>" style="display: none;">
                                <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>" value=" Добавить в корзину" class="fa">
                            </form>*/?>
                            <div>
                                <a class="btn-default" href="<? echo $arElement["DETAIL_PAGE_URL"] ?>" title="<?= $arElement["NAME"] ?>">Подробнее</a>
                            </div>
                            <!--<button data-id="<?= $arElement['ID'] ?>" class="h2o_add_favor fa"><i class="far fa-star"></i> В избранное</button> -->
                        <? endif; ?>
                    <? endforeach; ?>



                    <div class="clb"></div>

                </div>
                <div class="clb"></div>
            </div>
        </div>
    <? endforeach; ?>
</div>
</div>


