<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ORDER_PROP"]["RELATED"] as $key => $arValue){
	if(empty($arValue['RELATION'])){
		unset($arResult["ORDER_PROP"]["RELATED"][$key]);
	}
}

include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
$style = (is_array($arResult["ORDER_PROP"]["RELATED"]) && count($arResult["ORDER_PROP"]["RELATED"])) ? "" : "display:none";
?>

<div class="order_props_delivery" style="<?=$style?>">
	<?=PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"])?>
</div>