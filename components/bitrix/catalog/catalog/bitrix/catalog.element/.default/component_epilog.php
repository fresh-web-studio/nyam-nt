<?

# Prepare format price on change quantity
if(\Bitrix\Main\Loader::includeModule('currency')){
	\CJSCore::init('currency');
	$arCurrencyFormat = \CCurrencyLang::getFormatDescription('RUB');
	printf('<script>BX.Currency.setCurrencyFormat("RUB", %s)</script>', 
		\CUtil::phpToJSObject($arCurrencyFormat, false, true));
}

# Custom add to basket
if($_POST['ajax_add_to_cart'] == 'Y'){
	$APPLICATION->restartBuffer();
	header('Content-Type: application/json');
	$arJson = ['Success' => false];
	$intProductId = intVal($_POST['product_id']);
	$intQuantity = intVal($_POST['quantity']);
	#
	$arMessages = [
		'SUCCESS_MESSAGE' => 'Товар добавлен в корзину.',
		'ERROR_MESSAGE' => 'Ошибка добавления товара в корзину.',
	];
	foreach($arMessages as $key => $item){
		$arMessages[$key] = $APPLICATION->convertCharset($item, 'UTF-8', 'CP1251');
	}
	#
	if(\Bitrix\Main\Loader::includeModule('iblock') && \Bitrix\Main\Loader::includeModule('sale')){
		$obBasket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), 
			\Bitrix\Main\Context::getCurrent()->getSite());
		if($obItem = $obBasket->getExistsItem('catalog', $intProductId)) {
			$obItem->setField('QUANTITY', $obItem->getQuantity() + $intQuantity);
		}
		else {
			$obItem = $obBasket->createItem('catalog', $intProductId);
			$obItem->setFields([
				'QUANTITY' => $intQuantity,
				'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
				'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
				'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
			]);
		}
		$obSaveResult = $obBasket->save();
		if($obSaveResult->isSuccess()){
			$arJson['Success'] = true;
			$arJson['SuccessMessage'] = $arMessages['SUCCESS_MESSAGE'];
		}
		else{
			$arJson['ErrorMessage'] = $arMessages['ERROR_MESSAGE'];
		}
	}
	#
	print \Bitrix\Main\Web\Json::encode($arJson);
	die();
}

