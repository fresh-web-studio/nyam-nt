<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

    <div class="goods__row">
        <div class="goods__photo-price">
            <!-- Картинка детальная -->
            <?
            if (count($arResult["MORE_PHOTO"]) > 0) {//Если есть дополнительные картинки, выводим карусель
                ?>
                <div class="list_carousel">
                    <a id="prev1" class="prev fa" href="#">&#xf104;</a>
                    <a id="next1" class="next fa" href="#">&#xf105;</a>
                    <div class="clb"></div>
                    <ul id="foo1">
                        <li>
                            <?
                            $renderImageFirst = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
                            ?>
                            <a class="link-photo" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                                <img src="<?= $renderImageFirst["src"] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/>
                            </a>
                        </li>
                        <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
                            <li>
                                <a class="link-photo-min" href="<?= $PHOTO["SRC"] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                                    <?
                                    $renderImage = CFile::ResizeImageGet($PHOTO, Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
                                    ?>
                                    <img src="<?= $renderImage["src"] ?>" alt="<?= $arResult["NAME"] ?>"/>
                                </a>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
            <? } else { //Иначе- Если есть дополнительные картинки- выводим только основную?>
                <a class="oneimage" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                    <img src="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/>
                </a>
            <? } ?>
            <?/*
            $renderImageFirst = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
            */?><!--
            <a class="link-photo" href="<?/*= $arResult["DETAIL_PICTURE"]['SRC'] */?>" data-fancybox="group" data-caption="<?/*= $arResult['NAME'] */?>">
                <img src="<?/*= $renderImageFirst["src"] */?>" alt="<?/*= $arResult["NAME"] */?>" title="<?/*= $arResult["NAME"] */?>"/>
            </a>  -->
            <!-- /Картинка детальная -->
        </div>
        <div class="goods__description">
            <h1 class="goods__name">Пицца «Чоризо»</h1>
            <h3 class="goods__composition-title">Состав:</h3>
            <p class="goods__composition">Колбаса острая сырокопченая, сыр моцарелла, соль, специи.
            <p>
            <h3 class="goods__composition-title">Выпуск блюд на 1 порцию:</h3>
            <div class="goods__composition-row">
                <div class="goods__column">Колорийность:</div>
                <div class="goods__column-right">447</div>
                <div class="goods__column">Белки:</div>
                <div class="goods__column-right">16,2</div>
                <div class="goods__column">Жиры:</div>
                <div class="goods__column-right">27,3</div>
                <div class="goods__column">Углеводы:</div>
                <div class="goods__column-right">33,9</div>
            </div>
            <div class="goods__variations-list">
                <a href="#" class="goods__link">
                    <div class="goods__variation goods__forty goods__active">
                        <div class="unification">
                            <div class="goods__variation_row">40 см</div>
                            <div class="goods__variation_row">(8 порций)</div>
                            <div class="goods__variation_row">3 576 ккал</div>
                        </div>
                    </div>
                </a>
                <a href="#" class="goods__link">
                    <div class="goods__variation goods__thirty">
                        <div class="unification">
                            <div class="goods__variation_row">30 см</div>
                            <div class="goods__variation_row">(4 порций)</div>
                            <div class="goods__variation_row">1788 ккал</div>
                        </div>
                    </div>
                </a>
                <a href="#" class="goods__link">
                    <div class="goods__variation goods__twenty">
                        <div class="unification">
                            <div class="goods__variation_row">20 см</div>
                            <div class="goods__variation_row">(2 порций)</div>
                            <div class="goods__variation_row">894 ккал</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="goods__quantity_price-list">
                <div class="goods__price">
                    757 руб.
                </div>
                <div class="quantity__list">
                    <span class="quantity__btn-minus"></span>
                    <div class="quantity__quantity">
                        <input class="product-item-amount-field" type="number" value="1">
                        <span class="product-item-amount-description-container">
                                шт
                            </span>
                    </div>
                    <span class="quantity__btn-plus"></span>
                </div>
                <a href="#">
                    <div class="goods__bay-btn">
                        В корзину
                    </div>
                </a>
            </div>
        </div>
    </div>








<!-- Свойства -->
				<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
					<?=$arProperty["NAME"]?>: <?
					if(is_array($arProperty["DISPLAY_VALUE"])):
						echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
					elseif($pid=="MANUAL"):
						?><a href="<?=$arProperty["VALUE"]?>"><?=GetMessage("CATALOG_DOWNLOAD")?></a><?
					else:
						echo $arProperty["DISPLAY_VALUE"];?>
					<?endif?>
				<?endforeach?>





			

	<?if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):?>
	<!-- Если есть преддожения -->
		<?foreach($arResult["OFFERS"] as $arOffer):?>
			<!-- Свойства -->
			<?foreach($arOffer["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
				<small><?=$arProperty["NAME"]?>:&nbsp;<?
					if(is_array($arProperty["DISPLAY_VALUE"]))
						echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
					else
						echo $arProperty["DISPLAY_VALUE"];?></small><br />
			<?endforeach?>
			<!-- Цены -->
			<?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<?=$arResult["CAT_PRICES"][$code]["TITLE"];?>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<s><?=$arPrice["PRINT_VALUE"]?></s> <?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
					<?else:?>
						<?=$arPrice["PRINT_VALUE"]?>
					<?endif?>
					</p>
				<?endif;?>
			<?endforeach;?>
			<!-- Покупка -->
			<?if($arOffer["CAN_BUY"]):?>
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" сlass="add_form">
						<a href="javascript:void(0)" onclick="if (BX('QUANTITY<?= $arOffer['ID'] ?>').value &gt; 1) BX('QUANTITY<?= $arOffer['ID'] ?>').value--;">-</a>
	                    <input type="text" name="QUANTITY" value="1" id="QUANTITY<?= $arOffer['ID'] ?>"/>
	                    <a href="javascript:void(0)" onclick="BX('QUANTITY<?= $arOffer['ID'] ?>').value++;">+</a>
						<input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
						<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arOffer["ID"]?>">
						<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
						<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CT_BCE_CATALOG_ADD")?>">
					</form>
			<?elseif(count($arResult["CAT_PRICES"]) > 0):?>
				<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
			<?endif?>
		<?endforeach;?>
	<?else:?>
	<!-- Если нет предложений -->

		<!-- Цены -->
		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
			<?if($arPrice["CAN_ACCESS"]):?>
				<?=$arResult["CAT_PRICES"][$code]["TITLE"];?>
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<s><?=$arPrice["PRINT_VALUE"]?></s> <?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
				<?else:?>
					<?=$arPrice["PRINT_VALUE"]?>
				<?endif?>
				</p>
			<?endif;?>
		<?endforeach;?>
		<!-- Покупка -->
		<?if($arResult["CAN_BUY"]):?>
				<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" сlass="add_form">
                    <a href="javascript:void(0)" onclick="if (BX('QUANTITY<?= $arElement['ID'] ?>').value &gt; 1) BX('QUANTITY<?= $arElement['ID'] ?>').value--;">-</a>
                    <input type="text" name="QUANTITY" value="1" id="QUANTITY<?= $arElement['ID'] ?>"/>
                    <a href="javascript:void(0)" onclick="BX('QUANTITY<?= $arElement['ID'] ?>').value++;">+</a>
                    <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                    <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult["ID"]?>">
                    <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
                    <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD_TO_BASKET")?>">
				</form>
		<?elseif((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])):?>
			<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
		<?endif?>
	<?endif?>
		
	
	<!-- Описание -->
	<?=$arResult["DETAIL_TEXT"]?>