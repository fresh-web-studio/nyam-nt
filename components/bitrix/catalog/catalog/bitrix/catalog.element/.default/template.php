<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="goods__row">
    <div class="goods__photo-price">
        <!-- Картинка детальная -->
        <? if (count($arResult["MORE_PHOTO"]) > 0) {//Если есть дополнительные картинки, выводим карусель
            ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?
                        $renderImageFirst = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 1178, "height" => 1178), BX_RESIZE_IMAGE_EXACT, false);
                        ?>
                        <a class="link-photo carousel-item-center" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>"
                           data-fancybox="group" data-caption="<?= $arResult['NAME'] ?>">
                            <img class="d-block" src="<?= $renderImageFirst["src"] ?>" alt="<?= $arResult["NAME"] ?>"
                                 title="<?= $arResult["NAME"] ?>"/>
                        </a>
                    </div>
                    <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
                        <div class="carousel-item">
                            <a class="link-photo carousel-item-center" href="<?= $PHOTO["SRC"] ?>" data-fancybox="group"
                               data-caption="<?= $arResult['NAME'] ?>">
                                <?
                                $renderImage = CFile::ResizeImageGet($PHOTO, array("width" => 1178, "height" => 1178), BX_RESIZE_IMAGE_EXACT, false);
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
            <ol class="carousel-control-btn" <? $index = 0; ?>>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index++; ?>" class="active">
                    <?
                    $renderImageFirst = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 1178, "height" => 1178), BX_RESIZE_IMAGE_EXACT, false);
                    ?>
                    <div class="link-photo-min" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>"
                         data-caption="<?= $arResult['NAME'] ?>">
                        <img src="<?= $renderImageFirst["src"] ?>" alt="<?= $arResult["NAME"] ?>"
                             title="<?= $arResult["NAME"] ?>"/>
                    </div>
                </li>
                <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index++; ?>">
                        <div class="link-photo-min" href="<?= $PHOTO["SRC"] ?>" data-caption="<?= $arResult['NAME'] ?>">
                            <?
                            $renderImage = CFile::ResizeImageGet($PHOTO, array("width" => 1178, "height" => 1178), BX_RESIZE_IMAGE_EXACT, false);
                            ?>
                            <img src="<?= $renderImage["src"] ?>" alt="<?= $arResult["NAME"] ?>"/>
                        </div>
                    </li>
                <? endforeach ?>
            </ol>
        <? } else { //Иначе- Если есть дополнительные картинки- выводим только основную?>
            <? if (strlen($arResult["DETAIL_PICTURE"]["SRC"]) > 0): ?>
                <a class="link-photo oneimage" href="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" data-fancybox="group"
                   data-caption="<?= $arResult['NAME'] ?>">
                    <img src="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>" alt="<?= $arResult["NAME"] ?>"
                         title="<?= $arResult["NAME"] ?>"/>
                </a>
            <? else: ?>
                <div class="link-photo">
                    <img class="no_image" src="/local/templates/<? echo SITE_TEMPLATE_ID; ?>/images/no_image.png"
                         alt="Нет картинки"/>
                </div>
            <? endif ?>
        <? } ?>
        <!-- /Картинка детальная -->
    </div>
    <div class="goods__description">
        <h2 class="goods__name"><? $APPLICATION->ShowTitle(false); ?></h2>
        <?php if ($arResult['DETAIL_TEXT'] != ''): ?>
        <h3 class="goods__composition-title">Описание:</h3>
        <p class="goods__composition">
            <!-- Описание -->
            <?= $arResult["DETAIL_TEXT"] ?>
        <p>
            <?php endif; ?>
            <!-- Свойства -->
            <? if (($arResult["DISPLAY_PROPERTIES"]['calories']) || ($arResult["DISPLAY_PROPERTIES"]['proteins']) || ($arResult["DISPLAY_PROPERTIES"]['fats']) || ($arResult["DISPLAY_PROPERTIES"]['carbohydrates'])){ ?>
                <h3 class="goods__composition-title">Выпуск блюд на 1 порцию:</h3>
                <div class="goods__composition-row">
                    <? if ($arResult["DISPLAY_PROPERTIES"]['calories']) { ?>
                        <div class="goods__column"><?= $arResult['DISPLAY_PROPERTIES']['calories']['NAME'] ?>:</div>
                        <div class="goods__column-right"><? echo $arResult['DISPLAY_PROPERTIES']['calories']['DISPLAY_VALUE']; ?></div>
                    <? } ?>
                    <? if ($arResult["DISPLAY_PROPERTIES"]['proteins']) { ?>
                        <div class="goods__column"><?= $arResult['DISPLAY_PROPERTIES']['proteins']['NAME'] ?>:</div>
                        <div class="goods__column-right"><? echo $arResult['DISPLAY_PROPERTIES']['proteins']['DISPLAY_VALUE']; ?></div>
                    <? } ?>
                    <? if ($arResult["DISPLAY_PROPERTIES"]['fats']) { ?>
                        <div class="goods__column"><?= $arResult['DISPLAY_PROPERTIES']['fats']['NAME'] ?>:</div>
                        <div class="goods__column-right"><? echo $arResult['DISPLAY_PROPERTIES']['fats']['DISPLAY_VALUE']; ?></div>
                    <? } ?>
                    <? if ($arResult["DISPLAY_PROPERTIES"]['carbohydrates']) { ?>
                        <div class="goods__column"><?= $arResult['DISPLAY_PROPERTIES']['carbohydrates']['NAME'] ?>:</div>
                        <div class="goods__column-right"><? echo $arResult['DISPLAY_PROPERTIES']['carbohydrates']['DISPLAY_VALUE']; ?></div>
                    <? } ?>
                </div>
            <? } ?>
            <!-- /Свойства -->

        <? if (is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])): ?>
            <div class="goods__variations-list">
                <?
                $arValues = [
                    '20' => [
											'PORTIONS' => '2 порции',
											'CLASS' => 'goods__twenty',
										],
                    '30' => [
											'PORTIONS' => '4 порции',
											'CLASS' => 'goods__thirty',
										],
                    '40' => [
											'PORTIONS' => '8 порций',
											'CLASS' => 'goods__forty',
										],
                ];
                ?>
                <? foreach ($arResult['OFFERS'] as $arOffer): ?>
                    <?
                    $intDiameter = $arOffer['PROPERTIES']['DIAMETER']['VALUE_XML_ID'];
                    ?>
                    <a href="#" class="goods__link" data-role="pizza_diameter" data-id="<?= $arOffer['ID']; ?>"
                       data-price="<?= $arOffer['MIN_PRICE']['DISCOUNT_VALUE']; ?>"
                       data-price-formatted="<?= $arOffer['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?>">
                        <div class="goods__variation <?= $arValues[$intDiameter]['CLASS']; ?>">
                            <div class="unification">
                                <div class="goods__variation_row">
                                    <?= $intDiameter; ?> см
                                </div>
                                <div class="goods__variation_row">
                                    (<?= $arValues[$intDiameter]['PORTIONS']; ?>)
                                </div>
                                <div class="goods__variation_row">
                                    <?=$arOffer['PROPERTIES']['ATT_CALORIES_OFFERS']['VALUE'];?> ккал
                                </div>
                            </div>
                        </div>
                    </a>
                <? endforeach ?>
            </div>

        <? endif ?>
				
				<div class="goods__quantity_price-list">
						<div class="quantity__list">
								<span class="quantity__btn-minus" data-role="buy_decrement"></span>
								<div class="quantity__quantity">
										<input class="product-item-amount-field" type="number" value="1" data-role="buy_quantity" disabled>
								</div>
								<span class="quantity__btn-plus" data-role="buy_increment"></span>
						</div>
						<div class="goods__price" data-role="buy_price" data-price="<?=$arResult['MIN_PRICE']['DISCOUNT_VALUE'];?>">
							<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];?>
						</div>
						<a href="#" data-role="buy_button" data-id="<?=$arResult['ID'];?>">
								<div class="goods__bay-btn">
										В корзину
								</div>
						</a>
				</div>
				
    </div>
</div>



