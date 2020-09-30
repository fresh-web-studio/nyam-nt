<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
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
?>
<script id="basket-item-template" type="text/html">
	<div class="basket-items-list-item-container{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        <div class="cart__row-base">
		{{^SHOW_RESTORE}}
                <div class="basket-items-list-item-descriptions-inner" id="basket-item-height-aligner-{{ID}}">
                    <?
                    if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST']))
                    {
                        ?>
                        <div class="cart__img<?=(!isset($mobileColumns['PREVIEW_PICTURE']) ? ' hidden-xs' : '')?>">
                            {{#DETAIL_PAGE_URL}}
                                <a href="{{DETAIL_PAGE_URL}}" class="basket-item-image-link">
                            {{/DETAIL_PAGE_URL}}

                            <img class="basket-item-image" alt="{{NAME}}"
                                src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}">

                            {{#SHOW_LABEL}}
                                <div class="basket-item-label-text basket-item-label-big <?=$labelPositionClass?>">
                                    {{#LABEL_VALUES}}
                                        <div{{#HIDE_MOBILE}} class="hidden-xs"{{/HIDE_MOBILE}}>
                                            <span title="{{NAME}}">{{NAME}}</span>
                                        </div>
                                    {{/LABEL_VALUES}}
                                </div>
                            {{/SHOW_LABEL}}

                            <?
                            if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
                            {
                                ?>
                                {{#DISCOUNT_PRICE_PERCENT}}
                                    <div class="basket-item-label-ring basket-item-label-small <?=$discountPositionClass?>">
                                        -{{DISCOUNT_PRICE_PERCENT_FORMATED}}
                                    </div>
                                {{/DISCOUNT_PRICE_PERCENT}}
                                <?
                            }
                            ?>

                            {{#DETAIL_PAGE_URL}}
                                </a>
                            {{/DETAIL_PAGE_URL}}
                        </div>
                        <?
                    }
                    ?>
                    <div class="cart__text">
                        <h2 class="basket-item-info-name">
                            {{#DETAIL_PAGE_URL}}
                                <a href="{{DETAIL_PAGE_URL}}" class="cart__link">
                            {{/DETAIL_PAGE_URL}}

                            <span data-entity="cart__name">{{NAME}}</span>

                            {{#DETAIL_PAGE_URL}}
                                </a>
                            {{/DETAIL_PAGE_URL}}
                        </h2>
                        {{#NOT_AVAILABLE}}
                            <div class="basket-items-list-item-warning-container">
                                <div class="alert alert-warning text-center">
                                    <?=Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE')?>.
                                </div>
                            </div>
                        {{/NOT_AVAILABLE}}
                        {{#DELAYED}}
                            <div class="basket-items-list-item-warning-container">
                                <div class="alert alert-warning text-center">
                                    <?=Loc::getMessage('SBB_BASKET_ITEM_DELAYED')?>.
                                    <a href="javascript:void(0)" data-entity="basket-item-remove-delayed">
                                        <?=Loc::getMessage('SBB_BASKET_ITEM_REMOVE_DELAYED')?>
                                    </a>
                                </div>
                            </div>
                        {{/DELAYED}}
                        {{#WARNINGS.length}}
                            <div class="basket-items-list-item-warning-container">
                                <div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
                                    <span class="close" data-entity="basket-item-warning-close">&times;</span>
                                        {{#WARNINGS}}
                                            <div data-entity="basket-item-warning-text">{{{.}}}</div>
                                        {{/WARNINGS}}
                                </div>
                            </div>
                        {{/WARNINGS.length}}
                        <div class="basket-item-block-properties">
                            <?
                            if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
                            {
                                foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
                                {
                                    switch (trim((string)$blockName))
                                    {
                                        case 'props':
                                            if (in_array('PROPS', $arParams['COLUMNS_LIST']))
                                            {
                                                ?>
                                                {{#PROPS}}
                                                    <div class="basket-item-property<?=(!isset($mobileColumns['PROPS']) ? ' hidden-xs' : '')?>">
                                                        <div class="basket-item-property-name">
                                                            {{{NAME}}}
                                                        </div>
                                                        <div class="basket-item-property-value"
                                                            data-entity="basket-item-property-value" data-property-code="{{CODE}}">
                                                            {{{VALUE}}}
                                                        </div>
                                                    </div>
                                                {{/PROPS}}
                                                <?
                                            }

                                            break;
                                        case 'sku':
                                            ?>
                                            {{#SKU_BLOCK_LIST}}
                                                {{#IS_IMAGE}}
                                                    <div class="basket-item-property basket-item-property-scu-image"
                                                        data-entity="basket-item-sku-block">
                                                        <div class="basket-item-property-name">{{NAME}}</div>
                                                        <div class="basket-item-property-value">
                                                            <ul class="basket-item-scu-list">
                                                                {{#SKU_VALUES_LIST}}
                                                                    <li class="basket-item-scu-item{{#SELECTED}} selected{{/SELECTED}}
                                                                        {{#NOT_AVAILABLE_OFFER}} not-available{{/NOT_AVAILABLE_OFFER}}"
                                                                        title="{{NAME}}"
                                                                        data-entity="basket-item-sku-field"
                                                                        data-initial="{{#SELECTED}}true{{/SELECTED}}{{^SELECTED}}false{{/SELECTED}}"
                                                                        data-value-id="{{VALUE_ID}}"
                                                                        data-sku-name="{{NAME}}"
                                                                        data-property="{{PROP_CODE}}">
                                                                                <span class="basket-item-scu-item-inner"
                                                                                    style="background-image: url({{PICT}});"></span>
                                                                    </li>
                                                                {{/SKU_VALUES_LIST}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                {{/IS_IMAGE}}

                                                {{^IS_IMAGE}}
                                                    <div class="basket-item-property basket-item-property-scu-text"
                                                        data-entity="basket-item-sku-block">
                                                        <div class="basket-item-property-name">{{NAME}}</div>
                                                        <div class="basket-item-property-value">
                                                            <ul class="basket-item-scu-list">
                                                                {{#SKU_VALUES_LIST}}
                                                                    <li class="basket-item-scu-item{{#SELECTED}} selected{{/SELECTED}}
                                                                        {{#NOT_AVAILABLE_OFFER}} not-available{{/NOT_AVAILABLE_OFFER}}"
                                                                        title="{{NAME}}"
                                                                        data-entity="basket-item-sku-field"
                                                                        data-initial="{{#SELECTED}}true{{/SELECTED}}{{^SELECTED}}false{{/SELECTED}}"
                                                                        data-value-id="{{VALUE_ID}}"
                                                                        data-sku-name="{{NAME}}"
                                                                        data-property="{{PROP_CODE}}">
                                                                        <span class="basket-item-scu-item-inner">{{NAME}}</span>
                                                                    </li>
                                                                {{/SKU_VALUES_LIST}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                {{/IS_IMAGE}}
                                            {{/SKU_BLOCK_LIST}}

                                            {{#HAS_SIMILAR_ITEMS}}
                                                <div class="basket-items-list-item-double" data-entity="basket-item-sku-notification">
                                                    <div class="alert alert-info alert-dismissable text-center">
                                                        {{#USE_FILTER}}
                                                            <a href="javascript:void(0)"
                                                                class="basket-items-list-item-double-anchor"
                                                                data-entity="basket-item-show-similar-link">
                                                        {{/USE_FILTER}}
                                                        <?=Loc::getMessage('SBB_BASKET_ITEM_SIMILAR_P1')?>{{#USE_FILTER}}</a>{{/USE_FILTER}}
                                                        <?=Loc::getMessage('SBB_BASKET_ITEM_SIMILAR_P2')?>
                                                        {{SIMILAR_ITEMS_QUANTITY}} {{MEASURE_TEXT}}
                                                        <br>
                                                        <a href="javascript:void(0)" class="basket-items-list-item-double-anchor"
                                                            data-entity="basket-item-merge-sku-link">
                                                            <?=Loc::getMessage('SBB_BASKET_ITEM_SIMILAR_P3')?>
                                                            {{TOTAL_SIMILAR_ITEMS_QUANTITY}} {{MEASURE_TEXT}}?
                                                        </a>
                                                    </div>
                                                </div>
                                            {{/HAS_SIMILAR_ITEMS}}
                                            <?
                                            break;
                                        case 'columns':
                                            ?>
                                            {{#COLUMN_LIST}}
                                                {{#IS_IMAGE}}
                                                    <div class="basket-item-property-custom basket-item-property-custom-photo
                                                        {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                                        data-entity="basket-item-property">
                                                        <!--<div class="basket-item-property-custom-name">{{NAME}}</div>-->
                                                        <div class="cart__description">
                                                            {{#VALUE}}
                                                                <span>
                                                                    <img class="basket-item-custom-block-photo-item"
                                                                        src="{{{IMAGE_SRC}}}" data-image-index="{{INDEX}}"
                                                                        data-column-property-code="{{CODE}}">
                                                                </span>
                                                            {{/VALUE}}
                                                        </div>
                                                    </div>
                                                {{/IS_IMAGE}}

                                                {{#IS_TEXT}}
                                                    <div class="basket-item-property-custom basket-item-property-custom-text
                                                        {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                                        data-entity="basket-item-property">
<!--														<div class="basket-item-property-custom-name">{{NAME}}</div>
-->														<div class="cart__description"
                                                            data-column-property-code="{{CODE}}"
                                                            data-entity="basket-item-property-column-value">
                                                            {{VALUE}}
                                                        </div>
                                                    </div>
                                                {{/IS_TEXT}}

                                                {{#IS_HTML}}
                                                    <div class="basket-item-property-custom basket-item-property-custom-text
                                                        {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                                        data-entity="basket-item-property">
<!--														<div class="basket-item-property-custom-name">{{NAME}}</div>
-->														<div class="cart__description"
                                                            data-column-property-code="{{CODE}}"
                                                            data-entity="basket-item-property-column-value">
                                                            {{{VALUE}}}
                                                        </div>
                                                    </div>
                                                {{/IS_HTML}}

                                                {{#IS_LINK}}
                                                    <div class="basket-item-property-custom basket-item-property-custom-text
                                                        {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                                        data-entity="basket-item-property">
<!--														<div class="basket-item-property-custom-name">{{NAME}}</div>
-->														<div class="cart__description"
                                                            data-column-property-code="{{CODE}}"
                                                            data-entity="basket-item-property-column-value">
                                                            {{#VALUE}}
                                                            {{{LINK}}}{{^IS_LAST}}<br>{{/IS_LAST}}
                                                            {{/VALUE}}
                                                        </div>
                                                    </div>
                                                {{/IS_LINK}}
                                            {{/COLUMN_LIST}}
                                            <?
                                            break;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    {{#SHOW_LOADING}}
                        <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
                </div>

        <div class="cart__calc">
            <!-- Цена -->
            <?
            if ($usePriceInAdditionalColumn) {
                ?>
                <div class="basket-item-block-price">
                    {{#SHOW_DISCOUNT_PRICE}}
                    <div class="cart__price basket-item-price-old">
                                    <span class="basket-item-price-old-text">
                                        {{{FULL_PRICE_FORMATED}}}
                                    </span>
                    </div>
                    {{/SHOW_DISCOUNT_PRICE}}

                    <div class="basket-item-price-current">
                                <span class="cart__price" id="basket-item-price-{{ID}}">
                                    {{{PRICE_FORMATED}}}
                                </span>
                    </div>
                </div>

                <?
            }
            ?>
            <!-- /Цена -->
            <!-- Количество -->
            <div class="quantity__list basket-item-block-amount{{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}"
                 data-entity="basket-item-quantity-block">
                <span class="quantity__btn-minus" data-entity="basket-item-quantity-minus"></span>
                <div class="basket-item-amount-filed-block">
                    <input type="text" class="basket-item-amount-filed" value="{{QUANTITY}}" disabled
                           {{#NOT_AVAILABLE}} disabled="disabled" {{/NOT_AVAILABLE}}
                    data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                    id="basket-item-quantity-{{ID}}">
                </div>
                <span class="quantity__btn-plus" data-entity="basket-item-quantity-plus"></span>
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
            </div>
            <!-- /Количество -->
            <!-- Сумма -->
            <?
            if ($useSumColumn) {
                ?>
                <div class="basket-item-block-price">
                    {{#SHOW_DISCOUNT_PRICE}}
                    <div class="basket-item-price-old">
                                    <span class="cart__sum basket-item-price-old-text"
                                          id="basket-item-sum-price-old-{{ID}}">
                                        {{{SUM_FULL_PRICE_FORMATED}}}
                                    </span>
                    </div>
                    {{/SHOW_DISCOUNT_PRICE}}

                    <div class="basket-item-price-current">
                                <span class="cart__sum" id="basket-item-sum-price-{{ID}}">
                                    {{{SUM_PRICE_FORMATED}}}
                                </span>
                    </div>

                    {{#SHOW_DISCOUNT_PRICE}}
                    <div class="basket-item-price-difference">
                        <?= Loc::getMessage('SBB_BASKET_ITEM_ECONOMY') ?>
                        <span id="basket-item-sum-price-difference-{{ID}}" style="white-space: nowrap;">
                                        {{{SUM_DISCOUNT_PRICE_FORMATED}}}
                                    </span>
                    </div>
                    {{/SHOW_DISCOUNT_PRICE}}
                    {{#SHOW_LOADING}}
                    <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
                </div>
                <?
            }
            ?>
            <!-- /Сумма -->
            <!-- Удаление -->
            <?
            if ($useActionColumn) {
                ?>
                <div class="basket-item-block-actions">
                    <div class="cart__delete" data-entity="basket-item-delete"></div>
                    {{#SHOW_LOADING}}
                    <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
                </div>
                <?
            }
            ?>
            <!-- /Удаление -->
        </div>

        {{/SHOW_RESTORE}}
        </div>
	</div>
</script>