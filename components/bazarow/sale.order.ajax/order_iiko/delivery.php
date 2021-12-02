
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<!--<style>.set_delivery input:not(:checked) + label { display: none; }</style>
<style>.set_delivery input:not(:checked) + label:last-child { display: block; }</style>-->
<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?= $arResult["BUYER_STORE"] ?>"/>

<div class="set_delivery">
    <div class="set_delivery_title">
        Выберите доставку:
    </div>
    <?
    foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) { ?>
        <input type="radio"
               id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
               name="<?= htmlspecialcharsbx($arDelivery["FIELD_NAME"]) ?>"
               value="<?= $arDelivery["ID"] ?>"<? if ($arDelivery["CHECKED"] == "Y") echo " checked"; ?>
               onclick="submitForm();"
        />
        <label class="set_delivery_item" for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>" <?= $clickHandler ?>>
            <?= htmlspecialcharsbx($arDelivery["NAME"]) ?>
        </label>

        <?
        if ($arDelivery["ID"] == 3) {
            if ($arDelivery["CHECKED"] == "Y") { // Если самовывоз - прячем свойство местоположения
                ?>
                <style type="text/css">
                    .set_delivery input:not(:checked) + label:nth-child(2) { display: block; }

                    <!--
                    .order_props .order_props_item_28 {
                        display: none !important;
                    }
                    -->
                </style>
                <?
            }
        }

    }
    ?>
</div>