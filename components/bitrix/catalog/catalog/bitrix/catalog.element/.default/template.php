<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

    <div class="goods__row">
        <div class="goods__photo-price">
            <!-- Картинка детальная -->
            <?
            if (count($arResult["MORE_PHOTO"]) > 0) {//Если есть дополнительные картинки, выводим карусель
                ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-interval="false" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?
                            $renderImageFirst = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
                            ?>
                            <a class="link-photo carousel-item-center" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                                <img class="d-block" src="<?= $renderImageFirst["src"] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/>
                            </a>
                        </div>
                        <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
                        <div class="carousel-item">
                                    <a class="link-photo carousel-item-center" href="<?= $PHOTO["SRC"] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                                        <?
                                        $renderImage = CFile::ResizeImageGet($PHOTO, Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
                                        ?>
                                        <img class="d-block" src="<?= $renderImage["src"] ?>" alt="<?= $arResult["NAME"] ?>"/>
                                    </a>
                        </div>
                        <? endforeach ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <ol class="carousel-control-btn" <?$index=0;?>>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$index++;?>" class="active">
                        <?
                        $renderImageFirst = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
                        ?>
                        <div class="link-photo-min" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                            <img src="<?= $renderImageFirst["src"] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/>
                        </div>
                    </li>
                    <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$index++;?>">
                            <div class="link-photo-min" href="<?= $PHOTO["SRC"] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                                <?
                                $renderImage = CFile::ResizeImageGet($PHOTO, Array("width" => 1000, "height" => 1000), BX_RESIZE_IMAGE_EXACT, false);
                                ?>
                                <img src="<?= $renderImage["src"] ?>" alt="<?= $arResult["NAME"] ?>"/>
                            </div>
                        </li>
                    <? endforeach ?>
                </ol>
            <? } else { //Иначе- Если есть дополнительные картинки- выводим только основную?>
                <a class="link-photo oneimage" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                    <img src="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/>
                </a>
            <? } ?>
            <!-- /Картинка детальная -->
        </div>
        <div class="goods__description">
            <h2 class="goods__name"><? $APPLICATION->ShowTitle(false); ?></h2>
            <?php if($arResult['DETAIL_TEXT'] != ''): ?>
                <h3 class="goods__composition-title">Состав:</h3>
                <p class="goods__composition">
                    <!-- Описание -->
                    <?=$arResult["DETAIL_TEXT"]?>
                <p>
            <?php endif; ?>
            <!-- Свойства -->
            <? if (($arResult["DISPLAY_PROPERTIES"]['calories']) || ($arResult["DISPLAY_PROPERTIES"]['proteins']) || ($arResult["DISPLAY_PROPERTIES"]['fats']) || ($arResult["DISPLAY_PROPERTIES"]['carbohydrates'])){?>
            <h3 class="goods__composition-title">Выпуск блюд на 1 порцию:</h3>
            <div class="goods__composition-row">
                <? if ($arResult["DISPLAY_PROPERTIES"]['calories']){?>
                    <div class="goods__column"><?=$arResult['DISPLAY_PROPERTIES']['calories']['NAME']?>:</div>
                    <div class="goods__column-right"><?echo $arResult['DISPLAY_PROPERTIES']['calories']['DISPLAY_VALUE'];?></div>
                <?}?>
                <? if ($arResult["DISPLAY_PROPERTIES"]['proteins']){?>
                    <div class="goods__column"><?=$arResult['DISPLAY_PROPERTIES']['proteins']['NAME']?>:</div>
                    <div class="goods__column-right"><?echo $arResult['DISPLAY_PROPERTIES']['proteins']['DISPLAY_VALUE'];?></div>
                <?}?>
                <? if ($arResult["DISPLAY_PROPERTIES"]['fats']){?>
                    <div class="goods__column"><?=$arResult['DISPLAY_PROPERTIES']['fats']['NAME']?>:</div>
                    <div class="goods__column-right"><?echo $arResult['DISPLAY_PROPERTIES']['fats']['DISPLAY_VALUE'];?></div>
                <?}?>
                <? if ($arResult["DISPLAY_PROPERTIES"]['carbohydrates']){?>
                    <div class="goods__column"><?=$arResult['DISPLAY_PROPERTIES']['carbohydrates']['NAME']?>:</div>
                    <div class="goods__column-right"><?echo $arResult['DISPLAY_PROPERTIES']['carbohydrates']['DISPLAY_VALUE'];?></div>
                <?}?>
            </div>
            <?}?>
            <!-- /Свойства -->


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


	<?if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):?>
	<!-- Если есть предложения -->
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
	                    <input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" id="QUANTITY<?= $arOffer['ID'] ?>"/>
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