<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<div class="order_goods">
    <div class="order_goods_title">
        Состав заказа
    </div>
    <? foreach ($arResult['BASKET_ITEMS'] as $BASKET_ITEM) { ?>
        <div class="order_goods_item">
            <div class="order_goods_item_name">
                <?= $BASKET_ITEM['NAME']; ?>
            </div>
            <div class="order_goods_item_price">
                <?= $BASKET_ITEM['PRICE_FORMATED']; ?>
                <br>
                <?= $BASKET_ITEM['QUANTITY']; ?> <?= $BASKET_ITEM['MEASURE_NAME']; ?>.
            </div>

        </div>
<!-- Вывод доставки
        <div class="order_goods_item">
            <div class="order_goods_item_price">
                <?/*=GetMessage('SOA_TEMPL_SUM_DELIVERY')*/?>
            </div>
            <div class="order_goods_item_price">
                250 р.
            </div>
        </div>-->






    <? } ?>

        <div class="order_goods_item">
            <div class="order_goods_item_price">
                <?=GetMessage('SOA_TEMPL_SUM_DELIVERY')?>
            </div>
            <div class="order_goods_item_price">
         	<?= $arResult['DELIVERY_PRICE_FORMATED']?>
            </div>
       </div>


    <div class="order_goods_sum">
        <span>Сумма к оплате:</span>
        <span><?= $arResult["ORDER_TOTAL_PRICE_FORMATED"] ?></span>
    </div>
</div>



